<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Todo;


class Tag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['text'];


    /**
     * Get the Todo that owns the tag.
     */
    public function todo()
    {
        return $this->belongsTo(Todo::class);
    }
}
