<?php

namespace App\Http\Livewire\Inventory;

use App\Models\Inventory;
use App\Models\TelegramAlert;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class InventoryList extends Component
{
    public Collection $inventories;
    public function mount()
    {
        $this->inventories = Inventory::with('stocks')->latest()->get();
    }


    public function delete(int $id)
    {
        if ($stock = Inventory::find($id)) {
            $stock->delete();
            session()->flash('warning', 'Inventory has been deleted');
            $this->mount();
        }
    }
    public function render()
    {
        return view('livewire.inventory.inventory-list')->layoutData([
            'title'      => 'Inventory',
            'breadcrumb' => $this->getBreadcrumb()
        ]);
    }

    private function getBreadcrumb()
    {
        return [
            route('dashboard') => 'Dashboard',
            route('settings')  => 'Settings',
            route('settings.inventory-list')  => 'Inventory',
        ];
    }

}
