<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface RepositoryInterface
{
    public function getAll(int $user_id): Collection;
}
