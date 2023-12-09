<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }
    //show all books
    public function show($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json($book);
    }
    //store new book
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'nullable',
            'price' => 'numeric',
            'publication_date' => 'nullable|date',
        ]);
        $book = Book::create($validatedData);
        return response()->json($book, 201);
    }

    //update function 
    public function update(Request
    $request, $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return
                response()->json(['message' => 'Book not found'], 404);
        }
        $validatedData =
            $request->validate([
                'title' => 'required',
                'author' => 'required',
                'isbn' => 'nullable',
                'price' => 'numeric',
                'publication_date' =>
                'nullable|date',
            ]);
        $book->update($validatedData);
        return response()->json($book);
    }
    //delete a book
    public function destroy($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return
                response()->json(['message' => 'Book not found'], 404);
        }
        $book->delete();
        return
            response()->json(['message' => 'Book deleted successfully']);
    }
}
