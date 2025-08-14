<?php

namespace App\Models\Log;

use MongoDB\Laravel\Eloquent\Model;

class UserLog extends Model
{
    protected $connection = 'mongodb'; // koneksi MongoDB
    protected $collection = 'user_logs';
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'action',
        'status',
        'ip_address',
        'user_agent',
        'logged_in_at',
    ];
}
