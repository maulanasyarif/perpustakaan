<?php

namespace App\Http\Controllers;

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
}