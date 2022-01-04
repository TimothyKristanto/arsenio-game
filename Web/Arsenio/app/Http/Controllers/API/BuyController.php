<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemStudentRelation;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyController extends Controller
{
    public function buy($item_id, $item_owned, $golds){
        $student = Student::where('user_id', Auth::id())->first();
        $item = Item::where('item_id', $item_id)->first();
        $itemOwned = ItemStudentRelation::where('student_id', $student->student_id)->where('item_id', $item->item_id)->first();

        $itemOwned->update([
            'item_owned'=>$item_owned
        ]);

        $student->update([
            'golds'=>$golds
        ]);

        return ['message' => "Barang Telah Dibeli"];
    }
}
