<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Food;
use App\Models\FoodContainsCategory;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Random\RandomException;
use function Laravel\Prompts\alert;

class UserController extends Controller
{
    public function index(): Factory|View
    {
        $viewData = [];
        $viewData["title"] = "Trang quản trị | Người dùng";
        $viewData["subtitle"] = "Người dùng";
        $viewData["users"] = User::paginate(7);

        $viewData["activate"] = "user";
        return view('admin.user.index') -> with("viewData", $viewData);
    }

    public function money(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $old_money = $user->balance;

        $user->balance = $old_money + $request->input('money');
        $user->updated_at = time();
        $user->save();

        return redirect()->route('user.index');
    }
    public function role(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $old_role = $user->role;

        if ($old_role == 'admin') $user->role = 'client';
        else $user->role = 'admin';

        $user->updated_at = time();
        $user->save();

        return redirect()->route('user.index');
    }
}
