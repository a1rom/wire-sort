<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public int $showPerPage = 5;

    /**
     * @var array<string, string>
     */
    public array $filters = [
        'producer' => '',
        'inStock' => '',
    ];

    public function render() : View
    {
        return view('livewire.product.index', [
            'products' => $this->getProducts(),
        ]);
    }

    public function paginationView() : string
    {
        return 'components.pagination';
    }

    /**
     * @return \Illuminate\Pagination\LengthAwarePaginator<Product>
     */
    private function getProducts() : \Illuminate\Pagination\LengthAwarePaginator
    {
        return Product::with('producer')
            ->latest()
            ->paginate($this->showPerPage);
    }
}
