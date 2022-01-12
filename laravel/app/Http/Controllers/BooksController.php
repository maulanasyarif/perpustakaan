<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;

class BooksController extends Controller
{
    //get all data
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
        $book = new Books;
        $book->title    = $request->title;
        $book->desc     = $request->desc;
        $book->writer   = $request->writer;
        $book->image    = md5($request->image) . '.' . $request->image->extension('photo');
        $book->save();

        $photo = $request->photo;
        $extension = $photo->getClientOriginalExtension();
        $fileName = $data->photo;
        $photo->move(\public_path('/assets/images'), $fileName);
        $photo = $fileName;
        
        // $photo = $request->image;
        // $extension = $photo->getClientOriginalExtension();
        // $fileName = $data->photo;
        // $path = Storage::putFileAs('public/photos',$fileName);
        // $photo = $fileName;

        return response()->json([
            'status'    => 200,
            'message'   => 'Data created successfully',
        ]);
    }
}