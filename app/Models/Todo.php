<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Tag;


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
}
