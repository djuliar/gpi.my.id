<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\WorkBookEvent;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkBookEventPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:WorkBookEvent');
    }

    public function view(AuthUser $authUser, WorkBookEvent $workBookEvent): bool
    {
        return $authUser->can('View:WorkBookEvent');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:WorkBookEvent');
    }

    public function update(AuthUser $authUser, WorkBookEvent $workBookEvent): bool
    {
        return $authUser->can('Update:WorkBookEvent');
    }

    public function delete(AuthUser $authUser, WorkBookEvent $workBookEvent): bool
    {
        return $authUser->can('Delete:WorkBookEvent');
    }

    public function restore(AuthUser $authUser, WorkBookEvent $workBookEvent): bool
    {
        return $authUser->can('Restore:WorkBookEvent');
    }

    public function forceDelete(AuthUser $authUser, WorkBookEvent $workBookEvent): bool
    {
        return $authUser->can('ForceDelete:WorkBookEvent');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:WorkBookEvent');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:WorkBookEvent');
    }

    public function replicate(AuthUser $authUser, WorkBookEvent $workBookEvent): bool
    {
        return $authUser->can('Replicate:WorkBookEvent');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:WorkBookEvent');
    }

}