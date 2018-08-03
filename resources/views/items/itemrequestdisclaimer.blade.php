@component('layouts.master')
    @slot('title')
        Request Item Disclaimer
    @endslot
    <aims-sidebar></aims-sidebar>
    <div class="container" style="width: 60vw">
        <h2>About to Request to Purchase {{$item->quantity}} {{$item->typeName}}</h2>
        <p>You are about to request to purchase a listing from another player in
        Eve-Online, this request should be taken as a promise to buy as soon as the seller
        is able to create a contract in-game, or agree on some other form of delivery and payment.
        <br/>
        <h3>Legal Disclaimer</h3>
        <p>Nothing ont his site should be paid for in RMT, as in never use cash, or any other means to pay other than in-game ISK.
        If this is ever reported, you will be reported to Eve-Online.
        <form method="POST" action="/store/request/{{$item->id}}">
            @csrf
            <div>
                <label for="agree_check">
                    <input id="agree_check" type="checkbox" name="agree">
                    I agree to these conditions and wish to proceed.
                </label>
            </div>
            <div>
                <input id="submit" type="submit">Continue</input>
            </div>
        </form>
    </div>
@endcomponent