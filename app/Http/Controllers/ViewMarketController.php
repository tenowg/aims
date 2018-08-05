<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubmittedItems;
use App\ListedItem;
use App\EveMail;
use App\Http\Requests\RequestListing;
use App\Http\Requests\RequestItemsFromPackage;

class ViewMarketController extends Controller
{
    public function packages() {
        $packages = SubmittedItems::all()->toArray();
        return view('packages', compact(['packages']));
    }

    public function package(SubmittedItems $package) {
        $items = $package->items;
        $total_value = 0;
        foreach($items as $item) {
            $total_value = $total_value + ($item->quantity * $item->price);
        }
        return view('packages.packageinfo', compact(['package', 'total_value']));
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
        $receiver = $item->package->sso;
        $mail = EveMail::create([
            'sender_id' => \Auth::user()->sso->character_id,
            'can_cspa' => false,
            'subject' => "Request to Buy your Product.",
            'body' => 'This is just a test Body...',
            'reciever_ids' => [$receiver->character_id],
        ]);

        \App\Jobs\SendEveMail::dispatch($mail);
    }

    public function requestItems(RequestItemsFromPackage $request, SubmittedItems $package) {
        $receiver = $package->sso;

        $user = \Auth::user();
        $items = $package->items;
        $items = ListedItem::whereIn('id', request('item'))->where('package_id', $package->id)->get();
        $total_price = 0;
        foreach($items as $item) {
            $total_price = $total_price + ($item['quantity'] * $item['price']);
        }

        $mail = EveMail::create([
            'sender_id' => \Auth::user()->sso->character_id,
            'can_cspa' => false,
            'subject' => "Request to Buy your Product.",
            'body' => view('mail.packageitem', compact(['package', 'user', 'items', 'total_price']))->render(),
            'reciever_ids' => [$receiver->character_id],
        ]);

        \App\Jobs\SendEveMail::dispatch($mail);
    }
}
