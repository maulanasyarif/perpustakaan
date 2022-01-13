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
    public function toReturn(Request $request)
    {
        $data = Loan::where($request->id)->get();

        foreach($data as $dt)
        {
            $id             = $request->id;
            $no_identify    = $request->no_identify;
            $book_title     = $request->book_title;
            $name           = $request->name;
            $loan_date      = $request->loan_date;
            $return_date    = $request->return_date;
            $phone_number   = $request->phone_number;
        }

        $id;
        $no_identify;
        $book_title;
        $name;
        $loan_date;
        $return_date;
        $phone_number;

        DB::table('return')->where('id', $request->no_identify)->insert([
            'no_identify'       => $no_identify,
            'book_title'        => $book_title,
            'name'              => $name,
            'loan_date'         => $loan_date,
            'return_date'       => $return_date,
            'phone_number'      => $phone_number,
        ]);

        $delete = Loan::find($id, 'id')->delete();
        
        return response()->json([
            'status'    => 200,
            'message'   => 'Data has been moved to return',
        ]);
    }
}