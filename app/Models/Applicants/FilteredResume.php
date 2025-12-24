<?php

namespace App\Models\Applicants;

use Illuminate\Database\Eloquent\Model;

class FilteredResume extends Model
{
    protected $fillable = [
        'application_id',
        'age',
        'gender',
        'skills',
        'experience',
        'education',
        'rating_score',
        'qualification_status',
        'ai_summary',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    protected $casts = [
        'skills' => 'array',
        'experience' => 'array',
        'education' => 'array',
    ];
}
