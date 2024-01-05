<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BookController extends Controller
{

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'co_id' => ['required',Rule::exists('content_owner','idx')],
            'publisher_id' => ['required',Rule::exists('publisher','idx')],
            'bookname' => 'required',
            'cover_photo' => ['required','image'],
            'price'=> ['required','min:1']
        ]);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors(),'data'=>$request->all()],401);
        }
        $cleanData = $validator->validated();
        $cleanData['book_uniq_idx'] = 'BOK00'. fake()->randomNumber(4,true);
        $cleanData['cover_photo'] = $request->cover_photo->store('books-images');
        Book::create($cleanData);
    }

    public function editBook($idx,Request $request){
        $validator = Validator::make($request->all(),[
            'co_id' => ['required',Rule::exists('content_owner','idx')],
            'publisher_id' => ['required',Rule::exists('publisher','idx')],
            'bookname' => 'required',
            'cover_photo' => ['required','image'],
            'price'=> ['required','min:1']
        ]);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors(),'data'=>$request->all()],401);
        }
        $cleanData = $validator->validated();
        $cleanData['cover_photo'] = $request->cover_photo->store('books-images');
        Book::where('book_uniq_idx',$idx)->update($cleanData);
    }

    public function get(){
        return BookResource::collection(Book::with('publisher','author')->get());
    }

    public function getBook(Book $book){
        return $book->load('publisher','author');
    }

    public function destroyBook($idx){
        Book::where('book_uniq_idx',$idx)->delete();
    }
}
