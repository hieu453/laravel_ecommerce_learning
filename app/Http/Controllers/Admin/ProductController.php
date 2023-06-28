<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Color;
use App\Models\ProductColor;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create() {
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::where('status', '0')->get();
        return view('admin.products.create', compact('categories', 'brands', 'colors'));
    }

    public function store(ProductFormRequest $request) {
        $validatedData = $request->validated();
        $category = Category::findOrFail($validatedData['category_id']);
        $product = $category->products()->create([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['slug']),
            'brand' => $validatedData['brand'],
            'small_description' => $validatedData['small_description'],
            'description' => $validatedData['description'],
            'original_price' => $validatedData['original_price'],
            'selling_price' => $validatedData['selling_price'],
            'quantity' => $validatedData['quantity'],
            'trending' => $request->trending == true ? '1' : '0',
            'status' => $request->status == true ? '1' : '0',
            'meta_title' => $validatedData['meta_title'],
            'meta_keyword' => $validatedData['meta_keyword'],
            'meta_description' => $validatedData['meta_description'],
        ]);
  
        if ($request->hasFile('image')) {
            $uploadPath = 'uploads/products/';

            $i = 0;
            foreach ($request->file('image') as $imageFile) {
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time(). $i++. '.' .$extension;
                $imageFile->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath.$filename;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName
                ]);
            }
        }
        
        if ($request->colors) {
            foreach ($request->colors as $key => $color) {
                $product->productColors()->create([
                    'product_id' => $product->id,
                    'color_id' => $color,
                    'quantity' => $request->colorquantity[$key] ?? 0
                ]);
            }
        }

        return redirect('/admin/products')->with('message', 'Product Added');
    }

    public function edit($product_id) {
        $categories = Category::all();
        $brands = Brand::all();
        $product = Product::findOrFail($product_id);
        $productColorId = $product->productColors->pluck('color_id');
        $colors = Color::whereNotIn('id', $productColorId)->get();
        return view('admin.products.edit', compact('categories', 'brands', 'product', 'colors'));
    }

    public function update(ProductFormRequest $request, int $product_id) {
        $validatedData = $request->validated();
        $product = Category::findOrFail($validatedData['category_id'])
                    ->products()->where('id', $product_id)->first();
        if ($product) {
            $product->update([
                'category_id' => $validatedData['category_id'],
                'name' => $validatedData['name'],
                'slug' => Str::slug($validatedData['slug']),
                'brand' => $validatedData['brand'],
                'small_description' => $validatedData['small_description'],
                'description' => $validatedData['description'],
                'original_price' => $validatedData['original_price'],
                'selling_price' => $validatedData['selling_price'],
                'quantity' => $validatedData['quantity'],
                'trending' => $request->trending == true ? '1' : '0',
                'status' => $request->status == true ? '1' : '0',
                'meta_title' => $validatedData['meta_title'],
                'meta_keyword' => $validatedData['meta_keyword'],
                'meta_description' => $validatedData['meta_description'],
            ]);

            if ($request->hasFile('image')) {
                $uploadPath = 'uploads/products/';
    
                $i = 0;
                foreach ($request->file('image') as $imageFile) {
                    $extension = $imageFile->getClientOriginalExtension();
                    $filename = time(). $i++. '.' .$extension;
                    $imageFile->move($uploadPath, $filename);
                    $finalImagePathName = $uploadPath.$filename;
    
                    $product->productImages()->create([
                        'product_id' => $product->id,
                        'image' => $finalImagePathName
                    ]);
                }
            }

            if ($request->colors) {
                foreach ($request->colors as $key => $color) {
                    $product->productColors()->create([
                        'product_id' => $product->id,
                        'color_id' => $color,
                        'quantity' => $request->colorquantity[$key] ?? 0
                    ]);
                }
            }
            
            return redirect('admin/products')->with('message', 'Product Updated!');
        } else {
            return redirect('admin/products')->with('message', 'No such product found!');
        }
    }

    public function destroyImage(int $productImageId) {
        $productImage = ProductImage::findOrFail($productImageId);
        if (File::exists($productImage->image)) {
            File::delete($productImage->image);
        }
        $productImage->delete();
        return redirect()->back()->with('message', 'Product Image Deleted');
    }

    public function destroy(int $productId) {
        $product = Product::findOrFail($productId);
        if ($product->productImages) {
            foreach ($product->productImages as $image) {
                if (File::exists($image->image)) {
                    File::delete($image->image);
                }
            }
        }
        $product->delete();
        return redirect()->back()->with('message', 'Product Deleted');
    }

    public function updateProductColorQuantity(Request $request, $productColorId) {
        $productColorData = Product::findOrFail($request->productId)
                            ->productColors()->where('color_id', $productColorId)->first();
        $productColorData->update([
            'quantity' => $request->quantity
        ]);

        return response()->json(['message' => 'Product Color Quantity updated']);
    }

    public function deleteProductColor($productColorId) {
        $productColor = ProductColor::where('color_id', $productColorId)->first();
        $productColor->delete();
        return response()->json(['message' => 'Product Color Quantity deleted']);
    }
}
