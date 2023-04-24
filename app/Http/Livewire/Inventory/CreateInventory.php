<?php

namespace App\Http\Livewire\Inventory;

use App\Models\Inventory;
use App\Models\TelegramAlert;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateInventory extends Component
{

    public string $name;
    public function mount()
    {
        $this->name = '';
    }
    protected function rules()
    {
        return [
            'name' => ['required', 'max:255', Rule::unique('inventories', 'name')],
        ];
    }

    public function submit()
    {
        $this->validate();
        $inventory = Inventory::create(['name' => $this->name]);
        session()->flash('status', 'Inventory has been created');
        return redirect()->route('settings.inventory.edit', $inventory);
    }

    public function render()
    {
        return view('livewire.inventory.create-inventory')->layoutData([
            'title'      => 'Create Inventory',
            'breadcrumb' => $this->getBreadcrumb()
        ]);
    }
    private function getBreadcrumb()
    {
        return [
            route('dashboard') => 'Dashboard',
            route('settings')  => 'Settings',
            route('settings.inventory-list')  => 'Inventory',
            route('settings.inventory.create')  => 'Create Inventory',
        ];
    }
}
