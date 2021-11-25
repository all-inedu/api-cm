<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outline extends Model
{
    use HasFactory;

    protected $table = 'outlines';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'module_id',
        'section_id',
        'name',
        'desc'
    ];

    public function modules()
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }

    public function sections()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function parts()
    {
        return $this->hasMany(Part::class, 'outline_id', 'id');
    }
}
