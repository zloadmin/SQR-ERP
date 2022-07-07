<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function create(Request $request)
    {
        Log::info('API request', $request->toArray());
        Task::createAPI([
            'stage_id' => 1,
            'name' => $request->get('name'),
            'company_name' => $request->get('company_name'),
            'it_is' => $request->get('it_is'),
            'material' => $request->get('material'),
            'total_cards' => $request->get('total_cards'),
            'instruction' => $request->get('instruction'),
            'background' => $request->get('background'),
            'design_comments' => $request->get('design_comments'),
            'card_details' => $request->get('card_details'),
            'contact_name' => $request->get('contact_name'),
            'contact_number' => $request->get('contact_number'),
            'whatsapp' => $request->get('whatsapp'),
            'contact_email' => $request->get('contact_email'),
            'delivery_method' => $request->get('delivery_method'),
            'emirate' => $request->get('emirate'),
            'address' => $request->get('address')
        ]);
    }
}
