<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use OpenAI;
use OpenAI\Client;
use OpenAI\Contracts\ClientContract;
use OpenAI\Laravel\Exceptions\ApiKeyIsMissing;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ClientContract::class, function (): Client {
            $apiKey = config('openai.api_key');
            $organization = config('openai.organization');
            $project = config('openai.project');
            $baseUri = config('openai.base_uri');

            if (! is_string($apiKey) || ($organization !== null && ! is_string($organization))) {
                throw ApiKeyIsMissing::create();
            }

            $guzzleOptions = [
                'timeout' => config('openai.request_timeout', 30),
            ];

            if ($this->app->environment('local')) {
                $guzzleOptions['verify'] = false;
            }

            $client = OpenAI::factory()
                ->withApiKey($apiKey)
                ->withOrganization($organization)
                ->withHttpClient(new \GuzzleHttp\Client($guzzleOptions));

            if (is_string($project)) {
                $client->withProject($project);
            }

            if (is_string($baseUri)) {
                $client->withBaseUri($baseUri);
            }

            return $client->make();
        });

        $this->app->alias(ClientContract::class, 'openai');
        $this->app->alias(ClientContract::class, Client::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
    }
}
