<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return response([
            $items
        ]);
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
        $validator = Validator::make($request->all(), [
            'text' => 'required',
        ]);

        if($validator->fails())
        {
            return response([
                'data' => [
                    'errors' => $validator->messages()
                ]
            ]);
        }
        else
        {
            // return $request->all();
            $item = Item::create($request->all());
            return response([
                'data' => [
                    'item' => $item
                ]
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return response([
            $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        return response([
            $item
        ]);
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
        $validator = Validator::make($request->all(), [
            'text' => 'required|min:3',
            'body' => 'required'
        ]);
        if($validator->fails())
        {
            return response([
               'data' => [
                   'errors' => $validator->messages()
               ]
            ]);
        }
        $item = Item::find($id);
        $item->text = $request->text;
        $item->body = $request->body;
        $item->update();
        return response([
            'data' => [
                'item' => $item
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $name = $item->text;
        $item->delete();
        return response([
            // 'data' => [
            //     'success' => $name . ' was deleted successfully!'
            // ]
        ]);
    }
}
