@props([
    'scope' => 'col',
    'firstInRow' => false,
    'hidden' => false,
    'functional' => false,
    'width' => false,
    'nowrap' => false,
])
@php
$styleClass = 'px-3 py-4 text-sm';
    $firstInRow ? $styleClass .= ' font-medium text-gray-900 whitespace-nowrap' : $styleClass .= ' font-normal text-gray-700';

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
    {{ $slot }}
</th>
