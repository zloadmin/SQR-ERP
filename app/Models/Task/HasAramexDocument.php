<?php
declare(strict_types=1);


namespace App\Models\Task;


use App\Models\TaskFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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
        $path = 'tasks/aramex_invoices/' . $fileName;
        $filePath = Storage::path($path);
        $templateProcessor->setValue('name', $this->contact_name ?? '');
        $templateProcessor->setValue('address', $this->address ?? '');
        $templateProcessor->setValue('telephone', str_replace('+', '', $this->contact_number ?? ''));
        $templateProcessor->setValue('country', $this->country ?? '');
        $templateProcessor->setValue('qty', strval($totalCards));
        $templateProcessor->setValue('amount', strval($totalCards * 10));
        $templateProcessor->saveAs($filePath);

        return $path;
    }

    public function createAramexDocumentTaskFile(): TaskFile
    {
        $path = $this->createAramexDocument();
        $fullPath = Storage::path($path);
        $originalName = pathinfo($fullPath, PATHINFO_FILENAME) . '.' . pathinfo($fullPath, PATHINFO_EXTENSION);
        return TaskFile::create([
            'task_id'       => $this->id,
            'type'          => TaskFile::ARAMEX_INVOICE,
            'path'          => $path,
            'original_name' => $originalName,
            'size'          => Storage::fileSize($path),
            'user_id'       => null,
        ]);
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
