<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log_mails extends Model
{
    use HasFactory;

    protected $fillable = [
        'mail_to',
        'student',
        'message',
        'status'
    ];
}
