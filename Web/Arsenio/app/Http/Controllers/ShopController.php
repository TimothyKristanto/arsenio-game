<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemStudentRelation;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index($item_id, $amount, $showItemDetail){

        $student = Student::where('user_id', Auth::id())->first();
        $items = Item::all();
        $itemStudent = ItemStudentRelation::where('student_id', $student->student_id)->get();

        if($showItemDetail == 't'){
            return back()->with('itemDesc', 'Item ' . $items[$item_id - 1]->name . ': ' . $items[$item_id - 1]->description);
        }

        if($amount > 0){
            $studentGold = $student->golds;
            $itemPrice = $items[$item_id - 1]->single_price * $amount;

            if($studentGold >= $itemPrice){
                $studentGold -= $itemPrice;

                $ownedItem = $itemStudent[$item_id-1]->item_owned + $amount;

                ItemStudentRelation::where('student_id', $student->student_id)
                ->where('item_id', $item_id)
                ->update([
                    'item_owned' => $ownedItem,
                ]);

                $student->update([
                    'golds'=>$studentGold,
                ]);
            }else{
                return back()->with('itemDesc', 'Emas Anda tidak mencukupi');
            }

            return view('shop', [
                'page'=>'TOKO',
                'student'=>$student,
                'items'=> $items,
                'itemStudent' => ItemStudentRelation::where('student_id', $student->student_id)->get(),
            ]);
            
        }

        return view('shop', [
            'page'=>'TOKO',
            'student'=>$student,
            'items'=> $items,
            'itemStudent' => $itemStudent,
        ]);
    }
}
