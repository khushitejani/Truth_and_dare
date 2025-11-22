<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dare;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Log;


class DareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dare' => 'required|string',
            'category_id' => 'nullable|string'
        ]);

        Dare::create([
            'dare' => $request->dare,
            'type' => $request->category_id,
        ]);

        return response()->json(['success' => true, 'message' => 'Dare saved successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dare = Dare::findOrFail($id);
        return response()->json([
            'id' => $dare->id,
            'dare' => $dare->dare,
            'type' => $dare->type,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'dare' => 'required|string',
            'category_id' => 'nullable|string'
        ]);

        $dare = Dare::findOrFail($id);

        $dare->update([
            'dare' => $request->dare,
            'type' => $request->category_id,
        ]);

        return response()->json(['success' => true, 'message' => 'Dare updated successfully', 'id' => $dare->id]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dare = Dare::findOrFail($id);
        $dare->delete();

        return response()->json(['success' => true, 'message' => 'Dare deleted successfully']);
    }
    public function importDare(Request $request)
{
    try {
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlsx,xls',
        ]);

     Log::warning('Import Dare failed: Invalid headers', ['headers' => $request->all()]);
        $file = $request->file('file');
        $path = $file->getRealPath();

        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, false);

        $header = array_map('strtolower', $rows[0]);

        $questionIndex = array_search('dare', $header);
        $typeIndex     = array_search('type', $header);

        if ($questionIndex === false || $typeIndex === false) {
            Log::warning('Import Dare failed: Invalid headers', ['headers' => $header]);
            return response()->json([
                'success' => false,
                'message' => 'The file must contain column headers: dare, type'
            ], 422);
        }

        unset($rows[0]); // remove header

        foreach ($rows as $row) {
            $question = trim($row[$questionIndex] ?? '');
            $typeName = ucfirst(strtolower(trim($row[$typeIndex] ?? '')));

            if (!$question || !$typeName) continue;

            $category = \App\Models\Category::firstOrCreate(['name' => $typeName]);

            \App\Models\Dare::create([
                'dare' => $question,
                'type' => $category->id
            ]);
        }

        Log::info('Dare import successful', ['file' => $file->getClientOriginalName()]);

        return response()->json([
            'success' => true,
            'message' => 'Dares imported successfully'
        ]);
    } catch (\Exception $e) {
        Log::error('Dare import failed', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Unexpected error occurred during import'
        ], 500);
    }
}

    // public function importDare(Request $request)
    // {
    //     $request->validate([
    //         'file' => 'required|mimes:csv,txt,xlsx,xls',
    //     ]);

    //     $file = $request->file('file');
    //     $path = $file->getRealPath();

    //     $spreadsheet = IOFactory::load($path);
    //     $sheet = $spreadsheet->getActiveSheet();
    //     $rows = $sheet->toArray(null, true, true, false);

    //     $header = array_map('strtolower', $rows[0]);

    //     $questionIndex = array_search('dare', $header);
    //     $typeIndex     = array_search('type', $header);

    //     if ($questionIndex === false || $typeIndex === false) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'The file must contain column headers: question, type'
    //         ], 422);
    //     }

    //     unset($rows[0]);

    //     foreach ($rows as $row) {

    //         $question = trim($row[$questionIndex] ?? '');
    //         $typeName = ucfirst(strtolower(trim($row[$typeIndex] ?? '')));

    //         if (!$question || !$typeName) continue;

    //         $category = Category::firstOrCreate(['name' => $typeName]);

    //         $truth = Dare::create([
    //             'dare' => $question,
    //             'type'     => $category->id
    //         ]);
    //     }

    
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Truths imported successfully'
    //     ]);
    // }
}
