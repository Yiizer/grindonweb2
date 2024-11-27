<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Order;

use App\Models\Product;

use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function view_category()
    {
        $data = Category::all();
        return view('admin.category',compact('data'));
    }

    public function add_category(Request $request)
    {
        $category = new Category;

        $category->category_name = $request->category;

        $category->save();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Category Added Succesfully');

        return redirect()->back();
    }

    public function delete_category($id)
    {
        $data = Category::find($id);

        $data->delete();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Category Deleted Succesfully');

        return redirect()->back();
    }

    public function edit_category($id)
    {
        $data = Category::find($id);

        return view('admin.edit_category',compact('data'));
    }

    public function update_category(Request $request,$id)
    {
        $data = Category::find($id);

        $data->category_name= $request->category;

        $data->save();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Category Updated Succesfully');

        return redirect('/view_category');
    }

    public function add_product()
    {
        $category = Category::all();

        return view('admin.add_product',compact('category'));
    }

    public function upload_product(Request $request)
    {
        // Validate the input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'small' => 'required|integer|min:0',
            'medium' => 'required|integer|min:0',
            'large' => 'required|integer|min:0',
            'x_small' => 'required|integer|min:0',
            'x_large' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        // Create a new product
        $data = new Product();
    
        // Assign the input values
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->category = $request->category;
    
        // Assign specific quantities
        $data->small = $request->small;
        $data->medium = $request->medium;
        $data->large = $request->large;
        $data->x_small = $request->x_small;
        $data->x_large = $request->x_large;
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('products', $imagename);
            $data->image = $imagename;
        }
    
        // Save the product to the database
        $data->save();
    
        // Show success message
        toastr()->timeOut(10000)->closeButton()->addSuccess('Product Added Successfully');
    
        // Redirect back to the form
        return redirect()->back();
    }
    
    public function view_product()
    {
        $product = Product::paginate(3);
        return view('admin.view_product', compact('product'));
    }
    

    public function delete_product($id)
{
    $data = Product::find($id);

    if ($data) {
        // Check if images exist and handle deletion
        $images = json_decode($data->images); // If you store multiple images as JSON
        if ($images && is_array($images)) {
            foreach ($images as $image) {
                $image_path = public_path('products/' . $image);

                if (is_file($image_path)) {
                    unlink($image_path);
                } else {
                    \Log::error("File not found or not valid: " . $image_path);
                }
            }
        } elseif (!empty($data->image)) {
            // Fallback for single image handling (if `image` is not JSON)
            $image_path = public_path('products/' . $data->image);

            if (is_file($image_path)) {
                unlink($image_path);
            } else {
                \Log::error("File not found or not valid: " . $image_path);
            }
        }

        // Delete the product record from the database
        $data->delete();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Product Deleted Successfully');
    } else {
        toastr()->error('Product not found!');
    }

    return redirect()->back();
}

    public function product_search(Request $request)
    {
        $search = $request->search;

        $product = Product::where('title','LIKE','%'.$search.'%')->orWhere('category','LIKE','%'.$search.'%')->paginate(3);

        return view('admin.view_product',compact('product'));
    }
    public function edit_product($id)
{
    // Fetch the product data
    $data = Product::findOrFail($id);
    
    // Fetch categories for the dropdown
    $category = Category::all(); // Assuming you have a Category model

    // Return the update page view with data and category
    return view('admin.update_page', compact('data', 'category'));
}
// Update the product in the database
public function update_product(Request $request, $id)
{
    // Validate incoming request data
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'category' => 'required|string',
        'small' => 'required|integer',
        'medium' => 'required|integer',
        'large' => 'required|integer',
        'x_small' => 'required|integer',
        'x_large' => 'required|integer',
        'image' => 'nullable|image', // Optional image upload
    ]);

    // Find the product by ID
    $product = Product::findOrFail($id);

    // Update product details
    $product->title = $validated['title'];
    $product->description = $validated['description'];
    $product->price = $validated['price'];
    $product->category = $validated['category'];
    $product->small = $validated['small'];
    $product->medium = $validated['medium'];
    $product->large = $validated['large'];
    $product->x_small = $validated['x_small'];
    $product->x_large = $validated['x_large'];

    // Handle the image upload if a new image is provided
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public'); // Store image in 'products' directory
        $product->image = $imagePath;
    }

    // Save the updated product
    $product->save();

    // Redirect with success message
    return redirect('view_product')->with('success', 'Product Updated Successfully');
}


    public function view_orders()
{
    // Fetch all orders along with the associated product (with size, color, and quantity)
    $data = Order::where('status', '!=', 'Delivered')->get();

    // Pass data to the view
    return view('admin.order', compact('data'));
}

    public function on_the_way($id)
    {
        $data = Order::find($id);

        $data->status = 'On the Way';

        $data->save();

        return redirect('/view_orders');

    }

    public function delivered($id)
    {
        // Find the order by its ID
        $data = Order::find($id);
    
        if ($data) {
            // Update the status to 'Delivered'
            $data->status = 'Delivered';
            $data->save();
        }
    
        // Redirect to the orders view
        return redirect('/view_orders')->with('success', 'Order marked as delivered!');
    }
    
    public function print_pdf($id)
    {
        $data = Order::find($id);
    
        
        $pdf = Pdf::loadView('admin.invoice', compact('data'));
    
        return $pdf->download('invoice.pdf');
    }

    public function messages()
    {
        $messages = \App\Models\Contact::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.messages', compact('messages'));
    }

        public function completed_orders()
    {
        // Fetch completed orders from the database
        $data = Order::where('status', 'Delivered')->get();

        // Pass data to the view
        return view('admin.completed_orders', compact('data'));
    }

}