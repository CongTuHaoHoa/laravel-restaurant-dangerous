<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

        $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'password' => 'nullable|min:8',
        'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;

        if ($request->hasFile('avatar'))
            {
                if ($user->avatar != 'USR_DEF.jpg') Storage::disk('public')->delete('user/'.$user->avatar);

                $avatar = $user->id . "." . $request->file('avatar')->extension();

                Storage::disk('public')->putFileAs('user',$request->file('avatar'), $avatar);
                $user->avatar = $avatar;
            }

        if($request->password != null){
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success','Profile updated successfully!');
    }

    public function delivered($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 3;
        $order->save();

        return back();
    }
    }
