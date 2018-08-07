@if (count($errors->all()) > 0)
    <ul>
    @foreach($errors->all() as $message)
        <li>{{$message}}</li>
    @endforeach
    </ul>
@endif
<form method="POST" action="/store/submititem" role="form">
    @method('post')
    @csrf
    <small class="form-text text-muted">
        if you have already used evepriasal.com to get prices, you can put the evepriasal Id here.
    </small>
    <div class="input-group">
        <span class="input-group-addon"  id="basic-addon3">https://evepraisal.com/a/</span>
        <input type="text" class="form-control" name="evep-id" id="basic-url" aria-describedby="basic-addon3">
    </div>
    <div class="form-group">
        <label for="evepraisalInput">Evepraisal Input</label>
        <textarea class="form-control" id="evepraisalInput" name="raw" rows="7"></textarea>
    </div>
    <small class="form-text text-muted">
        Select the system you want to use for trade hub. This will be the price that is used to base your item.
    </small>
    <div>
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-default">
                <input type="radio" id="hub-amarr" name="hub" autocomplete="off" value="amarr"> Amarr
            </label>
            <label class="btn btn-default">
                <input type="radio" id="hub-jita" name="hub" autocomplete="off" value="jita"> Jita
            </label>
            <label class="btn btn-default">
                <input type="radio" id="hub-rens" name="hub" autocomplete="off" value="rens"> Rens
            </label>
            <label class="btn btn-default">
                <input type="radio" id="hub-dodixie" name="hub" autocomplete="off" value="dodixie"> DoDixie
            </label>
            <label class="btn btn-default">
                <input type="radio" id="hub-hek" name="hub" autocomplete="off" value="hek"> Hek
            </label>
        </div>
    </div>
    <small class="form-text text-muted">
        If you are using Evepraisal.com then enter which price you want to base your price on, buy or sell.
    </small>
    <div>
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-default">
                <input type="radio" id="price-buy" name="buy" autocomplete="off" value="buy"> Buy
            </label>
            <label class="btn btn-default">
                <input type="radio" id="price-sell" name="buy" autocomplete="off" value="sell"> Sell
            </label>
        </div>
    </div>
    <div style="margin-top: .25em">
        <button type="submit"  class="btn btn-primary">Submit</button>
    </div>
</form>