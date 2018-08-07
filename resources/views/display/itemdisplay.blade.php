<tr>
    <td>
        <img src="https://image.eveonline.com/Type/{{$type}}_64.png" class="{{$class}}" style="height: {{$size}}px">
    </td>
    <td>
        {{$item_name}}
    </td>
    <td>{{$price}} ISK</td>
    <td>{{$quantity or 1000000}}</td>
    <td>
        <label for="item-{{$id}}">
            <input type="checkbox" id="item-{{$id}}" name="item[{{$id}}][0]" value="{{$id}}"> Buy
        </label>
    </td>
    <td>
        <label for="item-{{$id}}">
            <input type="number" id="item-{{$id}}-amount" name="item[{{$id}}][1]" value="{{$quantity}}" min="1" max="{{$quantity}}"> Amount
        </label>
    </td>
</tr>
