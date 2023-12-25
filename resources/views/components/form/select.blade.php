@props([
    'id',
    'name',
    'label' => false,
    'selected' => false,
    'options' => [],
    'error' => false,
    'disabled' => false,
    'class' => false,
    'wiremodel' => false,
    'wiremodelDefer' => false,
    'wiremodelChange' => false,
    'withKey' => false,
])
@php
    $styleClass = $error ? ' text-red-900 ring-red-300 placeholder:text-red-300 focus:ring-red-500' 
        : ' text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-blue-600';
@endphp

<div class="{{ $class }}"
    @if($wiremodel OR $wiremodelDefer)
        wire:loading.class="opacity-50 cursor-not-allowed"
    @endif
    >
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium leading-6 text-gray-900">
            {{ $label }}
        </label>
    @endif
    <select class="block w-full rounded-md shadow-sm border-0 py-1.5 ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 {{ $styleClass }}"
        name="{{$name}}" id="{{$id}}"
        @if ($wiremodel)
            wire:model="{{ $wiremodel }}"
        @endif
        @if ($wiremodelDefer)
            wire:model="{{ $wiremodelDefer }}"
        @endif
        @if ($wiremodelChange)
            wire:model.change="{{ $wiremodelChange }}"
        @endif
        >

        @if ($withKey)
            @foreach ($options as $key => $option)
                <option value="{{$key}}" {{ $selected == $key ? 'selected' : '' }}>
                    {{ $option }}
                </option>
            @endforeach
        @else
            @foreach ($options as $option)
                <option value="{{$option['id']}}" {{ $selected == $option['id'] ? 'selected' : '' }}>
                    {{ $option['value'] }}
                </option>
            @endforeach
        @endif
    </select>
</div>

@if ($error)
    <p class="mt-2 text-sm text-red-600" id="{{ $id . '-error' }}">
        {{ $error }}
    </p>
@endif
