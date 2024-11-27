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
            $data->price = $product->price;
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
            toastr()->error('Please select a payment method.');
            return redirect()->back();
        }
    
        $paymentMethod = $request->payment_method;
        $referenceNumber = $request->reference_number;
    
        // Validation: Check if reference number is provided for GCash
        if ($paymentMethod === 'gcash' && empty($referenceNumber)) {
            toastr()->error('Please provide a reference number for GCash payment.');
            return redirect()->back();
        }
    
        DB::beginTransaction();
    
        try {
            $name = $request->name;
            $address = $request->address;
            $phone = $request->phone;
            $userid = Auth::user()->id;
            $cart = Cart::where('user_id', $userid)->get();
    
            // **Stock Validation Loop**
            foreach ($cart as $carts) {
                $product = Product::find($carts->product_id);
    
                // Check if product exists
                if (!$product) {
                    DB::rollBack(); // Rollback transaction to avoid partial operations
                    toastr()->error('A product in your cart no longer exists.');
                    return redirect()->back();
                }
    
                // Get available stock for the selected size
                $availableStock = $this->getAvailableStockForSize($product, $carts->size);
    
                // Check if the cart quantity exceeds available stock
                if ($carts->quantity > $availableStock) {
                    DB::rollBack(); // Rollback transaction
                    toastr()->error("Insufficient stock for '{$product->title}' ({$carts->size}). Available: {$availableStock}, Requested: {$carts->quantity}.");
                    return redirect()->back();
                }
            }
    
            // **Order Creation and Stock Deduction**
            foreach ($cart as $carts) {
                $product = Product::find($carts->product_id);
    
                // Create the order
                $order = new Order;
                $order->product_id = $carts->product_id;
                $order->size = $carts->size;
                $order->color = $carts->color;
                $order->quantity = $carts->quantity;
                $order->name = $name;
                $order->rec_address = $address;
                $order->phone = $phone;
                $order->user_id = $userid;
                $order->status = 'in progress';
                $order->payment_method = $paymentMethod;
    
                if ($paymentMethod === 'gcash') {
                    $order->reference_number = $referenceNumber;
                }
    
                $order->save();
    
                // Deduct stock based on size
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
    
            // Clear the cart after successful order
            Cart::where('user_id', $userid)->delete();
    
            DB::commit();
    
            // Success message
            toastr()->success('Product Ordered Successfully');
            return redirect('/');
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('Order failed: ' . $e->getMessage());
            return redirect()->back();
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