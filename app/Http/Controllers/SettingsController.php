<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function index()
    {
        return view('settings', [
            'items' => $this->getItems()
        ]);
    }
    private function getItems()
    {
        return [
            ['title' => 'Role', 'link' => route('settings.user-role')]
        ];
    }
}
