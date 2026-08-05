<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class MyAccountController extends Controller
{
    public function index()
        {
            return view('myaccount.index');
        }
    public function orders()
        {
            $viewData = [];
            $viewData["title"] = "My Orders - Online Store";
            $viewData["subtitle"] = "My Orders";
            $viewData["orders"] = Order::with('foodOrders')->where('user_id', Auth::user()->id)->get();
            return view('myaccount.orders')->with("viewData", $viewData);
        }

    public function update(Request $request)
    {
        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->password != null){
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success','Profile updated successfully!');
    }
}
