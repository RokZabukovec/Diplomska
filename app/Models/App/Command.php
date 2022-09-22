<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use Spatie\Tags\HasTags;

class Command extends Model
{
    use HasFactory;
    use Searchable;
    use HasTags;

    protected $fillable = ['command', 'description', 'project_id', 'user_id'];

    /**
     * Get the value used to index the model.
     *
     * @return mixed
     */
    public function getScoutKey()
    {
        return $this->getKey();
    }

    /**
     * Get the key name used to index the model.
     *
     * @return mixed
     */
    public function getScoutKeyName()
    {
        return 'id';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();
        $array['project_id'] = $this->project_id;

        return $array;
    }

    public static function getFilterableAttributes(): array
    {
        return [
            'project_id',
            'user_id',
        ];
    }

    public static function getSortingAttributes(): array
    {
        return [
            'command',
            'created_at',
        ];
    }

    public function projects()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'entity_id');
    }
}
