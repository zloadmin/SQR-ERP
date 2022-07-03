<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function index()
    {
        return view('user-role.index', [
            'title'      => 'Role Management',
            'user_roles' => UserRole::query()->paginate(),
            'breadcrumb' => $this->getIndexBreadcrumb()
        ]);
    }

    public function create()
    {
        return view('user-role.create', [
            'title'      => 'Create Role',
            'breadcrumb' => $this->getCreateBreadcrumb()
        ]);
    }

    public function edit(UserRole $userRole)
    {
        return view('user-role.edit', [
            'title'      => $userRole->getEditTitle(),
            'breadcrumb' => $this->getEditBreadcrumb($userRole),
            'user_role'  => $userRole
        ]);
    }

    public function delete(UserRole $user_role)
    {
        if ($user_role->hasUsers()) {
            return redirect()->back()->with('error', 'Role cannot delete. Role has users.');
        }
        $user_role->delete();
        return redirect()->back()->with('warning', 'Role has been deleted');
    }

    private function getIndexBreadcrumb(): array
    {
        return [
            route('dashboard')          => 'Dashboard',
            route('settings')           => 'Settings',
            route('settings.user-role') => 'Role Management',
        ];
    }
    private function getCreateBreadcrumb(): array
    {
        return array_merge($this->getIndexBreadcrumb(), [ '' => 'Create Role' ]);
    }

    private function getEditBreadcrumb(UserRole $user_role): array
    {
        return array_merge($this->getIndexBreadcrumb(), [ $user_role->getEditLink() => $user_role->getEditTitle() ]);
    }
}
