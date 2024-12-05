<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Order;

use App\Models\Product;

use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\Storage;


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
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
    
        // Create a new product
        $data = new Product();
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->category = $request->category;
        $data->small = $request->small;
        $data->medium = $request->medium;
        $data->large = $request->large;
        $data->x_small = $request->x_small;
        $data->x_large = $request->x_large;
    
        // Handle image upload
        if ($request->hasFile('images') && is_array($request->file('images'))) {
            $images = $request->file('images');
            $imageNames = [];
    
            foreach ($images as $image) {
                // Generate a unique file name and store it in the public/images/products folder
                $extension = $image->getClientOriginalExtension(); // This will return "webp" for .webp files.
                $imageName = time() . '_' . rand() . '.' . $extension;
                // Store the image in the 'public/images/products' folder
                $image->move(public_path('images/products'), $imageName);  // Store in public/images/products/
                // Save the relative path to the image
                $imageNames[] = 'images/products/' . $imageName;
            }
    
            // Save all image names as JSON
            $data->image = json_encode($imageNames);
        }
    
        // Save the product to the database
        $data->save();
    
        // Show success message
        toastr()->timeOut(10000)->closeButton()->addSuccess('Product Added Successfully');
    
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
        'small' => 'required|integer|min:0',
        'medium' => 'required|integer|min:0',
        'large' => 'required|integer|min:0',
        'x_small' => 'required|integer|min:0',
        'x_large' => 'required|integer|min:0',
        'images' => 'nullable|array',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'delete_images' => 'nullable|array',
        'replace_images' => 'nullable|array',
        'replace_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Find the product by ID
    $product = Product::findOrFail($id);

    // Update basic product details
    $product->title = $validated['title'];
    $product->description = $validated['description'];
    $product->price = $validated['price'];
    $product->category = $validated['category'];
    $product->small = $validated['small'];
    $product->medium = $validated['medium'];
    $product->large = $validated['large'];
    $product->x_small = $validated['x_small'];
    $product->x_large = $validated['x_large'];

    // Get current product images (if any)
    $currentImages = json_decode($product->image, true) ?: [];

    // Handle image deletion
    if ($request->has('delete_images') && is_array($validated['delete_images'])) {
        foreach ($validated['delete_images'] as $index => $delete) {
            if ($delete == '1' && isset($currentImages[$index])) {
                // Delete the image from storage
                $currentImagePath = public_path($currentImages[$index]);
                if (file_exists($currentImagePath)) {
                    unlink($currentImagePath); // Delete the image from the public folder
                }
                unset($currentImages[$index]); // Remove from the array
            }
        }
    }

    // Handle image replacements
    if ($request->hasFile('replace_images') && is_array($request->file('replace_images'))) {
        foreach ($request->file('replace_images') as $index => $newImage) {
            if (isset($currentImages[$index])) {
                // Delete the old image from storage
                $currentImagePath = public_path($currentImages[$index]);
                if (file_exists($currentImagePath)) {
                    unlink($currentImagePath); // Delete the old image
                }

                // Store the new image and replace it in the array
                $newImageName = time() . '_' . rand() . '.jpg'; // Generate a unique filename
                $newImage->move(public_path('images/products'), $newImageName); // Store in 'public/images/products'
                $currentImages[$index] = 'images/products/' . $newImageName; // Save the relative path
            }
        }
    }

    // Handle new image uploads
    if ($request->hasFile('images') && is_array($request->file('images'))) {
        foreach ($request->file('images') as $image) {
            // Generate a unique name for each new image
            $newImageName = time() . '_' . rand() . '.jpg';
            $image->move(public_path('images/products'), $newImageName);  // Store in 'public/images/products'
            $currentImages[] = 'images/products/' . $newImageName; // Save the relative path
        }
    }

    // Update the image field (save the image paths in JSON format)
    $product->image = !empty($currentImages) ? json_encode(array_values($currentImages)) : null;

    // Save the updated product
    $product->save();

    // Redirect with a success message
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