<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Import Log facade
use PhpOffice\PhpWord\TemplateProcessor;
use Response;

class WordController extends Controller
{
    public function modifyWord(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string',
            'date' => 'required|string',
            'message' => 'required|string',
        ]);

        // Path to the default template
        $templatePath = storage_path('app/templates/template.docx');

        // Check if the file exists
        if (!file_exists($templatePath)) {
            return back()->with('error', 'Template file not found.');
        }

        // Load the Word document
        $templateProcessor = new TemplateProcessor($templatePath);

        // Log inputs for debugging
        Log::info('Inputs: ', $request->all());

        // Attempt to replace placeholders with user inputs
        try {
            $templateProcessor->setValue('name', $request->name);
            $templateProcessor->setValue('date', $request->date);
            $templateProcessor->setValue('message', $request->message);
        } catch (\Exception $e) {
            Log::error('Error modifying document: ' . $e->getMessage());
            return back()->with('error', 'Failed to modify document.');
        }

        // Log the values being replaced
        Log::info('Replacing values: ', [
            'name' => $request->name,
            'date' => $request->date,
            'message' => $request->message,
        ]);

        // Save the modified document to a new file
        $modifiedFilePath = storage_path('app/temp/modified_document.docx');
        $templateProcessor->saveAs($modifiedFilePath);

        // Log document path
        Log::info('Modified file saved at: ' . $modifiedFilePath);

        // Download the modified document and delete it after sending
        return response()->download($modifiedFilePath)->deleteFileAfterSend(true);
    }
}
