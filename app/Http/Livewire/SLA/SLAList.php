<?php

namespace App\Http\Livewire\SLA;

use App\Models\SLA;
use Livewire\Component;
use Livewire\WithPagination;

class SLAList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public int $delete_user_id;

    public function render()
    {
        return view('livewire.sla.sla-list', [
            'slas' => SLA::paginate()
        ])->layoutData([
            'title'      => 'SLAs',
            'breadcrumb' => $this->getBreadcrumb()
        ]);
    }

    public function delete(int $id)
    {
        if ($sla = SLA::find($id)) {
            $sla->delete();
        }
    }
    private function getBreadcrumb()
    {
        return [
            route('dashboard') => 'Dashboard',
            route('settings')  => 'Settings',
            route('settings.sla')  => 'SLAs',
        ];
    }

}
