<?php

namespace App\Http\Controllers;

use App\Helpers\UserSystemInfoHelper;
use App\Models\GameLog;
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

        if($showItemDetail == 'show'){
            return view('shop', [
                'page'=>'TOKO',
                'student'=>$student,
                'user'=>$student->user,
                'items'=> $items,
                'itemStudent' => ItemStudentRelation::where('student_id', $student->student_id)->get(),
                'itemDesc' => 'Item ' . $items[$item_id - 1]->name . ': ' . $items[$item_id - 1]->description
            ]);
        }

        GameLog::create([
            'table'=>'senrup_students',
            'student_id'=>$student->student_id,
            'log_desc'=>'Uang student ' . $student->user->name . ': ' . $student->golds,
            'log_path'=>'/shop/' . $item_id . '/' . $amount . '/' . $showItemDetail,
            'log_ip'=>UserSystemInfoHelper::get_ip(),
        ]);

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

                GameLog::create([
                    'table'=>'senrup_items_students',
                    'student_id'=>$student->student_id,
                    'log_desc'=>'Student ' . $student->user->name . ' beli item ' . $items[$item_id - 1]->name . '. Total item ' . $items[$item_id - 1]->name . ': ' . $ownedItem,
                    'log_path'=>'/shop/' . $item_id . '/' . $amount . '/' . $showItemDetail,
                    'log_ip'=>UserSystemInfoHelper::get_ip(),
                ]);

                $student->update([
                    'golds'=>$studentGold,
                ]);

                GameLog::create([
                    'table'=>'senrup_students',
                    'student_id'=>$student->student_id,
                    'log_desc'=>'Uang student ' . $student->user->name . ': ' . $student->golds,
                    'log_path'=>'/shop/' . $item_id . '/' . $amount . '/' . $showItemDetail,
                    'log_ip'=>UserSystemInfoHelper::get_ip(),
                ]);
            }else{
                GameLog::create([
                    'table'=>'senrup_students',
                    'student_id'=>$student->student_id,
                    'log_desc'=>'Uang student ' . $student->user->name . ': ' . $student->golds . '. Tidak cukup untuk beli item ' . $items[$item_id - 1]->name . ' seharga ' . ($items[$item_id - 1]->single_price * $amount),
                    'log_path'=>'/shop/' . $item_id . '/' . $amount . '/' . $showItemDetail,
                    'log_ip'=>UserSystemInfoHelper::get_ip(),
                ]);

                return view('shop', [
                    'page'=>'TOKO',
                    'student'=>$student,
                    'user'=>$student->user,
                    'items'=> $items,
                    'itemStudent' => ItemStudentRelation::where('student_id', $student->student_id)->get(),
                    'itemDesc' => 'Emas Anda tidak mencukupi'
                ]);
            }

            return view('shop', [
                'page'=>'TOKO',
                'student'=>$student,
                'user'=>$student->user,
                'items'=> $items,
                'itemStudent' => ItemStudentRelation::where('student_id', $student->student_id)->get(),
                'itemDesc' => ''
            ]);

        }

        return view('shop', [
            'page'=>'TOKO',
            'student'=>$student,
            'user'=>$student->user,
            'items'=> $items,
            'itemStudent' => $itemStudent,
            'itemDesc' => ''
        ]);
    }
}
