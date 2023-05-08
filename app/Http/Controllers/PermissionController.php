<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePermissionRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return inertia('Admin/Permission/PermissionIndex', [
            'permissions' => Permission::all()
        ]);
    }
    public function create(){
        return inertia('Admin/Permission/PermissionCreate');
    }

    public function store(CreatePermissionRequest $request){
        Permission::create($request->validated());

        return to_route('permissions.index');
    }

    public function edit(Permission $permission){
        return inertia('Admin/Permission/PermissionEdit', [
            'permission' => $permission
        ]);
    }

    public function update(CreatePermissionRequest $request, Permission $permission){
        $permission->update($request->validated());
        return to_route('permissions.index');

    }

    public function destroy(Permission $permission){
        $permission->delete();
    }
}
