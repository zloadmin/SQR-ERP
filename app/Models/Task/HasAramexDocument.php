<?php
declare(strict_types=1);


namespace App\Models\Task;


use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\Exception\CopyFileException;
use PhpOffice\PhpWord\Exception\CreateTemporaryFileException;
use PhpOffice\PhpWord\TemplateProcessor;

trait HasAramexDocument
{
    /**
     * @throws CopyFileException
     * @throws CreateTemporaryFileException
     */
    public function createAramexDocument(): string
    {

        $templateProcessor = new TemplateProcessor($this->getTemplatePath());
        $totalCards = intval($this->total_cards);
        $fileName = sprintf('%d_%d.docx', $this->id, time());
        $filePath = storage_path('invoices/' . $fileName);
        $templateProcessor->setValue('name', $this->contact_name ?? '');
        $templateProcessor->setValue('address', $this->address ?? '');
        $templateProcessor->setValue('telephone', str_replace('+', '', $this->contact_number ?? ''));
        $templateProcessor->setValue('country', $this->country ?? '');
        $templateProcessor->setValue('qty', strval($totalCards));
        $templateProcessor->setValue('amount', strval($totalCards * 10));
        $templateProcessor->saveAs($filePath);

        return $filePath;
    }

    private function setTemplateVariables(string &$file): void
    {
        $totalCards = intval($this->total_cards);
        $file = str_replace('___NAME___', $this->contact_name ?? '', $file);
        $file = str_replace('___ADDRESS___', $this->address ?? '', $file);
        $file = str_replace('___TELEPHONE___', str_replace('+', '', $this->contact_number ?? ''), $file);
        $file = str_replace('___COUNTRY___', $this->country ?? '', $file);
        $file = str_replace('___QTY___', strval($totalCards), $file);
        $file = str_replace('___AMOUNT___', strval($totalCards * 10), $file);
    }

    private function getTemplate(): string
    {
        return File::get($this->getTemplatePath());
    }

    private function getTemplatePath(): string
    {
        return resource_path('templates/aramex.docx');
    }
}
