<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SliderFormRequest;
use App\Models\Slider;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index() {
        $sliders = Slider::all();
        return view('admin.sliders.index', compact('sliders'));
    }

    
    public function create() {
        return view('admin.sliders.create');
    }

    public function store(SliderFormRequest $request) {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/sliders/', $filename);
            $validatedData['image'] = 'uploads/sliders/' . $filename;
        }

        Slider::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'],
            'status' => $request->status == true ? '1' : '0'
        ]);

        return redirect('admin/sliders')->with('message', 'Slider Added');
    }

    public function edit(Slider $slider) {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(SliderFormRequest $request, Slider $slider) {
        $validatedData = $request->validated();
        $oldImageDestination = $slider->image;

        if ($request->hasFile('image')) {
            if (File::exists($oldImageDestination)) {
                File::delete($oldImageDestination);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/sliders/', $filename);
            $validatedData['image'] = 'uploads/sliders/' . $filename;
        }

        Slider::where('id', $slider->id)->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'],
            'status' => $request->status == true ? '1' : '0'
        ]);

        return redirect('admin/sliders')->with('message', 'Slider Updated');
    }

    public function destroy(Slider $slider) {
        $imageDestination = $slider->image;
        if (File::exists($imageDestination)) {
            File::delete($imageDestination);
        }
        $slider->delete();
        return redirect('admin/sliders')->with('message', 'Slider Deleted');
    }
}
