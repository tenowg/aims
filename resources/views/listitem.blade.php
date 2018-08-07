@extends('adminlte::page')
@section('title', 'Welcome')

@section('content_header')
    <h1>List an Item(s)</h1>
@endsection

@section('content')
    <div>
        <aims-sidebar></aims-sidebar>
        @component('forms.edititem')
        @endcomponent
    </div>
@endsection