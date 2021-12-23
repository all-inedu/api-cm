<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElementDetail extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'element_id',
        'answer',
        'value',
        'type_blank',
        'point'
    ];

    public function elements()
    {
        return $this->belongsTo(Element::class, 'element_id', 'id');
    }

    public function answers()
    {
        return $this->hasMany(Answers::class, 'element_id', 'id');
    }

    public function scopeWithAndWhereHas($query, $relation, $constraint){
        return $query->whereHas($relation, $constraint)
                     ->with([$relation => $constraint]);
    }
}
