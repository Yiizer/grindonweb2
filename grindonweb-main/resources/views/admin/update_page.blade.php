<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')

    <style type="text/css">
        body {
            background-color: #2c2c2c;
            color: #ffffff;
            font-family: 'Arial', sans-serif;
        }

        .container-fluid {
            margin-top: 30px;
        }

        h2 {
            text-align: center;
            font-size: 28px;
            color: #ffffff;
            margin-bottom: 20px;
        }

        .form-container {
            width: 60%;
            margin: 0 auto;
            padding: 30px;
            background-color: #3a3a3a;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
            font-weight: bold;
            color: #dddddd;
        }

        input[type='text'],
        input[type='number'],
        input[type='file'],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #cccccc;
            border-radius: 6px;
            background-color: #ffffff;
            color: #333333;
            font-size: 14px;
        }

        textarea {
            resize: none;
            height: 100px;
        }

        img {
            display: block;
            width: 150px;
            height: auto;
            margin: 10px 0;
            border-radius: 8px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 15px;
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
            background-color: #28a745;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-align: center;
            transition: all 0.3s ease-in-out;
        }

        .btn:hover {
            background-color: #218838;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .form-section {
            margin-bottom: 20px;
        }

        .form-section-half {
            display: flex;
            justify-content: space-between;
        }

        .image-gallery {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .image-gallery img {
            width: 100px;
            height: auto;
            cursor: pointer;
        }

        .image-upload {
            margin-top: 10px;
        }

        .image-container {
            position: relative;
            display: inline-block;
        }

        .remove-image {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 5px;
            border-radius: 50%;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .form-container {
                width: 90%;
            }
        }
    </style>
  </head>
  <body>
@include('admin.header')
@include('admin.sidebar')

<div class="page-content">
    <div class="container-fluid">
        <h2>Update Product</h2>
        <div class="form-container">
            <form action="{{ url('edit_product', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-section">
                    <label>Title</label>
                    <input type="text" name="title" value="{{ $data->title }}" required>
                </div>

                <div class="form-section">
                    <label>Description</label>
                    <textarea name="description" required>{{ $data->description }}</textarea>
                </div>

                <div class="form-section">
                    <label>Price</label>
                    <input type="number" name="price" value="{{ $data->price }}" step="0.01" required>
                </div>

                <!-- Size-specific quantities -->
                <div class="form-section-half">
                    <div>
                        <label>Small Quantity</label>
                        <input type="number" name="small" value="{{ $data->small }}" min="0" required>
                    </div>
                    <div>
                        <label>Medium Quantity</label>
                        <input type="number" name="medium" value="{{ $data->medium }}" min="0" required>
                    </div>
                </div>
                <div class="form-section-half">
                    <div>
                        <label>Large Quantity</label>
                        <input type="number" name="large" value="{{ $data->large }}" min="0" required>
                    </div>
                    <div>
                        <label>Extra Small Quantity</label>
                        <input type="number" name="x_small" value="{{ $data->x_small }}" min="0" required>
                    </div>
                </div>
                <div class="form-section">
                    <label>Extra Large Quantity</label>
                    <input type="number" name="x_large" value="{{ $data->x_large }}" min="0" required>
                </div>

                <div class="form-section">
                    <label>Category</label>
                    <select name="category" required>
                        <option value="{{ $data->category }}">{{ $data->category }}</option>
                        @foreach($category as $category)
                            <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                  <!-- Current Images -->
                  <div class="form-section">
                      <label>Current Images</label>
                      @if($data->image)
                          @php
                              $images = json_decode($data->image); // Decode the JSON string to get an array of image paths
                          @endphp
                          @foreach($images as $index => $image)
                              <div class="image-container" style="margin-bottom: 10px;">
                                  <!-- Display the image using the correct asset URL -->
                                  <img src="{{ asset('images/products/' . basename($image)) }}" alt="Product Image" class="thumbnail-image"
                                      style="width: 100px; height: auto; border-radius: 8px;">
                                  <label for="delete_image_{{ $index }}">Delete this image</label>
                                  <input type="checkbox" name="delete_images[{{ $index }}]" id="delete_image_{{ $index }}" value="1">
                                  <label for="image_replace_{{ $index }}">Replace this image</label>
                                  <input type="file" name="replace_images[{{ $index }}]" id="image_replace_{{ $index }}" accept="image/*">
                              </div>
                          @endforeach
                      @else
                          <p>No images available</p>
                      @endif
                  </div>

                  <!-- New Images (Optional) -->
                  <div class="form-section">
                      <label>New Images (Optional)</label>
                      <input type="file" name="images[]" multiple class="image-upload" accept="image/*">
                  </div>

                <div class="form-section">
                    <button class="btn" type="submit">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.js')

<script>
    // Optional: JavaScript for handling image replacement (when new image is selected)
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function(event) {
            const index = event.target.id.split('_')[2];  // Get the image index
            const imgElement = document.querySelectorAll('.image-container img')[index];

            const reader = new FileReader();
            reader.onload = function(e) {
                imgElement.src = e.target.result;  // Preview the newly selected image
            };

            reader.readAsDataURL(event.target.files[0]);
        });
    });
</script>

</body>
</html>




