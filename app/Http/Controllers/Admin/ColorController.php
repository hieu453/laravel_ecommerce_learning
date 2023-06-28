<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;
use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller
{
    public function index() {
        $colors = Color::all();
        return view('admin.colors.index', compact('colors'));
    }

    public function create() {
        return view('admin.colors.create');
    }

    public function store(ColorFormRequest $request) {
        $validatedData = $request->validated();
        Color::create([
            'name' => $validatedData['name'],
            'code' => $validatedData['code'],
            'status' => $request->status == true ? '1' : '0',
        ]);
        return redirect('admin/colors')->with('message', 'Color Added');
    }

    public function edit(Color $color) {
        return view('admin.colors.edit', compact('color'));
    }

    public function update(ColorFormRequest $request, int $colorId) {
        $validatedData = $request->validated();
        Color::find($colorId)->update([
            'name' => $validatedData['name'],
            'code' => $validatedData['code'],
            'status' => $request->status == true ? '1' : '0',
        ]);
        return redirect('admin/colors')->with('message', 'Color Updated');
    }

    public function destroy(int $colorId) {
        $color = Color::find($colorId);
        $color->delete();
        return redirect('admin/colors')->with('message', 'Color Deleted');
    }
}
