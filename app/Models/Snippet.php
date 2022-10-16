<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Snippet extends Model
{
    use HasFactory;
    use HasTags;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
