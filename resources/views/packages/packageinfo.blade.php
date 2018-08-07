@extends('adminlte::page')
@section('title', 'Package Details')

@section('content_header')
    <h1>Package Details</h1>
@endsection

@section('description') WTS: @foreach($package->items as $item) {{$item->name}} @endforeach @stop

@section('meta')
        @guest('is-alliance')
            <meta http-equiv="Refresh" content="0; url=/eve/auth">
        @endguest
@endsection

@section('content')
    @auth('is-alliance')
        <div class="row">
            
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">
                            Seller Info
                        </h3>
                    </div>
                    <div class="box-body">
                        @component('display.characterimage')
                            @slot('id')
                                {{$package['character_id']}}
                            @endslot
                            @slot('size', 256)
                            @slot('class', 'profile-user-img img-responsive img-circle')
                        @endcomponent
                        <h3 class="profile-username text-center">{{$package->sso->name}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-red">
                        <i class="fa fa-money"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Package Value</span>
                        <span class="info-box-number">{{number_format($total_value, 2)}}</span>
                    </div>
                </div>
                @if (\Auth::user()->sso->character_id === $package->character_id)
                    <div>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#package-delete">Delete Package</button>
                    </div>
                @endif
            </div>
        </div>
        <form class="row" method="POST" action="/store/requestitems/{{$package->id}}">
            @csrf
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            Available Items
                        </h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm">
                                <input class="btn btn-default pull-right" type="submit" value="Buy Selected Items">
                            </div>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th colspan="2">
                                        Item Type
                                    </th>
                                    <th>
                                        Price Each
                                    </th>
                                    <th>
                                        Quantity
                                    </th>
                                    <th>
                                        Buy
                                    </th>
                                    <th>
                                        Buy Amount
                                    </th>
                                </tr>
                            @foreach($package->items as $item)
                                {{-- <div class="col-sm-1">{{$item->name}}</div> --}}
                                @component('display.itemdisplay')
                                    @slot('type', $item->item_id)
                                    @slot('item_name', $item->name)
                                    @slot('price')
                                        @if ($item->price < 1000000)
                                            {{number_format($item->price, 2)}}
                                        @elseif ($item->price < 1000000000)
                                            {{number_format($item->price / 1000000, 2)}}M
                                        @elseif ($item->price < 1000000000000)
                                            {{number_format($item->price / 1000000000, 2)}}B
                                        @endif
                                    @endslot
                                    @slot('quantity', $item->remaining)
                                    @slot('id', $item->id)
                                    @slot('size', 32)
                                    @slot('class', 'rounded')
                                @endcomponent
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
        @if (\Auth::user()->sso->character_id === $package->character_id)
            <div class="modal modal-danger fade" id="package-delete" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                            <h4 class="modal-title">Delete Package</h4>
                        </div>
                        <div class="modal-body">
                            <p>You are about to delete this package, it will remove all items from the market and Delete all transactions and records of this package.</p>
                        </div>
                        <div class="modal-footer">
                            <form method="POST" action="/store/package/delete/{{$package->id}}">
                                @csrf
                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                <button class="btn btn-danger btn-outline" type="submit">Really delete this Package?</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endauth
@endsection