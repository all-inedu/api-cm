<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'outline_id',
        'title'
    ];

    public function outlines()
    {
        return $this->belongsTo(Outline::class, 'outline_id', 'id');
    }

    public function elements()
    {
        return $this->hasMany(Element::class, 'part_id', 'id');
    }

    public function lastreads()
    {
        return $this->hasMany(LastRead::class, 'part_id', 'id');
    }

    public function scopeWithAndWhereHas($query, $relation, $constraint){
        return $query->whereHas($relation, $constraint)
                     ->with([$relation => $constraint]);
    }
}
