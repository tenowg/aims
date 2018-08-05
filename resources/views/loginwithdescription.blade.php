@component('layouts.master')
    @slot('title')
        Package
    @endslot
    @slot('description') WTS: @foreach($package->items as $item) {{$item->name}} @endforeach
    @endslot
@endcomponent