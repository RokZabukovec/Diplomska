<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;
use Laravel\Scout\Searchable;

class Command extends Model
{
    use HasFactory;
    use HasTags;
    use Searchable;

    protected $fillable = ['command', 'description', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->hasOneThrough(User::class, Project::class,
        'id','id','project_id','user_id');    
    }
    
    /**
     * Modify the query used to retrieve models when making all of the models searchable.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function makeAllSearchableUsing($query)
    {
        return $query->with('user')->pluck('id');
    }
}
