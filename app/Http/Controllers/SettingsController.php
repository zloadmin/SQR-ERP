<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function index()
    {
        return view('settings.index', [
            'title' => 'Settings',
            'items' => $this->getItems(),
            'breadcrumb' => $this->getIndexBreadcrumb()
        ]);
    }
    private function getIndexBreadcrumb()
    {
        return [
            route('dashboard') => 'Dashboard',
            route('settings') => 'Settings',
        ];
    }
    private function getItems()
    {
        return [
            ['title' => 'Role', 'link' => route('settings.user-role')]
        ];
    }
}
