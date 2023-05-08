<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserRevokeRoleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user, Role $role)
    {
        $user->removeRole($role);
        return back();
    }
}
