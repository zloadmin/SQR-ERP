<?php

namespace App\Http\Livewire\SLAColorExpired;

use App\Models\SLA;
use App\Models\SlaExpiredColor;
use Livewire\Component;
use Livewire\WithPagination;

class SlaExpiredColorList extends Component
{
    use WithPagination;


    protected $paginationTheme = 'bootstrap';
    public int $delete_user_id;

    public function render()
    {
        return view('livewire.sla-expired-color.sla-expired-color-list', [
            'sla_expired_colors' => SlaExpiredColor::with('stage')->paginate()
        ])->layoutData([
            'title'      => 'SLA expired colors',
            'breadcrumb' => $this->getBreadcrumb()
        ]);
    }

    public function delete(int $id)
    {
        if ($sla = SlaExpiredColor::find($id)) {
            $sla->delete();
            session()->flash('warning', 'SLA expired color has been deleted');
        }
    }

    private function getBreadcrumb()
    {
        return [
            route('dashboard')                  => 'Dashboard',
            route('settings')                   => 'Settings',
            route('settings.sla-expired-color') => 'SLA expired colors',
        ];
    }

}
