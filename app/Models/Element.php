<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    use HasFactory;

    protected $table = 'elements';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'part_id',
        'category_element',
        'description',
        'video_link',
        'image_path',
        'file_path',
        'question',
        'total_point',
        'order',
        'group'
    ];

    public function parts()
    {
        return $this->belongsTo(Part::class, 'part_id', 'id');
    }

    public function elementdetails()
    {
        return $this->hasMany(ElementDetail::class, 'element_id', 'id');
    }

    public function lastreads()
    {
        return $this->hasMany(LastRead::class, 'element_id', 'id');
    }

    public function answers()
    {
        return $this->hasMany(Answers::class, 'element_id', 'id');
    }

    public function answersdetails()
    {
        return $this->hasMany(AnswerDetail::class, 'element_id', 'id');
    }

    public function scopeWithAndWhereHas($query, $relation, $constraint){
        return $query->whereHas($relation, $constraint)
                     ->with([$relation => $constraint]);
    }
}
