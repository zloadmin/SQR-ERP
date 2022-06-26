<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public int $delete_user_id;

    public function render()
    {
        return view('livewire.user.user-list', [
            'users' => User::paginate()
        ])->layoutData([
            'title'      => 'Users',
            'breadcrumb' => $this->getBreadcrumb()
        ]);
    }

    public function delete(int $id)
    {
        if ($user = User::find($id)) {
            $user->delete();
        }
    }
    private function getBreadcrumb()
    {
        return [
            route('dashboard') => 'Dashboard',
            route('settings')  => 'Settings',
            route('settings.user')  => 'Users',
        ];
    }

}
