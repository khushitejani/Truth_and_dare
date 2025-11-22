<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Truth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;

class TruthController extends Controller
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
            'question' => 'required|string',
            'category_id' => 'nullable|string'
        ]);

        Truth::create([
            'question' => $request->question,
            'type' => $request->category_id,
        ]);

        return response()->json(['success' => true, 'message' => 'Truth saved successfully']);
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
        $truth = Truth::findOrFail($id);
        return response()->json([
            'id' => $truth->id,
            'question' => $truth->question,
            'type' => $truth->type, // or 'type' field in DB
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'question' => 'required|string',
            'category_id' => 'nullable|string'
        ]);

        $truth = Truth::findOrFail($id);

        $truth->update([
            'question' => $request->question,
            'type' => $request->category_id,
        ]);

        return response()->json(['success' => true, 'message' => 'Truth updated successfully', 'id' => $truth->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $truth = Truth::findOrFail($id);
        $truth->delete();

        return response()->json(['success' => true, 'message' => 'Truth deleted successfully']);
    }
    public function importTruth(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlsx,xls',
        ]);

        $file = $request->file('file');
        $path = $file->getRealPath();

        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, false);

        $header = array_map('strtolower', $rows[0]);

        $questionIndex = array_search('question', $header);
        $typeIndex     = array_search('type', $header);

        if ($questionIndex === false || $typeIndex === false) {
            return response()->json([
                'success' => false,
                'message' => 'The file must contain column headers: question, type'
            ], 422);
        }

        unset($rows[0]);

        foreach ($rows as $row) {

            $question = trim($row[$questionIndex] ?? '');
            $typeName = ucfirst(strtolower(trim($row[$typeIndex] ?? '')));

            if (!$question || !$typeName) continue;

            $category = Category::firstOrCreate(['name' => $typeName]);

            $truth = Truth::create([
                'question' => $question,
                'type'     => $category->id
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Truths imported successfully'
        ]);
    }
}
