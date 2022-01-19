<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Loan;

class LoanController extends Controller
{
    //get all data
    public function index()
    {
        $loan = Loan::get();

        return response()->json([
            'status'    => 200,
            'loans'      => $loan,
        ]);
    }

    //parsing to return table
    public function update(Request $request)
    {
        $id     = $request->id;
        $status = $request->status;

        $loan   = Loan::all();
        
        if(!$loan)
        {
            return response()->json([
                'status'=> 404,
                'message' => 'Data not Found',
            ]);
        } else {

            $loan = new Loan;
            $loan->status = $request->status;
            $loan->save();

            return response()->json([
                'status'    => 200,
                'message'   => 'Status has been update',
            ]);           
        }
    }

}