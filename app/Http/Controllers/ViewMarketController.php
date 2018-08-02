<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubmittedItems;
use App\ListedItem;
use App\EveMail;
use App\Http\Requests\RequestListing;

class ViewMarketController extends Controller
{
    public function packages() {
        $packages = SubmittedItems::all()->toArray();
        return view('packages', compact(['packages']));
    }

    public function package(SubmittedItems $package) {
        $items = $package->items;
    }

    public function item(ListedItem $item) {
        $package = $item->package;

        dd($package);
    }

    public function items() {
        $items = ListedItem::all()->toArray();
        return view('listeditems', compact(['items']));
    }

    public function requestItemDisclaimer(ListedItem $item) {
        return view('items.itemrequestdisclaimer', compact('item'));
    }

    public function requestItem(RequestListing $request, ListedItem $item) {
        dd($request, $item);
        $receiver = $item->package->sso;
        $mail = EveMail::create([
            'sender_id' => \Auth::user()->sso->character_id,
            'can_cspa' => false,
            'subject' => "Request to Buy your Product.",
            'body' => 'This is just a test Body...',
            'reciever_ids' => [$receiver->character_id],
        ]);

        $mail2 = EveMail::find($mail->id);
        //dd($mail2->reciever_ids);

        \App\Jobs\SendEveMail::dispatch($mail);
    }
}
