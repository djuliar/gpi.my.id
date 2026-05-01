<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebConfig extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'department',
        'department_leader',
        'department_leader_nip',
        'institution',
        'ministry',
        'storage_path',
        'absolute_path',
    ];
}
