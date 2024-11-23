<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

use App\Models\User;

use App\Models\Cart;

use App\Models\Order;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {

        $user = User::where('usertype','user')->get()->count();

        $product = Product::all()->count();

        $order = Order::all()->count();

        $deliverd = Order::where('status','Delivered')->get()->count();

        return view('admin.index',compact('user','product','order','deliverd'));
    }

    public function home()
    {
        $product = Product::all();

        if(Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id',$userid)->count();
        }

        else
        {
            $count = '';
        }

        return view('home.index',compact('product','count'));
    }

    public function login_home()
    {
        $product = Product::all();

        if(Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id',$userid)->count();
        }
        
        else
        {
            $count = '';
        }


        return view('home.index',compact('product','count'));
    }

    public function product_details($id)
    {
        $data = Product::find($id);

        if(Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id',$userid)->count();
        }
        
        else
        {
            $count = '';
        }


        return view('home.product_details',compact('data','count'));
    }

    public function add_cart(Request $request, $id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
        
        // Validate input
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->quantity,
            'size' => 'required|string',
            'color' => 'required|string',
        ]);
        
        $user = Auth::user();
        $user_id = $user->id;
        
        $size = $request->input('size');
        $color = $request->input('color');
        $quantity = $request->input('quantity');
        
        // Check if the quantity requested is available in stock
        if ($quantity > $product->quantity) {
            return redirect()->back()->with('error', 'Insufficient stock available.');
        }
        
        $existingCart = Cart::where('user_id', $user_id)
                            ->where('product_id', $product->id)
                            ->where('size', $size)
                            ->where('color', $color)
                            ->first();
        
        if ($existingCart) {
            $existingCart->quantity += $quantity;
            $existingCart->save();
        } else {
            $data = new Cart;
            $data->user_id = $user_id;
            $data->product_id = $product->id;
            $data->size = $size;
            $data->color = $color;
            $data->quantity = $quantity;
            $data->save();
        }
        
        toastr()->timeOut(10000)->closeButton()->addSuccess('Product Added to the Cart Successfully');
        return redirect()->back();
    }
    
    public function mycart()
    {
        if(Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id',$userid)->count();

            $cart = Cart::where('user_id',$userid)->get();
        }

        return view('home.mycart',compact('count','cart'));
    }

    public function delete_cart($id)
    {
        $data = Cart::find($id);

        $data->delete();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Product Remove to the Cart Succesfully');

        return redirect()->back();
    }

   public function confirm_order(Request $request)
{
    DB::beginTransaction();

    try {
        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;
        $userid = Auth::user()->id;
        $cart = Cart::where('user_id', $userid)->get();

        foreach ($cart as $carts) {
            // Create the order
            $order = new Order;
            $order->product_id = $carts->product_id;
            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $userid;
            $order->size = $carts->size;
            $order->color = $carts->color;
            $order->quantity = $carts->quantity;
            $order->status = 'in progress'; // Default status
            $order->save();

            // Deduct product stock
            $product = Product::find($carts->product_id);
            $product->quantity -= $carts->quantity;
            $product->save();
        }

        // Clear the cart after order confirmation
        Cart::where('user_id', $userid)->delete();

        DB::commit();
        
        toastr()->timeOut(10000)->closeButton()->addSuccess('Product Ordered Successfully');
        return redirect()->back();
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Order failed: ' . $e->getMessage());
    }
}

    public function myorders()
    {
        $user = Auth::user()->id;

        $count = Cart::where('user_id',$user)->get()->count();

        $order = Order::where('user_id',$user)->get();

        return view('home.order',compact('count','order'));
    }

    public function shop()
    {
        $product = Product::all();

        if(Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id',$userid)->count();
        }

        else
        {
            $count = '';
        }

        return view('home.shop',compact('product','count'));
    }

    public function why()
    {

        if(Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id',$userid)->count();
        }

        else
        {
            $count = '';
        }

        return view('home.why',compact('count'));
    }

    public function testimonial()
    {

        if(Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id',$userid)->count();
        }

        else
        {
            $count = '';
        }

        return view('home.testimonial',compact('count'));
    }

    public function contact()
    {

        if(Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id',$userid)->count();
        }

        else
        {
            $count = '';
        }

        return view('home.contact',compact('count'));
    }
}