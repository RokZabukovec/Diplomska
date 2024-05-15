<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use Spatie\Tags\HasTags;
use Spatie\Tags\Tag;

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
    public function getScoutKey(): mixed
    {
        return $this->getKey();
    }

    /**
     * Get the key name used to index the model.
     *
     * @return string
     */
    public function getScoutKeyName(): string
    {
        return 'id';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray(): array
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

    public function projects(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'entity_id');
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }
}
