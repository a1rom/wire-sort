@props([
    'id',
    'name',
    'type' => 'text',
    'label' => false,
    'placeholder' => false,
    'value' => false,
    'error' => false,
    'readonly' => false,
    'wiremodel' => false,
    'wiremodelDebounce' => false,
    'class' => false,
    'required' => false,
    'xonFocus' => false,
    'combobox' => false,
])

@php
    $styleClass = $error ? ' text-red-900 ring-red-300 placeholder:text-red-300 focus:ring-red-500' 
        : ' text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-blue-600';

    if ($readonly) {
        $styleClass .= ' bg-gray-100';
    }

    $nameForOld = str_replace('[', '.', $name);
    $nameForOld = str_replace(']', '', $nameForOld);

    $oldValue = old($nameForOld) ? old($nameForOld) : false;
    if ($oldValue) {
        if(str_contains($oldValue, '[')) {
            $value = str_replace('[', '.', $oldValue);
            $value = str_replace(']', '', $value);
        } else {
            $value = $oldValue;
        }
    } elseif ($value) {
        $value = $value;
    } else {
        $value = '';
    }
    
    if($xonFocus) {
        $xonBlur = str_replace('true', 'false', $xonFocus);   
    }
@endphp
<div class="mb-2 {{ $class }}"
    @if ($wiremodel OR $wiremodelDebounce)
        wire:loading.class="opacity-50 cursor-not-allowed"
    @endif
    >
    
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium leading-6 text-gray-900 whitespace-nowrap">
            {{ $label }} {{ $required ? '*' : '' }}
        </label>
    @endif
    
    <div class="relative rounded-md shadow-sm">
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}"
            class="w-full rounded-md border-0 py-1.5 ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 {{ $styleClass }}"
            @if ($xonFocus)
                x-on:focus="{{ $xonFocus }}"
                x-on:blur="setTimeout(() => { {{ $xonBlur }} }, 150)"
            @endif
            @if ($placeholder)
                placeholder="{{ $placeholder }}" 
            @endif
            @if ($value)
                value="{{ $value }}"  
            @endif
            @if ($wiremodel)
                wire:model="{{ $wiremodel }}"
            @endif
            @if ($wiremodelDebounce)
                wire:model.live.debounce.500ms="{{ $wiremodelDebounce }}"
            @endif
            @if ($readonly)
                readonly
            @endif
            @if ($required)
                required
            @endif
            >
            
            @if ($combobox)
                <div class="absolute inset-y-0 right-0 py-1.5 text-gray-400">
                    @include('components.icons.chevron-up-down')
                </div>
            @endif
    </div>

    @if ($error)
        <p class="mt-2 text-sm text-red-600" id="{{ $id . '-error' }}">
            {{ $error }}
        </p>
    @endif
</div>
