<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function created(User $user): void
    {
        saveActivityLog([
            'event' => 'Created',
            'description' => "Created user {$user->name}",
        ], $user);
    }

    public function updated(User $user): void
    {
        saveActivityLog([
            'event' => 'Updated',
            'description' => "Updated user {$user->name}",
        ], $user);
    }

    public function deleted(User $user): void
    {
        saveActivityLog([
            'event' => 'Deleted',
            'description' => "Deleted user {$user->name}",
        ], $user);
    }

    public function restored(User $user): void
    {
        saveActivityLog([
            'event' => 'Restored',
            'description' => "Restored user {$user->name}",
        ], $user);
    }

    public function forceDeleted(User $user): void
    {
        saveActivityLog([
            'event' => 'Force Deleted',
            'description' => "Force deleted user {$user->name}",
        ], $user);
    }
}
