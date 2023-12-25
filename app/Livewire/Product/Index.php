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
        'inStock' => '-1',
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
    private function getProducts(bool $all = false) : \Illuminate\Pagination\LengthAwarePaginator
    {
        if($all) {
            return Product::with('producer')
                ->latest()
                ->paginate($this->showPerPage);
        }

        return Product::with('producer')
            ->when($this->filters['producer'], function($query, $producer) {
                $query->whereHas('producer', function($query) use ($producer) {
                    $query->where('name', 'like', "%{$producer}%");
                });
            })
            ->when($this->filters['inStock'] !== '-1', function($query) {
                $query->when($this->filters['inStock'] === '1', function($query) {
                    $query->where('stock', '>', 0);
                });

                $query->when($this->filters['inStock'] === '0', function($query) {
                    $query->where('stock', '=', 0);
                });
            })
            ->latest()
            ->paginate($this->showPerPage);
    }

    public function clearSearch() : void
    {
        $this->filters = [
            'producer' => '',
            'inStock' => '-1',
        ];
    }

    public function makeSearch() : void
    {
        $this->resetPage();
    }
}
