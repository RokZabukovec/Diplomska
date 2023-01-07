<?php

namespace App\Policies;

use App\Models\Command;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CommandPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewAny(User $user): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Command $command
     * @return Response|bool
     */
    public function view(User $user, Command $command)
    {
        return $user->id === $command->user()->id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Command $command
     * @return Response|bool
     */
    public function update(User $user, Command $command)
    {
        return $user->id === $command->user()->id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Command $command
     * @return Response|bool
     */
    public function delete(User $user, Command $command)
    {
        return $user->id === $command->user()->id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

}
