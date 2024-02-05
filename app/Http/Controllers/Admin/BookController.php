<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {

            $books = Book::get();
            
            return DataTables::of($books)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $btn = '<a class="text-primary btn btn-datatable btn-icon btn-transparent-dark editBook" data-id=' . $row->id . '"><i class="ri-pencil-fill fs-18"></i></a>
                    <a class="text-danger btn btn-datatable btn-icon btn-transparent-dark deleteBook" data-id=' . $row->id . '><i class="ri-delete-bin-5-fill fs-18"></i></a>';
                    return $btn;
                })
                ->addColumn('image', function ($row) {
                    return '<img src="'.$row->image.'" class="img-responsive" style="max-height:100px; max-width:100px;">';
                })


                ->rawColumns(['action','image'])
                ->toJson();
        }
        return view('admin.books.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'author' => 'required|string',
            'price' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $book = new Book();
        $book->name = $request->name;
        $book->author = $request->author;
        $book->price = $request->price;
        $book->language = $request->language;
        $book->description = $request->description;

        if (file($request->image)) {
            $file = $request->image;
            $imagename = time() . $file->getClientOriginalName();
            $file->move(public_path('/book-img/'), $imagename);
            $book->image = "/book-img/" . $imagename;
        }
        $book->save();

        return redirect()->back()->with('success', 'Book Created Successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $book = Book::find($id);
        $imageUrl = $book->image;

        return response()->json([
            'id' => $book->id,
            'name' => $book->name,
            'author' => $book->author,
            'price' => $book->price,
            'language' => $book->language,
            'description' => $book->description,
            'image_url' => $imageUrl,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'author' => 'required|string',
            'price' => 'required|integer',
        ]);

        $book = Book::find($id);
        $book->name = $request->name;
        $book->author = $request->author;
        $book->price = $request->price;
        $book->language = $request->language;
        $book->description = $request->description;
        if ($request->image) {
            if ($book->image) {
                @unlink(public_path($book->image));
                $file = $request->image;
                $imagename = time() . $file->getClientOriginalName();
                $file->move(public_path('/book-img/'), $imagename);
                $book->image = "/book-img/" . $imagename;
            } else {
                $file = $request->image;
                $imagename = time() . $file->getClientOriginalName();
                $file->move(public_path('/book-img/'), $imagename);
                $book->image = "/book-img/" . $imagename;
            }
        }


        $book->update();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);
        $book->delete();
        return response()->json(['success' => 'Book deleted successfully!']);
    }
}
