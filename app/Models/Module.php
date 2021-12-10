<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $table = 'modules';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'module_name',
        'desc',
        'category_id',
        'price',
        'thumbnail',
        'status',
        'progress',
        'slug'
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function outlines()
    {
        return $this->hasMany(Outline::class, 'module_id', 'id');
    }
}
