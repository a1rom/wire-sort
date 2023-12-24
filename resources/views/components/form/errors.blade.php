@props(['errors'])

@if ($errors->any())
    <x-alert type="danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </x-alert>
@endif
