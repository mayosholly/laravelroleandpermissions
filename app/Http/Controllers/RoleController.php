<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return inertia('Admin/Role/RoleIndex', [
            'roles' => Role::all()
        ]);
    }

    public function create(){
        return inertia('Admin/Role/RoleCreate', [
            'permissions'=> Permission::all()
        ]);
    }

    public function store(CreateRoleRequest $request){
        $role = Role::create([
            'name' => $request->name
        ]);
        if($request->has('permission')){
            $role->syncPermissions($request->input('permissions.*.name'));
        }
        return to_route('roles.index');
    }

    public function edit(Role $role){
        return inertia('Admin/Role/RoleEdit', [
            'role' => $role->load('permissions'),
            'permissions'=> Permission::all()
        ]);
    }

    public function update(CreateRoleRequest $request, Role $role){
        $role->update([
            'name' => $request->name
        ]);
        $role->syncPermissions($request->input('permissions.*.name'));
        return back();

    }

    public function destroy(Role $role){
        $role->delete();
        return to_route('roles.index');

    }
}
