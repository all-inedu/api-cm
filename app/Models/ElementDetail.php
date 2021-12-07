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
}
