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
     * Get the images for the todo.
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    /**
     * Get the preview image for the todo.
     */
    public function getPreviewImage()
    {
        return $this->images()->firstWhere('size_id', 1);
    }

    /**
     * Get the full image for the todo.
     */
    public function getFullImage()
    {
        return $this->images()->firstWhere('size_id', 2);
    }
}
