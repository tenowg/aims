<a href="#" class="container-fluid">
    <div class="row">
        <div class="col-sm">
        @component('display.typeimage')
            @slot('type')
                {{$type}}
            @endslot
        @endcomponent
        </div>
        <div class="col-sm">
            {{$name}} ({{$quantity}})
        </div>
        <div class="col-sm">
            {{$price}}
        </div>
        <div class="col-sm">
            {{$package}}
        </div>
    </div>
</a>