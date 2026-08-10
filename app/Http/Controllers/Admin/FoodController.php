<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Food;
use App\Models\FoodContainsCategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Random\RandomException;

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
    public function delete($id): RedirectResponse
    {
        $food = Food::findOrFail($id);
        if ($food->FOD_IMAGE != 'FOD_DEF.jpg') Storage::disk('public')->delete('food/'.$food->FOD_IMAGE);
        $food->delete();
        foreach (FoodContainsCategory::all() as $fcc)
        {
            if ($fcc->FOD_ID == $food->FOD_ID) $fcc->delete();
        }
        return redirect()->route('food.index');
    }

    /**
     * @throws RandomException
     */
    private function generateFoodId(): string
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $random = '';
        for ($i = 0; $i < 5; $i++) $random .= $characters[random_int(0, strlen($characters) - 1)];
        $id = 'FOD'.$random;
        return Food::find($id) ? $this->generateFoodId() : $id;
    }

    /**
     * @throws RandomException
     */
    private function generateFCCId(): string
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $random = '';
        for ($i = 0; $i < 5; $i++) $random .= $characters[random_int(0, strlen($characters) - 1)];
        $id = 'FCC'.$random;
        return FoodContainsCategory::find($id) ? $this->generateFCCId() : $id;
    }
    public function new(): Factory|View
    {
        $viewData = [];
        $viewData["title"] = "Món ăn | Thêm mới";
        $viewData["subtitle"] = "Thêm mới";
        $viewData["activate"] = "food";
        $viewData["categories"] = Category::all();

        return view('admin.food.new') -> with("viewData", $viewData);
    }
    public function add(Request $request): RedirectResponse
    {
        $food = new Food();

        $food->FOD_ID = $this->generateFoodId();
        $food->FOD_NAME = $request->input('FOD_NAME');
        $food->FOD_DESCRIPTION = $request->input('FOD_DESCRIPTION');
        $food->FOD_PRICE = $request->input('FOD_PRICE');
        $food->FOD_STATUS = $request->boolean('FOD_STATUS');

        $food->FOD_CREATED_AT = time();
        $food->FOD_UPDATED_AT = time();

        if ($request->hasFile('FOD_IMAGE'))
        {
            $FOD_IMAGE = $food->FOD_ID.".".$request->file('FOD_IMAGE')->extension();
            Storage::disk('public')->putFileAs('food', $request->file('FOD_IMAGE'), $FOD_IMAGE);

            $food->FOD_IMAGE = $FOD_IMAGE;
        }
        else $food->FOD_IMAGE = 'FOD_DEF.jpg';

        $food->save();

        foreach (Category::all() as $category)
        {
            if ($request->boolean($category->CTG_ID))
            {
                $fcc = new FoodContainsCategory();
                $fcc->FCC_ID = $this->generateFCCId();
                $fcc->FOD_ID = $food->FOD_ID;
                $fcc->CTG_ID = $category->CTG_ID;

                $fcc->save();
            }
        }

        return redirect()->route('food.index');
    }

    public function edit(Request $request, $id): RedirectResponse
    {
        $food = Food::findOrFail($id);

        $food->FOD_NAME = $request->input('FOD_NAME');
        $food->FOD_DESCRIPTION = $request->input('FOD_DESCRIPTION');
        $food->FOD_PRICE = $request->input('FOD_PRICE');
        $food->FOD_STATUS = $request->boolean('FOD_STATUS');
        $food->FOD_UPDATED_AT = time();

        if ($request->hasFile('FOD_IMAGE'))
        {
            if ($food->FOD_IMAGE != 'FOD_DEF.jpg') Storage::disk('public')->delete('food/'.$food->FOD_IMAGE);
            $FOD_IMAGE = $food->FOD_ID.".".$request->file('FOD_IMAGE')->extension();
            Storage::disk('public')->putFileAs('food', $request->file('FOD_IMAGE'), $FOD_IMAGE);

            $food->FOD_IMAGE = $FOD_IMAGE;
        }

        $food->save();

        foreach (FoodContainsCategory::all() as $fcc)
        {
            if ($fcc->FOD_ID == $food->FOD_ID) $fcc->delete();
        }

        foreach (Category::all() as $category)
        {
            if ($request->boolean($category->CTG_ID))
            {
                $fcc = new FoodContainsCategory();
                $fcc->FCC_ID = $this->generateFCCId();
                $fcc->FOD_ID = $food->FOD_ID;
                $fcc->CTG_ID = $category->CTG_ID;

                $fcc->save();
            }
        }

        return redirect()->route('food.index');
    }
    public function index(): Factory|View
    {
        $viewData = [];
        $viewData["title"] = "Trang quản trị | Món ăn";
        $viewData["subtitle"] = "Món ăn";
        $viewData["foods"] = Food::paginate(7);

        $viewData["activate"] = "food";
        return view('admin.food.index') -> with("viewData", $viewData);
    }

    public function info($id)
    {
        $food = Food::findOrFail($id);

        $viewData = [];
        $viewData["title"] = "Món ăn | Chỉnh sửa";
        $viewData["subtitle"] = "Chỉnh sửa";
        $viewData["activate"] = "food";

        $viewData["food"] = $food;
        $viewData["categories"] = Category::all();

        return view('admin.food.info') -> with("viewData", $viewData);
    }
}
