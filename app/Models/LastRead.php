<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LastRead extends Model
{
    use HasFactory;

    protected $table = 'last_reads';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'module_id',
        'part_id',
        'group'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function modules()
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }

    public function parts()
    {
        return $this->belongsTo(Part::class, 'part_id', 'id');
    }

}
