<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\WorkBook;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkBookPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:WorkBook');
    }

    public function view(AuthUser $authUser, WorkBook $workBook): bool
    {
        return $authUser->can('View:WorkBook');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:WorkBook');
    }

    public function update(AuthUser $authUser, WorkBook $workBook): bool
    {
        return $authUser->can('Update:WorkBook');
    }

    public function delete(AuthUser $authUser, WorkBook $workBook): bool
    {
        return $authUser->can('Delete:WorkBook');
    }

    public function restore(AuthUser $authUser, WorkBook $workBook): bool
    {
        return $authUser->can('Restore:WorkBook');
    }

    public function forceDelete(AuthUser $authUser, WorkBook $workBook): bool
    {
        return $authUser->can('ForceDelete:WorkBook');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:WorkBook');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:WorkBook');
    }

    public function replicate(AuthUser $authUser, WorkBook $workBook): bool
    {
        return $authUser->can('Replicate:WorkBook');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:WorkBook');
    }

}