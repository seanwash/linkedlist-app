<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Note $note): bool
    {
        return $user->id === $note->user->id;
    }

    public function create(User $user): bool
    {
        return Auth::check();
    }

    public function update(User $user, Note $note): bool
    {
        return $user->id === $note->user->id;
    }

    public function delete(User $user, Note $note): bool
    {
        return $user->id === $note->user->id;
    }

    public function restore(User $user, Note $note): bool
    {
        return $user->id === $note->user->id;
    }

    public function forceDelete(User $user, Note $note): bool
    {
        return $user->id === $note->user->id;
    }
}
