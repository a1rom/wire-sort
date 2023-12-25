@props([
    'scope' => 'col',
    'hidden' => false,
    'functional' => false,
    'value' => '',
    'nowrap' => false,
])
@php
$styleClass = 'px-3 py-4 text-sm font-bold text-gray-700';

    if ($hidden) {
        $styleClass .= ' hidden';
        if ($hidden == 'sm') {
            $styleClass .= ' sm:table-cell';
        }
        if ($hidden == 'md') {
            $styleClass .= ' md:table-cell';
        }
    }

    if ($nowrap) {
        $styleClass .= ' whitespace-nowrap';
    }

    if ($functional) {
        $styleClass = 'py-4 pl-3 text-right text-sm font-medium';
    }

@endphp

<th scope="{{$scope}}"
    class="{{ $styleClass }}"
    >
    {{ $value }}
</th>
