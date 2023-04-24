<?php

namespace App\Http\Livewire\Inventory;

use App\Models\Inventory;
use App\Models\InventoryStock;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;

class EditInventory extends Component
{
    public Inventory $inventory;
    public Collection $stocks;
    public int $cumulative;
    public int $used;

    public function mount(Inventory $inventory)
    {
        $this->inventory = $inventory;
        $this->stocks = $this->inventory->stocks()->get();
        $this->cumulative = $this->inventory->cumulative;
        $this->used = $this->inventory->used;
    }

    public function delete(int $id)
    {
        if ($stock = InventoryStock::find($id)) {
            $stock->delete();
            session()->flash('warning', 'Stock has been deleted');
            $this->mount($this->inventory);
        }
    }
    public function render()
    {
        return view('livewire.inventory.edit-inventory')->layoutData([
            'title'      => $this->inventory->name,
            'breadcrumb' => $this->getBreadcrumb()
        ]);
    }

    private function getBreadcrumb()
    {
        return [
            route('dashboard')                                 => 'Dashboard',
            route('settings')                                  => 'Settings',
            route('settings.inventory-list')                   => 'Inventory',
            route('settings.inventory.edit', $this->inventory) => 'Edit Inventory  ' . $this->inventory->name,
        ];
    }
}
