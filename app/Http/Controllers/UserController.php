<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    

    public function subbmitRegister(Request $request)
    {
        dd($request);
        $validatedData = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        try {
            $user = User::create($validatedData);
            Session::flash('success', 'User registered successfully');
            return redirect()->route('home');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                Session::flash('error', 'Email already exists.');
                return redirect()->back()->withInput();
            }
            Session::flash('error', 'Failed to register user.');
            return redirect()->back()->withInput();
        }
    }
    


    public function register()
    {

        return view('pages.register');
    }

    public function login()
    {
        return view('pages.login');
    }
    public function add_products()
    {
        return view('pages.add_products');
    }
    public function home()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $user = Auth::user();
        session(['user' => $user]);

        $products = \App\Models\products::all();

        return view('pages.home', compact('products'));
    }

    public function checkLogin(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                session(['user' => $user]);
                return redirect()->route('home');
            } else {
                Session::flash('error', 'Invalid email or password');
                return redirect()->route('login');
            }
        } catch (\Exception $e) {
            Session::flash('error', 'Login failed. Please try again.');
            return redirect()->route('login');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }


public function add_products_submit(Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        'category' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    try {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $product = new \App\Models\products();
            $product->product_name = $request->name;
            $product->product_price = $request->price;
            $product->product_quantity = $request->quantity;
            $product->product_category = $request->category;

            // Store the image
            $path = $request->file('image')->store('public/products');
            if (!$path) {
                throw new \Exception('Failed to store image.');
            }
            $product->product_image = $path;

            // Save the product
            $product->save();

            Session::flash('success', 'Product added successfully');
            return redirect()->route('home');
        } else {
            dd('Image upload failed or image is not valid.');
            return redirect()->back()->withErrors(['image' => 'Image upload failed or image is not valid.'])->withInput();
        }
    } catch (\Exception $e) {
    
        dd($e->getMessage());
        return redirect()->back()->withErrors(['error' => 'An error occurred while adding the product.'])->withInput();
    }
}



    
}

