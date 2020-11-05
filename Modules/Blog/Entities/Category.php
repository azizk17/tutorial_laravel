<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Modules\Blog\Database\Factories\CategoryFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        
        return \Modules\Blog\Database\Factories\CategoryFactory::new();
    }
}
