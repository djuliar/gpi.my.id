<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\WebConfig;
use Illuminate\Auth\Access\HandlesAuthorization;

class WebConfigPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:WebConfig');
    }

    public function view(AuthUser $authUser, WebConfig $webConfig): bool
    {
        return $authUser->can('View:WebConfig');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:WebConfig');
    }

    public function update(AuthUser $authUser, WebConfig $webConfig): bool
    {
        return $authUser->can('Update:WebConfig');
    }

    public function delete(AuthUser $authUser, WebConfig $webConfig): bool
    {
        return $authUser->can('Delete:WebConfig');
    }

    public function restore(AuthUser $authUser, WebConfig $webConfig): bool
    {
        return $authUser->can('Restore:WebConfig');
    }

    public function forceDelete(AuthUser $authUser, WebConfig $webConfig): bool
    {
        return $authUser->can('ForceDelete:WebConfig');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:WebConfig');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:WebConfig');
    }

    public function replicate(AuthUser $authUser, WebConfig $webConfig): bool
    {
        return $authUser->can('Replicate:WebConfig');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:WebConfig');
    }

}