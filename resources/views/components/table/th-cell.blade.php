@props([
    'colspan' => false,
    'hidden' => false,
    'functional' => false,
    'value' => '',
    'width' => false,
])
@php
    $styleClass = 'px-3 py-3.5 text-left font-semibold text-gray-900';

    if ($hidden) {
        $styleClass .= ' hidden';
        if ($hidden == 'sm') {
            $styleClass .= ' sm:table-cell';
        }
        if ($hidden == 'md') {
            $styleClass .= ' md:table-cell';
        }
    }

    if ($functional) {
        $styleClass = 'py-3.5 pl-3';
    }

    if ($width) {
        $styleClass .= ' ' . $width;
    }

@endphp

<th 
    class="{{ $styleClass }}"
    
    @if ($colspan)
        colspan="{{ $colspan }}"    
    @endif
>
    {{ $value }}
</th>
