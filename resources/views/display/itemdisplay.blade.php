<div class="card" style="width: 83px">
  <img class="card-img-top" src="https://image.eveonline.com/Type/{{$type}}_64.png" alt="Card image cap">
  <div class="card-body" style="padding: 0;">
    <h5 class="card-title">{{$item_name}}</h5>
    <div class="card-text" style="font-size: 10px; line-height: 1;">{{$price}}</div>
    <div class="card-text" style="font-size: 10px; line-height: 1;">{{$quantity or 1000000}}</div>
    <div class="card-footer text-center" style="padding: 0px">
        <label for="item-{{$id}}">
            <input type="checkbox" id="item-{{$id}}" name="item[]" value="{{$id}}"> Buy
        </label>
    </div>
  </div>
</div>