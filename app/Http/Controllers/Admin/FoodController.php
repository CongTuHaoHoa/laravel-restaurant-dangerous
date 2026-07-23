<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class FoodController extends Controller
{
//    public function insert(Request $request)
//    {
//        alert("Ok");
//        $title = $request->input('title');
//        $author = $request->input('author');
//        $price = $request->input('price');
//        $published_year = $request->input('published_year');
//        $max = Book::max('id');
//
//        $book = new Book();
//        $book->id = $max + 1;
//        $book->title = $title;
//        $book->author = $author;
//        $book->price = $price;
//        $book->published_year = $published_year;
//        $book->setAttribute('timestamps', time());
//        $book->save();
//        return redirect()->route('book.index');
//    }
//    public function delete($id)
//    {
//        $book = Book::findOrFail($id);
//        $book->delete();
//        return redirect()->route('book.index');
//    }
//    public function edit(Request $request, $id)
//    {
//        alert("Ok");
//        $title = $request->input('title');
//        $author = $request->input('author');
//        $price = $request->input('price');
//        $published_year = $request->input('published_year');
//
//        $book = Book::findOrFail($id);
//        $book->title = $title;
//        $book->author = $author;
//        $book->price = $price;
//        $book->published_year = $published_year;
//        $book->save();
//        return redirect()->route('book.index');
//    }
    public function new()
    {
        $viewData = [];
        $viewData["title"] = "Món ăn | Thêm mới";
        $viewData["subtitle"] = "Thêm mới";
        $viewData["activate"] = "food";
        return view('admin.food.new') -> with("viewData", $viewData);
    }
    public function index(): Factory|View
    {
        $viewData = [];
        $viewData["title"] = "Trang quản trị | Món ăn";
        $viewData["subtitle"] = "Món ăn";
        $viewData["foods"] = Food::paginate(3);

        $viewData["activate"] = "food";
        return view('admin.food.index') -> with("viewData", $viewData);
    }

//    public function change($id)
//    {
//        $viewData = [];
//        $book = Book::findOrFail($id);;
//        $viewData["title"] = $book["title"] . " - Trần Ngọc Thanh Vũ";
//        $viewData["subtitle"] = $book["title"] . " - Book information";
//        $viewData["book"] = $book;
//
//        return view('books.change') -> with("viewData", $viewData);
//    }
//
//    public function show($id)
//    {
//        $viewData = [];
//        $book = Book::findOrFail($id);;
//        $viewData["title"] = $book["title"] . " - Trần Ngọc Thanh Vũ";
//        $viewData["subtitle"] = $book["title"] . " - Book information";
//        $viewData["book"] = $book;
//        return view('books.show') -> with("viewData", $viewData);
//    }
}
