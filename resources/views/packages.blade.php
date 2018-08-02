@component('layouts.master')
    @slot('title')
        Packages
    @endslot
    @foreach($packages as $package)
        <div>
            {{$package->character_id}} -- {{$package->id}}
        <div>
    @endforeach
@endcomponent