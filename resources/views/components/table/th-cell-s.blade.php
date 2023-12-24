@props([
    'scope' => 'col',
    'hidden' => false,
    'functional' => false,
    'value' => '',
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

@endphp

<th scope="{{$scope}}"
    class="{{ $styleClass }}"
    >
    {{ $slot }}
</th>
