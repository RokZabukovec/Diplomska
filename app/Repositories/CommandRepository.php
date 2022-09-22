<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\RepositoryInterface;

class CommandRepository implements RepositoryInterface
{
    public function getAll(int $user_id): Collection
    {
        // TODO: Implement getAll() method.
    }
}
