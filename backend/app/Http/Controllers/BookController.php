<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;

class BookController extends Controller
{
    public function index()
    {
        $book = Books::get();

        return response()->json([
            'status'    => 200,
            'books'     => $book,
        ]);
    }

    public function store(Request $request)
    {

        $rules = $request->validate([
            'title'     => 'required',
            'desc'      => 'required',
            'writer'    => 'required',
            'stock'     => 'required',
        ]);

        if(!$rules)
        {
            return response()->json([
                'status'=> 422,
                'validate_err'=> $validator->messages(),
            ]);
        } 
        else {
            $books = new Books;
            $books->title    = $request->title;
            $books->desc     = $request->desc;
            $books->writer   = $request->writer;
            $books->stock    = $request->stock;
            $books->save();
            
            return response()->json([
                'status'    => 200,
                'message'   => 'Data created successfully',
            ]);
        }
    }

    public function edit($id)
    {
        $books = Books::find($id);

        if(!$books)
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Book ID Found',
            ]);
        }
        else {
            return response()->json([
                'status'    => 200,
                'books'     => $books,
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        
        $rules = $request->validate([
            'title'     => 'required',
            'desc'      => 'required',
            'writer'    => 'required',
            'stock'     => 'required',
        ]);
        
        if(!$rules)
        {
            return response()->json([
                'status'=> 422,
                'validationErrors'=> $validator->messages(),
            ]);
        }
        else {
            $books = Books::find($id);
            
            if(!$books)
            {
                return response()->json([
                    'status'=> 404,
                    'message' => 'No Book ID Found',
                ]);
            }
            else {
                $books->title    = $request->title;
                $books->desc     = $request->desc;
                $books->writer   = $request->writer;
                $books->stock    = $request->stock;
                $books->update();

                return response()->json([
                    'status'    => 200,
                    'message'   => 'Data update successfully',
                ]);
            }
        }
    }

    public function destroy($id)
    {
        $books = Books::find($id);

        if(!$books)
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Book ID Found',
            ]);
        } else {
            $books->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Book Deleted Successfully',
            ]);
        }
    }

    
}