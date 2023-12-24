@props([
    'name',
    'label',
    'class' => false,
])
<div class="{{ $class }} block w-full py-1.5 text-sm font-medium leading-6 text-gray-900">
    {{ $label }}
</div>
