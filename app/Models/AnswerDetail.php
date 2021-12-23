<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerDetail extends Model
{
    use HasFactory;

    protected $table = 'answer_detail';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'element_id',
        'element_detail_id',
        'user_id',
        'answer',
        'file_path',
        'value_from_multiple'
    ];

    public function elements()
    {
        return $this->belongsTo(Element::class, 'element_id', 'id');
    }

    public function scopeWithAndWhereHas($query, $relation, $constraint){
        return $query->whereHas($relation, $constraint)
                     ->with([$relation => $constraint]);
    }
}
