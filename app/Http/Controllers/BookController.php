<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Http\Controllers\Controller;
use App\Traits\ImageTrait;


class BookController extends Controller
{
    use ImageTrait;
    public function store(BookRequest $request)
    {
        $input = $request->all();
        $input['image'] = $this->imageUpload($request);
        Book::create($input);

        return response()->json([
            'message' => 'book save succesfully',
            'code' => 200
        ]);
    }

    public function index()
    {
        $books = Book::paginate(10);
        return response()->json([
            'books' => $books,
            'status' => 'OK',
            'code' => 200
        ]);
    }

    public function Show($id)
    {
        $book = Book::find($id);

        if($book){
              return response()->json([
            'book' =>  $book,
        ]);
        }
        else{
            return response()->json([
                'message' =>  'The book id is not found.',
            ]);
        }
    }

    public function update(BookRequest  $request, $id)
    {
        $book = Book::findOrFail($id);
        $input = $request->all();
        $input['image'] = $this->imageUpload($request);
        $book->update($input);

        return response()->json([
            'message' => 'Book data update succesfully',
            'code' => 200
        ]);
    }

    public function delete($id)
    {
        $book = Book::find($id);
        if ($book) {
            $upload_path = public_path('images'). '/'. $book->image;
            unlink($upload_path);
            $book->delete();
            return response()->json([
                'message' => 'Book Delete succesfully',
                'code' => 200
            ]);
        } else {
            return response()->json([
                'message' => "Book with id:$id does not exists.",

            ]);
        }
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'search' => 'required',
        ]);

        if ($request->filled('search')) {
            $result =  Book::whereLike(['title', 'author', 'genre', 'description', 'isbn', 'publisher', 'published'], $request->search)->paginate(5);
          
            if($result){
                return response()->json([
                    'result' => $result,
                    'status' => 'OK',
                    'code' => 200
                ]);
            }
            else{
                return response()->json([
                    'message' => 'No records found'
                ]);
            }
          
        }
    }
}
