<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReturnData;

class ReturnController extends Controller
{
    //get all data
    public function index()
    {
        $return = ReturnData::get();

        return response()->json([
            'status'    => 200,
            'returns'    => $return,
        ]);
    }

    public function destroy($id)
    {
        $returns = ReturnData::find($id);

        if(!$returns)
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Return ID Found',
            ]);
        } else {
            $returns->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Data Deleted Successfully',
            ]);
        }
    }
}