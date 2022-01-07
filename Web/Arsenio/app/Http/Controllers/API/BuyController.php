<?php

namespace App\Http\Controllers\API;

use App\Helpers\UserSystemInfoHelper;
use App\Http\Controllers\Controller;
use App\Models\GameLog;
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
        
        GameLog::create([
            'table'=>'senrup_students',
            'student_id'=>$student->student_id,
            'log_desc'=>'Uang user ' . $student->user->name . ': ' . $student->golds,
            'log_path'=>'/buy/' . $item_id . '/' . $item_owned . '/' . $golds,
            'log_ip'=>UserSystemInfoHelper::get_ip(),
        ]);

        GameLog::create([
            'table'=>'senrup_items_students',
            'student_id'=>$student->student_id,
            'log_desc'=>'Jumlah Item ' . $item->name . ' User ' . $student->user->name . ': ' . $itemOwned->item_owned,
            'log_path'=>'/buy/' . $item_id . '/' . $item_owned . '/' . $golds,
            'log_ip'=>UserSystemInfoHelper::get_ip(),
        ]);

        $itemOwned->update([
            'item_owned'=>$item_owned
        ]);

        $student->update([
            'golds'=>$golds
        ]);

        $updatedStudent = Student::where('user_id', Auth::id())->first();
        $updatedItem = Item::where('item_id', $item_id)->first();
        $updatedItemOwned = ItemStudentRelation::where('student_id', $student->student_id)->where('item_id', $item->item_id)->first();

        GameLog::create([
            'table'=>'senrup_students',
            'student_id'=>$updatedStudent->student_id,
            'log_desc'=>'Uang user ' . $updatedStudent->user->name . ': ' . $updatedStudent->golds,
            'log_path'=>'/buy/' . $item_id . '/' . $item_owned . '/' . $golds,
            'log_ip'=>UserSystemInfoHelper::get_ip(),
        ]);

        GameLog::create([
            'table'=>'senrup_items_students',
            'student_id'=>$updatedStudent->student_id,
            'log_desc'=>'Jumlah Item ' . $updatedItem->name . ' User ' . $updatedStudent->user->name . ': ' . $updatedItemOwned->item_owned,
            'log_path'=>'/buy/' . $item_id . '/' . $item_owned . '/' . $golds,
            'log_ip'=>UserSystemInfoHelper::get_ip(),
        ]);

        return ['message' => "Barang Telah Dibeli"];
    }
}
