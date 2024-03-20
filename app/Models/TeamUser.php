<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class TeamUser extends Model
{
    use Searchable;

    protected $table = 'team_user';

    public function toSearchableArray()
    {
        $array = $this->toArray();

        return $array;
    }

    public function User(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Team()
    {
        return $this->belongsTo(Team::class);
    }
}
