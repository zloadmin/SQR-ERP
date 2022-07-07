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
        $data = [
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
        ];
        Task::createAPI($data);
        Log::info('API request save ', $data);
    }
    public function getValue(Request $request, string $name) : string
    {
        $value = $request->get($name);
        if(is_string($value)) return $value;
        if(is_array($value)) self::getArrayText($value);
        return '';
    }
    static function getArrayText(array $data) : string
    {
        $result = '';
        foreach ($data as $key => $value) {
            if(is_array($value)) {
                $result .= self::getArrayText($value);
            }
            if(is_string($key) && strlen($key) > 2) {
                $result .= $key . ': ';
            }
            if(is_string($value)) {
                $result .= $value;
            }
            $result .= PHP_EOL;
        }
        return $result;
    }
}
