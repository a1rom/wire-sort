@props(['type' => 'default'])

@php
    $backgroundColor = '';
    $textColor = '';
    $borderColor = '';

    switch ($type) {
        case 'warning':
            $backgroundColor = 'bg-yellow-50';
            $borderColor = 'border-yellow-200';
            $textColor = 'text-yellow-700';
            break;
        case 'info':
            $backgroundColor = 'bg-blue-50';
            $borderColor = 'border-blue-200';
            $textColor = 'text-blue-700';
            break;
        case 'danger':
            $backgroundColor = 'bg-red-50';
            $borderColor = 'border-red-200';
            $textColor = 'text-red-700';
            break;
        case 'success':
            $backgroundColor = 'bg-green-50';
            $borderColor = 'border-green-200';
            $textColor = 'text-green-700';
            break;
        case 'default':
            $backgroundColor = 'bg-gray-50';
            $borderColor = 'border-gray-200';
            $textColor = 'text-gray-700';
            break;
    }
@endphp

<div {{ $attributes->merge(['class' => 'p-4 rounded-md border ' . $borderColor . ' ' . $backgroundColor . ' ' . $textColor]) }}>
    <div class="flex">
        <div class="text-sm font-medium">
            {{ $slot }}
        </div>
    </div>
</div>
