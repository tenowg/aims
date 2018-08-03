@component('layouts.master')
    @slot('title')
        Packages
    @endslot
    @foreach($packages as $package)
        <a href="/store/package/{{$package['id']}}">
        <div>
            {{$package['character_id']}} -- {{$package['id']}}
        <div>
        </a>
    @endforeach
@endcomponent