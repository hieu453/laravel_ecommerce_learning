<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
    public $products, $category, $brandInputs = [], $priceInput;

    protected $queryString = [
        'brandInputs' => [
            'except' => '',
            'as' => 'brand',
        ],
        'priceInput' => [
            'except' => '',
            'as' => 'price',
        ],
    ];

    public function mount($category) {
        $this->category = $category;    
    }

    public function render()
    {
        $this->products = Product::where('category_id', $this->category->id)
                                    ->where('status', 0)
                                    ->when($this->brandInputs, function ($query) {
                                        $query->whereIn('brand', $this->brandInputs);
                                    })
                                    ->when($this->priceInput, function ($query1) {
                                        $query1->when($this->priceInput == 'high-to-low', function ($query2) {
                                            $query2->orderBy('selling_price', 'desc');
                                        });
                                    })
                                    ->when($this->priceInput, function ($query1) {
                                        $query1->when($this->priceInput == 'low-to-hight', function ($query2) {
                                            $query2->orderBy('selling_price', 'asc');
                                        });
                                    })
                                    ->get();
        return view('livewire.frontend.product.index', [
            'products' => $this->products,
            'category' => $this->category,
        ]);
    }
}
