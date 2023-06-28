<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $slug, $status, $category_id;
    public $brandId;

    public function rules() {
        return [
            'name' => 'required|string',
            'slug' => 'required|string',
            'status' => 'nullable',
            'category_id' => 'required|integer',
        ];
    }

    public function resetInput() {
        $this->name = NULL;
        $this->slug = NULL;
        $this->status = NULL;
        $this->brandId = NULL;
        $this->category_id = NULL;
    }

    public function setVariable() {
        $validatedData = $this->validate();
        $this->name = $validatedData['name'];
        $this->slug = Str::slug($validatedData['slug']);
        $this->status = $validatedData['status'];
        $this->category_id = $validatedData['category_id'];
    }

    public function storeBrand() {
        $this->setVariable();
        Brand::create([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1' : '0',
            'category_id' => $this->category_id
        ]);
        session()->flash('message', 'Brand Added');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput(); 
    }

    public function closeModal() {
        $this->resetInput();
    }

    public function openModal() {
        $this->resetInput();
    }

    public function editBrand($brandId) {
        $this->brandId = $brandId;
        $brand = Brand::findOrFail($brandId);
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->status = $brand->status;
        $this->category_id = $brand->category_id;
    }

    public function updateBrand() {
        $this->setVariable();
        Brand::findOrFail($this->brandId)->update([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1' : '0',
            'category_id' => $this->category_id
        ]);
        session()->flash('message', 'Brand Updated');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput(); 
    }

    public function deleteBrand($brandId) {
        $this->brandId = $brandId;
    }

    public function destroyBrand() {
        Brand::findOrFail($this->brandId)->delete();
        session()->flash('message', 'Brand Deleted');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput(); 
    }

    public function render()
    {
        $categories = Category::where('status', 0)->get();
        $brands = Brand::orderBy('id', 'desc')->paginate(10);
        return view('livewire.admin.brand.index', ['brands' => $brands, 'categories' => $categories])
                ->extends('layouts.admin');
    }
}
