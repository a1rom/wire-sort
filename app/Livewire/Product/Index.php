<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $showPerPage = 5;

    public array $filters = [
        'producer' => '',
        'inStock' => '',
    ];

    public function render()
    {
        return view('livewire.product.index');
    }

    public function paginationView() : string
    {
        return 'components.pagination';
    }

    private function getProducts()
    {
        return Product::with('producer')
            ->latest()
            ->paginate($this->showPerPage);
    }
}
