@props([
    'object',
    'data',
    'dataShowKey',
    'dataShowKey2' => false,
    'selectMethod',
    'selected',
    'required' => false,
    'readonly' => false,
    'combobox' => true,
    'formName' => 'form',
])

@php
    !$formName ?? $formName = 'form';
@endphp

<div x-data="{ search: false }"
    x-on:keydown.escape="search = false" 
    class="relative">
    <div class="flex gap-x-2 items-center">
        @php
            if($readonly) {
                $combobox = false;
            }
        @endphp
        <x-form.input id="{{$object}}" type="text" name="{{$object}}" label="{{ str_replace('_', ' ', ucfirst($object)) }}" 
            xonFocus="search = true;"
            :wiremodelDebounce="sprintf('%s.%s', $formName, $object)"
            :error="$errors->first(sprintf('%s.%s_id', $formName, $object))" 
            required="{{ $required }}"
            readonly="{{ $readonly }}"
            combobox="{{ $combobox }}"
            class="w-full"
            />
        <div class="mt-4">
            <x-button size="md" text="Clear" color="soft-blue" method="clearForm('{{ $object }}')" />
        </div>
    </div>
    
    @if(count($data) > 0)
        <div x-show="search"
            x-cloak
            class="relative">
            <ul class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base drop-shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                @foreach ($data as $index => $value)
                    <li wire:click="{{$selectMethod}}({{ $value['id'] }})">
                        <div                         
                            class="{{$value['id'] == $selected ? 'font-bold bg-blue-100 ' : ''}}text-gray-900 relative cursor-default select-none py-2 pl-8 pr-4 hover:bg-slate-300">
                            {{ $value[$dataShowKey] }} 
                            @if ($dataShowKey2)
                                ({{ $value[$dataShowKey2] }})
                            @endif
                            @if ($value['id'] == $selected)
                                {{-- Highlighted: "text-white", Not Highlighted: "text-slate-600" --}}
                                <span class="text-slate-600 absolute inset-y-0 left-0 flex items-center pl-1.5">
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
