@props([
    'type' => 'button',
    'size' => 'md',
    'color' => 'blue',
    'text' => 'Button',
    'method' => false,
    'width' => 'md',
])

@php
$sizeClasses = [
    'xs' => 'px-2 py-1 text-xs',
    'sm' => 'px-2 py-1 text-sm',
    'md' => 'px-2.5 py-1.5 text-sm',
    'lg' => 'px-3 py-2 text-sm',
    'xl' => 'px-3 py-2 text-md',
];

$colorClasses = [
    'blue' => 'bg-blue-600 border border-blue-600 hover:bg-blue-500 focus-visible:outline-blue-600 text-white',
    'soft-blue' => 'bg-blue-50 border border-blue-400 hover:bg-blue-100 focus-visible:outline-blue-600 text-blue-600',
    'green' => 'bg-green-600 border border-green-600 hover:bg-green-500 focus-visible:outline-green-600 text-white',
    'red' => 'bg-rose-800 border border-rose-800 hover:bg-rose-700 focus-visible:outline-rose-600 text-white',
    'soft-red' => 'bg-rose-50 border border-rose-400 hover:bg-rose-100 focus-visible:outline-rose-600 text-red',
    'yellow' => 'bg-amber-700 border border-amber-700 hover:bg-amber-600 focus-visible:outline-amber-700 text-white',
    'lime' => 'bg-lime-700 border border-lime-700 hover:bg-lime-600 focus-visible:outline-lime-600 text-white',
    'teal' => 'bg-teal-700 border border-teal-700 hover:bg-teal-600 focus-visible:outline-teal-600 text-white',
    'gray' => 'bg-gray-600 border border-gray-600 hover:bg-gray-500 focus-visible:outline-gray-600 text-white',
];

$widthCalsses = [
    'auto' => 'w-auto',
    'xs' => 'w-8',
    'md' => 'w-14',
    'lg' => 'w-24',
    'xl' => 'w-32',
    'xxl' => 'w-40',
];

$sizeClass = $sizeClasses[$size] ?? $sizeClasses['sm'];
$colorClass = $colorClasses[$color] ?? $colorClasses['blue'];
$widthClasses = $widthCalsses[$width] ?? $widthCalsses['auto'];

@endphp

<button type="{{ $type }}"
    @if ($method)
        wire:click="{{ $method }}"
        wire:loading.attr="disabled"
        wire:loading.class="cursor-not-allowed"
    @endif
    class="rounded {{ $sizeClass }} {{ $widthClasses }} font-semibold shadow-sm {{ $colorClass }} whitespace-nowrap overflow-hidden">
    {{ $text }}
</button>
