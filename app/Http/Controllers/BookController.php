<?php

namespace App\Http\Controllers;

use App\Models\Book;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::orderBy('created_at', 'DESC')->paginate(10);

        return view('books.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'price' => 'required|numeric',
            'publisher' => 'required',
            'isbn' => 'required|numeric',
        ]);

        $book = new Book;

        $book->title = $request->title;
        $book->author = $request->author;
        $book->price = $request->price;
        $book->publisher = $request->publisher;
        $book->isbn = $request->isbn;

        $book->save();
        notify()->success('Book successfully added.');
        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'price' => 'required|numeric',
            'publisher' => 'required',
            'isbn' => 'required|numeric',
        ]);

        $book->title = $request->title;
        $book->author = $request->author;
        $book->price = $request->price;
        $book->publisher = $request->publisher;
        $book->isbn = $request->isbn;

        $book->update();
        notify()->success('Book successfully updated.');
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        notify()->success('Book successfully deleted.');
        return redirect()->route('books.index');
    }

    //get pdf
    public function getPdf()
    {
        // $books = Book::get();

        $books = Book::whereBetween('id', [1, 50])->get();

        $pdf = PDF::LoadView('books.download', ['books' => $books]);

        return $pdf->download('books.pdf');

    }

    //search
    public function search(Request $request)
    {
        // dd($request->all());
        $search = $request->search;

        $books = Book::where('title', 'like', '%' . $search . '%')
        ->orWhere('author', 'like', '%' . $search . '%')
        ->orWhere('publisher', 'like', '%' . $search . '%')
        ->orWhere('isbn', 'like', '%' . $search . '%')
        ->paginate(10);

        return view('books.index', ['books' => $books]);
    }

}
