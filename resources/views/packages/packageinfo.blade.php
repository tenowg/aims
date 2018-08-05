@component('layouts.master')
    @slot('title')
        Package
    @endslot
    @slot('description') WTS: @foreach($package->items as $item) {{$item->name}} @endforeach
    @endslot
    <aims-sidebar></aims-sidebar>
    @auth('is-alliance')
        <form method="POST" action="/store/buyitems/{{$package->id}}">
        @csrf
        <div class="container-fluid" style="height: 256px">
            <p style="float: left; margin-right: 20px">
            @component('display.characterimage')
                @slot('id')
                    {{$package['character_id']}}
                @endslot
                @slot('size')
                    256
                @endslot
            @endcomponent
            </p>
            <div style="height: 20%">
                <div>Seller: <strong>{{$package->sso->name}}</strong></div>
                <div>Total Package Value: {{number_format($total_value, 2)}} ISK</div>
            </div style="">
            <div style="position: relative; height: 80%">
                <input style="position: absolute; bottom: 0; left: 276px;" class="btn btn-secondary" type="submit" value="Buy Selected Items">
            </div>
        </div>
        <div class='container-fluid' style="clear: left">
        <div><h3>Available Items</h3></div>
            <div class="card-columns">
                @foreach($package->items as $item)
                    {{-- <div class="col-sm-1">{{$item->name}}</div> --}}
                    @component('display.itemdisplay')
                        @slot('type')
                            {{$item->item_id}}
                        @endslot
                        @slot('item_name')
                            {{$item->name}}
                        @endslot
                        @slot('price')
                            @if ($item->price < 1000000)
                                {{number_format($item->price, 2)}} ISK
                            @elseif ($item->price < 1000000000)
                                {{number_format($item->price / 1000000, 2)}}M ISK
                            @elseif ($item->price < 1000000000000)
                                {{number_format($item->price / 1000000000, 2)}}B ISK
                            @endif
                        @endslot
                        @slot('quantity')
                            {{$item->quantity}}
                        @endslot
                        @slot('id')
                            {{$item->id}}
                        @endslot
                    @endcomponent
                @endforeach
            </div>
        </div>
        </form>
    @endauth
    @guest('is-alliance')
        Please log-in with an alliance character
    @endguest

@endcomponent