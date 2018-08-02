<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SubmittedItem;
use App\SubmittedItems;
use App\Jobs\ProcessSubmittedItem;
use \Auth;

class ItemsController extends Controller
{
    public function editItem() {
        return view('listitem');
    }

    public function newItem() {
        return view('listitem');
    }

    public function submitItem(SubmittedItem $request) {
        $validatedData = $request->validated();
        $submittedItem = new SubmittedItems();
        $submittedItem->buyorsell = $validatedData['buy'];
        $submittedItem->trade_hub = $validatedData['hub'];
        $submittedItem->character_id = Auth::user()->sso->character_id;
        if ($validatedData['evep-id']) {
            $submittedItem->evep_id = $validatedData['evep-id'];
        }

        if ($validatedData['raw']) {
            $submittedItem->raw_list = $validatedData['raw'];
        }

        $submittedItem->save();

        ProcessSubmittedItem::dispatch($submittedItem);

        return view('itemlisted');
    }
}
