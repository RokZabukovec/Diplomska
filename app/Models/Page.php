<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;
use Laravel\Scout\Searchable;

class Page extends Model
{
    use HasFactory;
    use HasTags;
    use Searchable;

    protected $fillable = ['title', 'project_id', 'body'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
