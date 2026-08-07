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

class CategoryController extends Controller
{
    /**
     * @throws RandomException
     */
    private function generateCategoryId(): string
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $random = '';
        for ($i = 0; $i < 5; $i++) $random .= $characters[random_int(0, strlen($characters) - 1)];
        $id = 'CTG'.$random;
        return Category::find($id) ? $this->generateCategoryId() : $id;
    }
    public function new(): Factory|View
    {
        $viewData = [];
        $viewData["title"] = "Danh mục | Thêm mới";
        $viewData["subtitle"] = "Thêm mới";
        $viewData["activate"] = "category";

        return view('admin.category.new') -> with("viewData", $viewData);
    }
    public function index(): Factory|View
    {
        $viewData = [];
        $viewData["title"] = "Trang quản trị | Danh mục";
        $viewData["subtitle"] = "Danh mục";
        $viewData["categories"] = Category::paginate(7);

        $viewData["activate"] = "category";
        return view('admin.category.index') -> with("viewData", $viewData);
    }
    public function add(Request $request): RedirectResponse
    {
        $category = new Category();

        $category->CTG_ID = $this->generateCategoryId();
        $category->CTG_NAME = $request->input('CTG_NAME');
        $category->CTG_COLOR = $request->input('CTG_COLOR');

        $category->CTG_CREATED_AT = time();
        $category->CTG_UPDATED_AT = time();

        if ($request->hasFile('CTG_IMAGE'))
        {
            $CTG_IMAGE = $category->CTG_ID.".".$request->file('CTG_IMAGE')->extension();
            Storage::disk('public')->putFileAs('category', $request->file('CTG_IMAGE'), $CTG_IMAGE);

            $category->CTG_IMAGE = $CTG_IMAGE;
        }
        else $category->CTG_IMAGE = 'CTG_DEF.jpg';

        $category->save();

        return redirect()->route('category.index');
    }
    public function delete($id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        if ($category->CTG_IMAGE != 'CTG_DEF.png') Storage::disk('public')->delete('category/'.$category->CTG_IMAGE);

        foreach (FoodContainsCategory::all() as $fcc)
        {
            if ($fcc->CTG_ID == $category->CTG_ID) $fcc->delete();
        }

        $category->delete();
        return redirect()->route('category.index');
    }
    public function info($id)
    {
        $category = Category::findOrFail($id);

        $viewData = [];
        $viewData["title"] = "Danh mục | Chỉnh sửa";
        $viewData["subtitle"] = "Chỉnh sửa";
        $viewData["activate"] = "category";

        $viewData["category"] = $category;

        return view('admin.category.info') -> with("viewData", $viewData);
    }
    public function edit(Request $request, $id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        $category->CTG_NAME = $request->input('CTG_NAME');
        $category->CTG_COLOR = $request->input('CTG_COLOR');

        $category->CTG_UPDATED_AT = time();

        if ($request->hasFile('CTG_IMAGE'))
        {
            if ($category->CTG_IMAGE != 'CTG_DEF.png') Storage::disk('public')->delete('category/'.$category->CTG_IMAGE);
            $CTG_IMAGE = $category->CTG_ID.".".$request->file('CTG_IMAGE')->extension();
            Storage::disk('public')->putFileAs('category', $request->file('CTG_IMAGE'), $CTG_IMAGE);

            $category->CTG_IMAGE = $CTG_IMAGE;
        }

        $category->save();

        return redirect()->route('category.index');
    }
}
