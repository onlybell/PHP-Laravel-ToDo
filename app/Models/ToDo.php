<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ToDo extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'description',
        'due_at',
        'completed',
        'completed_dt',
        'created_at',
        'updated_at',
    ];
}
