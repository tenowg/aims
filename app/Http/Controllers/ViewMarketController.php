<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubmittedItems;
use App\ListedItem;
use App\EveMail;
use App\Http\Requests\RequestListing;
use App\Http\Requests\RequestItemsFromPackage;
use App\Transaction;

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
            $total_value = $total_value + ($item->remaining * $item->price);
        }
        return view('packages.packageinfo', compact(['package', 'total_value']));
    }

    public function item(ListedItem $item) {
        $package = $item->package;

        dd($package);
    }

    public function items() {
        $items = [];
        if(request('search')) {
            $search_items = [];
            foreach(request('search') as $s) {
                array_push($search_items, $s);
            }
            $items = ListedItem::whereIn('name', $search_items)->get()->toArray();
        } else {
            $items = ListedItem::all()->toArray();
        }

        //dd($items);
        $distinct_names = ListedItem::select('name')
            ->distinct()
            ->orderBy('name', 'asc')
            ->get()->toArray();
        return view('listeditems', compact(['items', 'distinct_names']));
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

    public function requestItemsDisclaimer(SubmittedItems $package) {
        $items = request('item');
        $item_ids = [];
        //dd(request('item'));
        foreach(request('item') as $item) {
            if (array_key_exists(0, $item)) {
                array_push($item_ids, $item[0]);
            }
        }
        $item_details = ListedItem::whereIn('id', $item_ids)->where('package_id', $package->id)->get();
        return view('items.packagerequestdisclaimer', compact('package', 'items', 'item_details'));
    }

    public function requestItems(RequestItemsFromPackage $request, SubmittedItems $package) {
        $receiver = $package->sso;

        $user = \Auth::user();
        $item_ids = [];
        foreach(request('item') as $item) {
            array_push($item_ids, $item[0]);
        }
        $items = ListedItem::whereIn('id', $item_ids)->where('package_id', $package->id)->get();
        $total_price = 0;
        $transactions = [];
        foreach($items as $item) {
            $amount = request('item')[$item['id']][1];
            $total_price = $total_price + ($amount * $item['price']);
            // create transaction for each item requested
            array_push($transactions, Transaction::create([
                'listed_item_id' => $item['id'],
                'purchaser_id' =>$user->sso->character_id,
                'amount' => request('item')[$item['id']][1]
            ]));
        }

        $mail = EveMail::create([
            'sender_id' => \Auth::user()->sso->character_id,
            'can_cspa' => false,
            'subject' => "Request to Buy your Product.",
            'body' => view('mail.packageitem', compact(['package', 'user', 'transactions', 'total_price']))->render(),
            'reciever_ids' => [$receiver->character_id],
        ]);

        \App\Jobs\SendEveMail::dispatch($mail);
    }
}
