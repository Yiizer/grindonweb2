<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')

    <style type="text/css">
        .div_deg {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 60px;
        }

        .table_deg {
            border: 2px solid white;
        }

        th {
            background-color: black;
            color: white;
            font-size: 19px;
            font-weight: bold;
            padding: 15px;
        }

        td {
            border: 1px solid white;
            text-align: center;
            color: white;
        }

        input[type='search'] {
            width: 500px;
            height: 60px;
            margin-left: 50px;
        }

        /* Standardized Button Styling */
        .btn {
            display: inline-block;
            padding: 12px 25px;
            font-size: 14px;
            text-transform: uppercase;
            border-radius: 4px;
            text-decoration: none;
            color: #ffffff;
            border: 2px solid transparent;
            box-sizing: border-box;
            text-align: center;
            margin-right: 10px;
        }

        /* Edit Button */
        .btn-edit {
            background-color: black;
            border-color: white;
        }

        .btn-edit:hover {
            background-color: #555555;
        }

        /* Delete Button */
        .btn-delete {
            background-color: black;
            border-color: white;
        }

        .btn-delete:hover {
            background-color: #555555;
        }

        /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        justify-content: center;
        align-items: center;
        background-color: rgba(0, 0, 0, 0); /* Transparent background */
    }

    .modal-content {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0; /* Remove padding for no background effect */
        background: none !important; /* Ensure there's absolutely no background */
        box-shadow: none !important; /* Remove any shadows */
        border: none; /* Remove borders */
    }

    .modal-content img {
        width: 80%; /* Resize image to 80% of the screen width */
        max-width: 800px; /* Ensure the image doesn’t exceed 800px in width */
        height: auto;
        border-radius: 8px; /* Optional: adds slight roundness to the image edges */
    }

    .modal-content .modal-buttons {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: flex;
        justify-content: space-between;
        width: 100%;
        max-width: 800px; /* Matches image size for consistency */
    }

    .modal-content .modal-buttons button {
        background-color: transparent;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 30px;
        padding: 10px 20px;
        transition: color 0.3s ease;
    }

    .modal-content .modal-buttons button:hover {
        color: #ddd;
    }

    /* Navigation Arrows */
    .arrow-left, .arrow-right {
        position: absolute;
        top: 50%;
        font-size: 40px;
        color: white;
        background: transparent;
        border: none;
        cursor: pointer;
        z-index: 1;
        padding: 10px;
    }

    .arrow-left {
        left: -50px;
    }

    .arrow-right {
        right: -50px;
    }

    .arrow-left:hover, .arrow-right:hover {
        color: #ddd;
    }
       /* Close Button */
       .close-button {
        position: absolute;
        top: -10px; /* Proximity to the image from the top */
        right: 600px; /* Move it slightly left from the right edge */
        font-size: 30px;
        color: white;
        background-color: transparent;
        border: none;
        cursor: pointer;
        z-index: 2; /* Ensure it appears on top of other elements */
    }
    .close-button:hover {
        color: #ddd; /* Slightly dim the color on hover */
    }

    </style>
 <head>
    @include('admin.css')

    <style type="text/css">
        /* Insert the CSS from above here */
    </style>
   <head>
    @include('admin.css')

    <style type="text/css">
        /* Insert the updated CSS here */
    </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="container-fluid">
            <form action="{{ url('product_search') }}" method="get">
                @csrf
                <input type="search" name="search" placeholder="Search products...">
                <input type="submit" class="btn btn-secondary" value="Search">
            </form>

            <div class="div_deg">
                <table class="table_deg">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Small</th>
                            <th>Medium</th>
                            <th>Large</th>
                            <th>X Small</th>
                            <th>X Large</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->description }}</td>
                            <td>PHP {{ number_format($item->price, 2) }}</td>
                            <td>{{ $item->category }}</td>
                            <td>{{ $item->small }}</td>
                            <td>{{ $item->medium }}</td>
                            <td>{{ $item->large }}</td>
                            <td>{{ $item->x_small }}</td>
                            <td>{{ $item->x_large }}</td>
                            <td>
                                @if($item->image)
                                    @php
                                        $images = json_decode($item->image); // Decode the JSON string to get an array of image paths
                                    @endphp
                                    @if(is_array($images) && count($images) > 0)
                                        <!-- Only show the first image in the table -->
                                        <img src="{{ asset($images[0]) }}" alt="Product Image" 
                                            class="thumbnail-image" 
                                            data-images="{{ json_encode($images) }}" 
                                            style="width: 100px; height: auto; cursor: pointer;">
                                    @else
                                        No Image
                                    @endif
                                @else
                                    No Image
                                @endif
                            </td>





                            <td class="actions">
                                <a href="{{ url('edit_product', $item->id) }}" class="btn btn-edit">Edit</a>
                                <form action="{{ url('delete_product', $item->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination-links">
                    {{ $product->links() }}
                </div>

            </div>  
        </div>
    </div>

    <!-- Modal for Image Preview -->
    <div class="modal" id="imageModal">
        <div class="modal-content">
            <img id="modalImage" src="" alt="Product Image">
            <div class="modal-buttons">
                <button id="prevButton" onclick="changeImage('prev')">&#8592;</button>
                <button id="nextButton" onclick="changeImage('next')">&#8594;</button>
            </div>
            <!-- Close Button in Modal -->
            <button id="closeModal" class="close-button" onclick="closeModal()">&times;</button>

        </div>
    </div>

    @include('admin.js')

   <script type="text/javascript">
    document.querySelectorAll('.thumbnail-image').forEach(image => {
        image.addEventListener('click', function() {
            const images = JSON.parse(this.getAttribute('data-images')); // Get all images for this product
            const currentIndex = 0; // Start from the first image

            let modalImage = document.getElementById('modalImage');
            
            // Normalize the image path to use forward slashes (if necessary)
            let imagePath = images[currentIndex].replace(/\\/g, '/'); // Replace backslashes with forward slashes
            
            // Set the image src to the first image in the array
            modalImage.src = "{{ asset('') }}" + imagePath; // Corrected to asset helper without 'storage'

            modalImage.setAttribute('data-index', currentIndex); // Set the current index in the modal image
            modalImage.setAttribute('data-images', JSON.stringify(images)); // Set the images array in the modal image

            document.getElementById('imageModal').style.display = 'flex'; // Show the modal
        });
    });

      // Close modal when clicking outside the image
      document.getElementById('imageModal').addEventListener('click', function (event) {
        if (event.target === this) {
            closeModal();
        }
    });

    function closeModal() {
        document.getElementById('imageModal').style.display = 'none'; // Hide the modal
    }

    function changeImage(direction) {
        const modalImage = document.getElementById('modalImage');
        const images = JSON.parse(modalImage.getAttribute('data-images')); // Get the array of images
        let currentIndex = parseInt(modalImage.getAttribute('data-index')); // Get the current image index

        if (direction === 'next') {
            currentIndex = (currentIndex + 1) % images.length; // Move to next image
        } else if (direction === 'prev') {
            currentIndex = (currentIndex - 1 + images.length) % images.length; // Move to previous image
        }

        let imagePath = images[currentIndex].replace(/\\/g, '/'); // Replace backslashes with forward slashes
        modalImage.src = "{{ asset('') }}" + imagePath; // Set the new image source
        modalImage.setAttribute('data-index', currentIndex); // Update the current index
    }
</script>

</body>
</html>
