<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;
use Laravel\Scout\Searchable;
use Spatie\Tags\Tag;

class Command extends Model
{
    use HasFactory;
    use HasTags;
    use Searchable;

    protected $fillable = ['command', 'description', 'project_id'];
    public static string $index = 'commands';
    public static array $filterable = ['user_id', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->hasOneThrough(User::class, Project::class,
        'id','id','project_id','user_id');
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();
        $array['user_id'] = $this->project()->first()->user_id;
        $array['tags'] = $this->tags()->pluck("name");
        $array['visibility'] = 'public';
        return $array;
    }
}
