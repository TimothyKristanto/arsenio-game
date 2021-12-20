<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemStudentRelation;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index($item_id, $amount){

        $student = Student::where('user_id', Auth::id())->first();
        $itemStudent = ItemStudentRelation::where('student_id', $student->student_id)->get();
        $items = Item::all();

        if($amount > 0){
            $ownedItem = $itemStudent[$item_id-1]->item_owned + $amount;

            ItemStudentRelation::where('student_id', $student->student_id)
            ->where('item_id', $item_id)
            ->update([
                'item_owned' => $ownedItem,
            ]);
            // $itemStudent::where('item_id', $item_id)->first()
            // ->update([
            //     'item_owned' => $ownedItem,
            // ]);
        }

        return view('shop', [
            'page'=>'TOKO',
            'student'=>$student,
            'items'=> $items,
            'itemStudent' => $itemStudent,
        ]);


    }
}
