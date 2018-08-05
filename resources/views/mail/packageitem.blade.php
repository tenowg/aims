This message is from AIMS, the following buyer wants to purchase some items from the site.

    {{$user->sso->name}}

@foreach($transactions as $transaction)
    {{$transaction->item->name}} - {{$transaction->amount}} at {{number_format($transaction->item->price, 2)}} ISK each, total {{number_format($transaction->amount * $transaction->item->price, 2)}}
@endforeach

Total Contract Value: {{number_format($total_price)}}

If this is good for you, please return to the site to by using this link to confirm the sale
http://aims.eviannow.xyz/confirm/--mail-id--

Thanks, and have a great day.