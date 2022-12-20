<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;
use Laravel\Scout\Searchable;
use Spatie\Tags\Tag;

class Tool extends Model
{
    use HasFactory;
    use HasTags;
    use Searchable;

    protected $fillable = ['title', 'description'];
}
