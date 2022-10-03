<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Page extends Model
{
    use HasFactory;
    use HasTags;

    protected $fillable = ['title', 'project_id', 'body'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
