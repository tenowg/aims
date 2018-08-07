@extends('adminlte::page')
@section('title', 'Request Items')

@section('content_header')
    <h1>Request Items</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="box-title">
                        Seller
                    </div>
                </div>
                <div class="box-body box-profile">
                    @component('display.characterimage')
                        @slot('class', 'profile-user-img img-responsive img-circle')
                        @slot('id', $package->sso->character_id)
                    @endcomponent
                    <h3 class="profile-username text-center">{{$package->sso->name}}</h3>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="box-title">
                        Buyer
                    </div>
                </div>
                <div class="box-body box-profile">
                    @component('display.characterimage')
                        @slot('class', 'profile-user-img img-responsive img-circle')
                        @slot('id', \Auth::user()->sso->character_id)
                    @endcomponent
                    <h3 class="profile-username text-center">{{\Auth::user()->sso->name}}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="box-title">
                        Purchasing Items
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>
                                    Quantity
                                </th>
                                <th>
                                    Type
                                </th>
                                <th>
                                    Price Each
                                </th>
                                <th>
                                    Total Price
                                </th>
                            </tr>
                            @foreach($item_details as $item)
                            <tr>
                                <td>
                                    {{$items[$item['id']][1]}}
                                <td>
                                    @component('display.typeimage')
                                        @slot('type', $item['item_id'])
                                    @endcomponent
                                    {{$item['name']}}
                                </td>
                                <td>
                                    {{number_format($item['price'], 2)}} ISK
                                <td>
                                    {{number_format($item['price'] * $items[$item['id']][1], 2)}} ISK
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        Request for Purchase
                    </div>
                </div>
                <div class="box-body">
                    You are about to request to purchase a listing from another player in
                    Eve-Online, this request should be taken as a promise to buy as soon as the seller
                    is able to create a contract in-game, or agree on some other form of delivery and payment.
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box box-warning">
                <div class="box-header">
                    <div class="box-title">
                        Legal Disclaimer
                    </div>
                </div>
                <div class="box-body">
                    Nothing on this site should be paid for with RMT, as in never use cash, or any other means to pay other than in-game ISK.
                    If this is ever reported, you will be reported to Eve-Online.
                    <form method="POST" action="/store/buyitems/{{$package->id}}">
                        @csrf
                        <div>
                            <label for="agree_check">
                                <input id="agree_check" type="checkbox" name="agree">
                                I agree to these conditions and wish to proceed.
                            </label>
                        </div>
                        <div>
                        @foreach($items as $item)
                            @if(array_key_exists(0, $item))
                                <input type="hidden" name="item[{{$item[0]}}][0]" value="{{$item[0]}}">
                                <input type="hidden" name="item[{{$item[0]}}][1]" value="{{$item[1]}}">
                            @endif
                        @endforeach
                            <input id="submit" type="submit" class="btn btn-primary" value="Continue"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection