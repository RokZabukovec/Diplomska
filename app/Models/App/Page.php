<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class Page extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['title', 'body', 'project_id'];

    protected $searchableFields = ['*'];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->toArray();
    }

    public static function getFilterableAttributes(): array
    {
        return [
            'project_id',
        ];
    }

    public static function getSortingAttributes(): array
    {
        return [
            'title',
            'created_at',
        ];
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
