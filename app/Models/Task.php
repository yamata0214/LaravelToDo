<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $primaryKey = 'task_id';
    protected $fillable = [
        'people_id', 'task_name', 'remarks', 'deadline',
    ];
    const UPDATED_AT = null;
}
