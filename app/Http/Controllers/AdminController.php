<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Admin;

class AdminController extends Controller
{
    //
    use PasswordValidationRules;
    public function index()
    {
        $orders = Order::select(DB::raw("COUNT(*) as count, MONTH(created_at) as month"))->whereYear('created_at', '20'.date('y'))
        ->groupBy('month')->get();
        return view("dashboard")->with([
            'categories' => Category::has('products')->get(),
            'products' => Product::orderBy('created_at', 'desc')->limit(6)->get(),
            'orders' => $orders,
        ]);
    }
    public function showAllProducts()
    {
        $orders = Order::select(DB::raw("COUNT(*) as count, MONTH(created_at) as month"))->whereYear('created_at', '20'.date('y'))
        ->groupBy('month')->get();
        return view("dashboard")->with([
            'categories' => Category::has('products')->get(),
            'products' => Product::latest()->get(),
            'orders' => $orders,
        ]);
    }
    public function showAdminProfile()
    {
        return view("profile.show");
    }
    public function showAdminLoginForm()
    {
        return view("admin.auth.login");
    }
    public function adminLogin(Request $request)
    {
        // Validator::make($request->toArray(), [
        //     'email' => [
        //         'required',
        //         'string',
        //         'email',
        //         'max:255',
        //         Rule::unique(Admin::class),
        //     ],
        //     'password' => $this->passwordRules(),
        // ])->validate();
        
        if (auth()->guard("admin")->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ],$request->get("remember"))) {
            return redirect("/");
        }else {
            return redirect()->route('admin.login');
        }
    }

    public function adminLogout()
    {
        auth()->guard("admin")->logout();
        return redirect('auth.login');
    }
    public function update()
    {
        
    }
}
