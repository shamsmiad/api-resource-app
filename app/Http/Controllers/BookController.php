<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BookResource::collection(Book::with('ratings')->paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        {
          $book =  Book::create([
                'user_id'=> $request->id,
                'title'=> $request->title,
                'description'=> $request->description
            ]);
            return new BookResource($book);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        if($request->user->id != $book->user_id ){
            return response()->json(['error' => 'You can only edit your own books.'], 403);
        }
        $book ->update($request->only('title','description'));
        return new BookResource($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json(null, 204);
    }
}
