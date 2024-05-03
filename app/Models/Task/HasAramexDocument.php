<?php
declare(strict_types=1);


namespace App\Models\Task;


use Illuminate\Support\Facades\File;

trait HasAramexDocument
{
    public function getAramexDocument() : string
    {
        $template = $this->getTemplate();
        $this->setTemplateVariables($template);
//        File::put(resource_path('templates/test.rtf'), $template);
        return $template;
    }
    private function setTemplateVariables(string &$file) : void
    {
        $totalCards = intval($this->total_cards);
        $file = str_replace('___NAME___',  $this->contact_name ?? '', $file);
        $file = str_replace('___ADDRESS___', $this->address ?? '', $file);
        $file = str_replace('___TELEPHONE___', str_replace('+', '', $this->contact_number ?? ''), $file);
        $file = str_replace('___COUNTRY___', $this->country ?? '', $file);
        $file = str_replace('___QTY___', strval($totalCards), $file);
        $file = str_replace('___AMOUNT___', strval($totalCards * 10), $file);
    }
    private function getTemplate() : string
    {
        return File::get($this->getTemplatePath());
    }

    private function getTemplatePath() : string
    {
        return resource_path('templates/aramex2.pdf');
    }
}
