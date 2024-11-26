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
        // Fetch the product by its ID
        $product = Product::find($id);
    
        // Check if the product exists
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
    
        // Validate input for quantity, size, and color
        $request->validate([
            'size' => 'required|string|in:small,medium,large,x_small,x_large', // Validate size input
            'color' => 'required|string', // Validate color input
            'quantity' => 'required|integer|min:1|max:' . $this->getAvailableStockForSize($product, $request->input('size')), // Validate quantity input
        ]);
    
        // Get user information
        $user = Auth::user();
        $user_id = $user->id;
    
        // Get the size, color, and quantity from the request
        $size = $request->input('size');
        $color = $request->input('color');
        $quantity = $request->input('quantity');
    
        // Check if requested quantity is available for the selected size
        if ($quantity > $this->getAvailableStockForSize($product, $size)) {
            return redirect()->back()->with('error', 'Insufficient stock available for the selected size.');
        }
    
        // Check if the product with the selected size and color already exists in the user's cart
        $existingCart = Cart::where('user_id', $user_id)
                            ->where('product_id', $product->id)
                            ->where('size', $size)
                            ->where('color', $color)
                            ->first();
    
        // If the product is already in the cart, update the quantity
        if ($existingCart) {
            $existingCart->quantity += $quantity; // Add to the existing quantity
            $existingCart->save();
        } else {
            // If the product is not in the cart, create a new cart entry
            $data = new Cart;
            $data->user_id = $user_id;
            $data->product_id = $product->id;
            $data->size = $size;
            $data->color = $color;
            $data->quantity = $quantity;
            $data->save();
        }
    
        // Show a success message using toastr
        toastr()->timeOut(10000)->closeButton()->addSuccess('Product added to the cart successfully!');
        
        // Redirect the user back to the previous page
        return redirect()->back();
    }
    
    /**
     * Get available stock for the selected size
     */
    private function getAvailableStockForSize($product, $size)
    {
        // Return the stock based on the size selected
        switch ($size) {
            case 'small':
                return $product->small ?? 0;
            case 'medium':
                return $product->medium ?? 0;
            case 'large':
                return $product->large ?? 0;
            case 'x_small':
                return $product->x_small ?? 0;
            case 'x_large':
                return $product->x_large ?? 0;
            default:
                return 0; // If the size doesn't match, return 0
        }
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
    // Ensure a payment method is selected
    if (!$request->has('payment_method')) {
        return redirect()->back()->with('error', 'Please select a payment method.');
    }

    $paymentMethod = $request->payment_method;
    $referenceNumber = $request->reference_number; // Reference number for GCash, may be null for other methods

    // Validation: Check if reference number is provided for GCash
    if ($paymentMethod === 'gcash' && empty($referenceNumber)) {
        return redirect()->back()->with('error', 'Please provide a reference number for GCash payment.');
    }

    // Begin the transaction to ensure atomic operations
    DB::beginTransaction();

    try {
        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;
        $userid = Auth::user()->id;
        $cart = Cart::where('user_id', $userid)->get();

        foreach ($cart as $carts) {
            // Create the order and save payment method
            $order = new Order;
            $order->product_id = $carts->product_id;
            $order->size = $carts->size;             // Size from cart
            $order->color = $carts->color;           // Color from cart
            $order->quantity = $carts->quantity;     // Quantity from cart
            $order->name = $name;                    // User's name
            $order->rec_address = $address;          // User's address
            $order->phone = $phone;                  // User's phone
            $order->user_id = $userid;               // User ID
            $order->status = 'in progress';          // Default status

            // Save selected payment method
            $order->payment_method = $paymentMethod;

            // If GCash is selected, save the reference number
            if ($paymentMethod === 'gcash') {
                $order->reference_number = $referenceNumber; // Save the reference number if GCash
            }

            $order->save();

            // Deduct product stock after order creation
            $product = Product::find($carts->product_id);

            // Check if the product's size is available in stock
            $availableStock = $this->getAvailableStockForSize($product, $carts->size);
            if ($carts->quantity > $availableStock) {
                return redirect()->back()->with('error', 'Insufficient stock available for the selected size.');
            }

            // Deduct the stock from the product's specific size
            switch ($carts->size) {
                case 'small':
                    $product->small -= $carts->quantity;
                    break;
                case 'medium':
                    $product->medium -= $carts->quantity;
                    break;
                case 'large':
                    $product->large -= $carts->quantity;
                    break;
                case 'x_small':
                    $product->x_small -= $carts->quantity;
                    break;
                case 'x_large':
                    $product->x_large -= $carts->quantity;
                    break;
            }

            $product->save();
        }

        // Clear the cart after the order is confirmed
        Cart::where('user_id', $userid)->delete();

        // Commit the transaction
        DB::commit();

        // Show success message
        toastr()->timeOut(10000)->closeButton()->addSuccess('Product Ordered Successfully');
        return redirect('/'); // Optionally redirect to a success page
    } catch (\Exception $e) {
        // Rollback in case of failure
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