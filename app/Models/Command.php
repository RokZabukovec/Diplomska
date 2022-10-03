<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Command extends Model
{
    use HasFactory;
    use HasTags;

    protected $fillable = ['command', 'description', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
