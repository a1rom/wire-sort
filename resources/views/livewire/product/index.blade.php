<div class="flex flex-col gap-y-3">
    <div class="flex flex-col gap-y-2 sm:flex-row justify-between">
        <div class="font-semibold text-xl text-slate-700">
            Products Index
        </div>

        <div>
            <a href="">
                <x-button color="green" width="xl" text="Add Product"/>
            </a>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <x-alert type="success">
            {{ session('success') }}
        </x-alert>
    @endif

    @if(session('error'))
        <x-alert type="danger">
            {{ session('error') }}
        </x-alert>
    @endif

    {{-- Search input --}}
    <div class="flex flex-col gap-y-1">
        <div class="grid grid-cols-12 gap-2">
            <x-form.input
                id="search_producer"
                name="search.producer"
                label="Producer"
                class="col-span-12 sm:col-span-8"
                placeholder="Producer"
                wiremodel="filters.producer" />

            <x-form.select
                id="search_in_stock"
                name="search.in_stock"
                label="In Stock"
                :options="config('app-data.settings.inStock')"
                withKey="true"
                class="col-span-12 sm:col-span-4"
                wiremodelChange="filters.inStock" />
        </div>

        <div class="flex gap-x-2">
            <x-button color="blue" method="makeSearch" width="lg" text="Search"/>
            
            <x-button color="soft-blue" method="clearSearch" width="xl" text="Clear Search"/>
        </div>
    </div>
    
    {{-- Table --}}
    <div class="border rounded-md overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-200">
                <tr class="">
                    <x-table.th-cell value="Producer" />
                    <x-table.th-cell value="Product Name" />
                    <x-table.th-cell value="Price" />
                    <x-table.th-cell value="Stock" />

                    <th scope="col" class="py-3.5 pl-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($products as $product)

                @php
                    $rowClasses = '';
                    if ($loop->iteration % 2 == 0) {
                        $rowClasses .= ' bg-slate-100';
                    }
                @endphp

                <tr class="{{ $rowClasses }} hover:bg-emerald-50">
                    <x-table.td-cell value="{{ $product->producer->name }}" />
                    <x-table.td-cell value="{{ $product->name }}" />
                    <x-table.td-cell value="{{ $product->price  }}" />
                    <x-table.td-cell value="{{ $product->stock }}" />
                    
                    <td class="py-3.5 px-3">
                        <div class="flex flex-col md:flex-row gap-2">

                            <x-button text="View" size="xs" color="soft-blue"/>

                            <x-button text="Edit" size="xs" color="blue"/>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Show per Page --}}
    <div class="w-12 flex gap-x-2">
        <x-form.input
            id="show_per_page"
            name="show_per_page"
            label="Show per page"
            wiremodel="showPerPage"
            />
        <div class="self-end mb-2.5">

            <x-button color="blue" method="makeSearch" text="Go" />
        </div>
    </div>

    {{-- Pagination --}}
    {{ $products->links() }}
</div>
