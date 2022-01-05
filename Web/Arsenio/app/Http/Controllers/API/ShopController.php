<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\HomeResource;
use App\Http\Resources\ItemResource;
use App\Http\Resources\NavbarResource;
use App\Http\Resources\ShopResource;
use App\Http\Resources\ShopStudentDataResource;
use App\Models\Item;
use App\Models\ItemStudentRelation;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        $student = Student::where('user_id', Auth::id())->first();
        $studentGold = Student::where('student_id', $student->student_id)->get();
        $itemStudent = ItemStudentRelation::all()->where('student_id', $student->student_id);

        return [
            'item'=>ItemResource::collection($items),
            'itemStudent'=>ShopResource::collection($itemStudent),
            'shopStudentData'=>ShopStudentDataResource::collection($studentGold),
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
