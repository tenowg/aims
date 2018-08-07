@extends('adminlte::page')
@section('title', 'Listed Items')

@section('content_header')
    <h1>All Listed Items</h1>
@endsection

@section('js')
    <script>
    $(function() {
        $('.select2').select2()
    });
    </script>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">All Items listed on AIMS</h3>
                <div class="box-tools">
                    <form method="POST" action="/store/items">
                        @csrf
                        <select name="search[]" style="width:400px;" class="form-control select2" multiple data-placeholder="type" tab-index="-1" aria-hidden="true">
                            @foreach($distinct_names as $name)
                                <option>{{$name['name']}}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="search">
                    </form>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th colspan="2">
                                Type
                            </th>
                            <th>
                                Quantity
                            </th>
                            <th>
                                Price Each
                            </th>
                            <th>
                                Actions
                            </th>
                        </tr>
                        @foreach($items as $item)
                            @component('display.itemlist')
                                @slot('name') 
                                    {{$item['name']}}
                                @endslot
                                @slot('package')
                                    {{$item['package_id']}}
                                @endslot
                                @slot('price')
                                    {{$item['price']}}
                                @endslot
                                @slot('quantity')
                                    {{$item['quantity']}}
                                @endslot
                                @slot('type')
                                    {{$item['item_id']}}
                                @endslot
                            @endcomponent
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
