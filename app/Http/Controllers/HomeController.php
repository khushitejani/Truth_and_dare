<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dare;
use App\Models\Truth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $truths = Truth::orderBy('id', 'desc')->get();
        $dares = Dare::orderBy('id', 'desc')->get();
        $categories = Category::orderBy('id', 'desc')->get();

        if ($request->ajax()) {
            return response()->json([
                'truths' => $truths->map(fn($t) => ['id' => $t->id, 'question' => $t->question, 'type' => $t->type]),
                'dares' => $dares->map(fn($d) => ['id' => $d->id, 'dare' => $d->dare, 'type' => $d->type]),
                'categories' => $categories->map(fn($c) => ['id' => $c->id, 'name' => $c->name]),
            ]);
        }

        return view('dashboard', compact('truths', 'dares', 'categories'));
    }
}
