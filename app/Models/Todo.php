<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Tag;
use App\Models\Image;


class Todo extends Model
{
    use HasFactory;

    /**
     * Get the tags for the todo.
     */
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }


    /**
     * Get the preview image for the todo.
     */
    public function previewImage()
    {
        return $this->hasMany(Image::class)->where('size_id', 1);
    }

    /**
     * Get the full image for the todo.
     */
    public function fullImage()
    {
        return $this->hasMany(Image::class)->where('size_id', 2);
    }
}
