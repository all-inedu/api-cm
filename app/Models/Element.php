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
}
