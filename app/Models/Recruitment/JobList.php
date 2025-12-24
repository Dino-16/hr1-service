<?php

namespace App\Models\Recruitment;

use Illuminate\Database\Eloquent\Model;

class JobList extends Model
{
    protected $table = 'job_lists';

    protected $fillable = [
        'position',
        'description',
        'type',
        'arrangement',
        'expiration_date',
        'status',
    ];
}
