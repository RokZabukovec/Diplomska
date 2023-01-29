<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;
use Laravel\Scout\Searchable;
use Spatie\Tags\Tag;

class Contact extends Model
{
    protected $fillable = ['name', 'email', 'description'];
}
