<?php

namespace App\Http\Livewire\Inventory;

use App\Models\Inventory;
use Livewire\Component;

class AddInventoryStock extends Component
{

    public Inventory $inventory;
    public string $name;
    public ?int $quantity;
    public function mount(Inventory $inventory)
    {
        $this->inventory = $inventory;
        $this->name = '';
        $this->quantity = null;
    }


    protected function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'quantity' => ['required', 'int', 'min:1', 'max:2000000000']
        ];
    }
    public function submit()
    {
        $this->validate();
        $this->inventory->stocks()->create([
            'name' => $this->name,
            'quantity' => $this->quantity
        ]);
        session()->flash('status', 'Stocks has been created');
        return redirect()->route('settings.inventory.edit', $this->inventory);
    }

    public function render()
    {
        return view('livewire.inventory.add-inventory-stock')->layoutData([
            'title'      => 'Add Stock to ' . $this->inventory->name,
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
            route('settings.inventory.edit.add-stock', $this->inventory) => 'Add Stock',
        ];
    }
}
