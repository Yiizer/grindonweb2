<!DOCTYPE html>
<html>
<head>
    @include('admin.css')

    <style type="text/css">
        body {
            background-color: #2c2c2c; /* Dark background for contrast */
            color: #ffffff;
            font-family: 'Arial', sans-serif;
        }

        .form-container {
            width: 60%;
            margin: 50px auto;
            padding: 30px;
            background-color: #3a3a3a;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        h1 {
            text-align: center;
            color: #ffffff;
            margin-bottom: 20px;
            font-size: 28px;
            font-weight: bold;
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
        select,
        textarea,
        input[type='file'] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #cccccc;
            border-radius: 6px;
            background-color: #ffffff;
            color: #333333;
            font-size: 14px;
        }

        input[type='text']:focus,
        input[type='number']:focus,
        select:focus,
        textarea:focus,
        input[type='file']:focus {
            outline: none;
            border-color: #66afe9;
            box-shadow: 0 0 8px rgba(102, 175, 233, 0.5);
        }

        .form-row-half {
            display: flex;
            justify-content: space-between;
            gap: 40px;
        }

        .form-row-half input {
            width: 100px;
            height: 50px; /* Increased height for larger input boxes */
            font-size: 16px; /* Larger font for better visibility */
            padding: 10px;
        }

        textarea {
            resize: none;
            height: 100px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 15px;
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
            background-color: #28a745; /* Green */
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

        @media (max-width: 768px) {
            .form-container {
                width: 90%;
            }

            .form-row-half {
                flex-direction: column;
            }

            .form-row-half input {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="form-container">
            <h1>Add Product</h1>
            <form action="{{url('upload_product')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <label>Product Title</label>
                    <input type="text" name="title" required>
                </div>
                <div class="form-row">
                    <label>Description</label>
                    <textarea name="description" required></textarea>
                </div>
                <div class="form-row-half">
                    <div>
                        <label>Price</label>
                        <input type="number" name="price" step="1" min="0" max="100000" pattern="[0-9]+" required>
                    </div>
                    <div>
                        <label>Quantity</label>
                        <input type="number" name="qty" step="1" min="0" max="1000" pattern="[0-9]+" required>
                    </div>
                </div>
                <div class="form-row">
                    <label>Product Category</label>
                    <select name="category" required>
                        <option value="">Select a Category</option>
                        @foreach($category as $category)
                        <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-row">
                    <label>Product Image</label>
                    <input type="file" name="image">
                </div>
                <div class="form-row">
                    <button class="btn" type="submit">Add Product</button>
                </div>
            </form>
        </div>
    </div>

    @include('admin.js')
</body>
</html>
