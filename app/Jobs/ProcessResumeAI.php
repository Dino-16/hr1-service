<?php

namespace App\Jobs;

use App\Models\Applicants\Application;
use App\Models\Applicants\FilteredResume;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Smalot\PdfParser\Parser;

class ProcessResumeAI implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function handle(): void
    {
        // 1. Extract Text from the PDF
        $parser = new Parser();
        // We use the resume_path stored in your Application table
        $pdf = $parser->parseFile(storage_path('app/public/' . $this->application->resume_path));
        $text = $pdf->getText();

        // 2. Prompt OpenAI to extract specific data
        $apiKey = config('openai.api_key');
        if (! is_string($apiKey) || $apiKey === '') {
            throw new \RuntimeException('Missing OPENAI_API_KEY');
        }

        $baseUri = config('openai.base_uri') ?: 'api.openai.com/v1';
        if (! str_starts_with($baseUri, 'http://') && ! str_starts_with($baseUri, 'https://')) {
            $baseUri = 'https://' . $baseUri;
        }
        $endpoint = rtrim($baseUri, '/') . '/chat/completions';

        $payload = [
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'You are an HR data extractor. Extract info from resumes into JSON.'],
                ['role' => 'user', 'content' => "Extract the following from this text: 
                    age (string), 
                    gender (string), 
                    skills (array of strings), 
                    experience (array of objects with title, company, years), 
                    education (array of objects with degree, school), 
                    score (0-100 based on fit for {$this->application->applied_position}), 
                    summary (short bio).
                    
                    Resume Text: {$text}"]
            ],
            'response_format' => ['type' => 'json_object'],
        ];

        $http = Http::timeout((int) config('openai.request_timeout', 30));
        if (app()->environment('local')) {
            $http = $http->withoutVerifying();
        }

        $resp = $http
            ->withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])
            ->post($endpoint, $payload);

        if (! $resp->successful()) {
            throw new \RuntimeException('OpenAI API error: HTTP ' . $resp->status() . ' ' . $resp->body());
        }

        $content = data_get($resp->json(), 'choices.0.message.content');
        if (! is_string($content) || $content === '') {
            throw new \RuntimeException('OpenAI API error: missing choices[0].message.content');
        }

        $result = json_decode($content, true);
        if (! is_array($result)) {
            throw new \RuntimeException('OpenAI API error: invalid JSON content: ' . $content);
        }

        $score = (int) ($result['score'] ?? 0);
        $skills = $result['skills'] ?? [];
        $experience = $result['experience'] ?? [];
        $education = $result['education'] ?? [];
        $summary = $result['summary'] ?? '';

        // 3. Insert the data into the filtered_resumes table
        FilteredResume::updateOrCreate(
            ['application_id' => $this->application->id],
            [
                'age'            => $result['age'] ?? 'N/A',
                'gender'         => $result['gender'] ?? 'N/A',
                'skills'         => $skills,
                'experience'     => $experience,
                'education'      => $education,
                'rating_score'   => $score,
                'ai_summary'     => $summary,
                'qualification_status' => $this->calculateStatus($score),
            ]
        );

        // 4. Update the main application status
        $this->application->update(['status' => 'Filtered']);
    }

    private function calculateStatus($score)
    {
        if ($score >= 80) return 'Highly Qualified';
        if ($score >= 50) return 'Qualified';
        return 'Not Qualified';
    }
}