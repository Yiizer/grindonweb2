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
        }

        .modal-content {
            position: relative; /* Ensure positioning of arrows outside the image */
            display: flex;
            justify-content: center;
            align-items: center;
            background: none; /* No background */
            padding: 20px;
        }

        .modal-content img {
            width: 50%; /* Resize image to 50% of the screen width */
            max-width: 600px; /* Ensure image doesn’t exceed 600px in width */
            height: auto;
            border-radius: 8px;
        }

        .modal-content .modal-buttons {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 600px; /* Same as max-width of the image */
        }

        .modal-content .modal-buttons button {
            background-color: transparent;
            color: gray;
            border: none;
            cursor: pointer;
            font-size: 30px;
            padding: 10px 20px;
            transition: color 0.3s ease;
        }

        .modal-content .modal-buttons button:hover {
            color: white;
        }

        .back-button {
            position: absolute;
            bottom: 20px;
            left: 20px;
            font-size: 30px;
            color: gray;
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        .back-button:hover {
            color: white;
        }

        /* Make sure arrows are outside the image */
        .arrow-left, .arrow-right {
            position: absolute;
            top: 50%;
            font-size: 40px;
            color: gray;
            background: transparent;
            border: none;
            cursor: pointer;
            z-index: 1; /* Ensure arrows are in front of the image */
            padding: 10px;
        }

        .arrow-left {
            left: -50px; /* Position to the left of the image */
        }

        .arrow-right {
            right: -50px; /* Position to the right of the image */
        }

        .arrow-left:hover, .arrow-right:hover {
            color: white;
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
            <button id="closeModal" class="back-button" onclick="closeModal()">&#8592;</button>
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
