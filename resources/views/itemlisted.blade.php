@extends('adminlte::page')
@section('title', 'Package Listed')

@section('content_header')
    <h1>Package Listed</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="box-title">
                        Successfully added Package
                    </div>
                </div>
                <div class="box-body">
                    You hace Successfully added a package, it might take a few moments to process, please give it a moment and try to goto <a href="http://aims.eviannow.xyz/store/package/{{$submittedItem->id}}">Your package display</a> Don't forget to copy the link and paste it to discord chat so people buy your stuff.</p>
                </div>
            </div>
        </div>
    </div>
@endsection