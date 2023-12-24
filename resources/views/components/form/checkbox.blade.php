@props([
    'id',
    'name',
    'label', 
    'checked' => false,
    'disabled' => false,
    'wiremodel' => false,
])

@php
    $color = $disabled ? 'text-gray-400' : 'text-blue-600';
@endphp
<div class="flex items-center py-1.5">
    <input id="{{ $id }}" name="{{ $name }}" type="checkbox" value="{{ $name }}"
        class="h-4 w-4 rounded border-gray-300 {{ $color }} focus:ring-blue-600"
        {{ $checked ? 'checked' : '' }} 
        {{ $disabled ? 'disabled' : '' }}
        @if ($wiremodel)
            wire:model="{{ $wiremodel }}"
        @endif
        >
    <label for="{{ $name }}" class="ml-3 block text-sm font-medium leading-6 text-gray-900">
        {{ $label }}
    </label>
</div>
