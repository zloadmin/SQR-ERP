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
            'name' => $this->getValue($request, 'name'),
            'company_name' => $this->getValue($request, 'company_name'),
            'it_is' => $this->getValue($request, 'it_is'),
            'material' => $this->getValue($request, 'material'),
            'total_cards' => $this->getValue($request, 'total_cards'),
            'instruction' => $this->getValue($request, 'instruction'),
            'background' => $this->getValue($request, 'background'),
            'design_comments' => $this->getValue($request, 'design_comments'),
            'card_details' => $this->getValue($request, 'card_details'),
            'contact_name' => $this->getValue($request, 'contact_name'),
            'contact_number' => $this->getValue($request, 'contact_number'),
            'whatsapp' => $this->getValue($request, 'whatsapp'),
            'contact_email' => $this->getValue($request, 'contact_email'),
            'delivery_method' => $this->getValue($request, 'delivery_method'),
            'emirate' => $this->getValue($request, 'emirate'),
            'address' => $this->getValue($request, 'address')
        ]);
    }
    public function getValue(Request $request, string $name) : string
    {

        $value = $request->get($name);
        if(is_string($value)) return $value;

        $value = $request->get($name);
        if(is_iterable($value)) {
            $return_value = '';
            foreach ($value as $k => $v) {
                Log::info($value, [$k => $v]);
                if(is_string($k)) {
                    $return_value .= $k . ': ';
                }
                if(is_string($v)) {
                    $return_value .= $v;
                }
                $return_value .= PHP_EOL;
            }
            return $return_value;
        }
        return '';
    }
}
