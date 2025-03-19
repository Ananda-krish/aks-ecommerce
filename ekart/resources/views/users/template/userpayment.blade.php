<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2, h3 {
            color: #343a40;
        }
        .btn-paypal {
            background-color: #0070ba;
            color: white;
        }
        .btn-paypal:hover {
            background-color: #005ea6;
        }
        .product-image {
            width: 100px;
            height: auto;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Order Summary</h2>

    <div class="row mb-4">
        <div class="col-md-6">
            <h3>User Details</h3>
            <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        </div>
        <div class="col-md-6 text-right">
            <h3>Order Status</h3>
            <p><strong>Status:</strong> Pending</p>
        </div>
    </div>

    <h3 class="text-center">Product Details</h3>
    @foreach ($cartItems as $item)
        <div class="row border-top border-bottom mb-4">
            <div class="col-md-2">
                <img src="{{ $item->product->image }}" alt="Product Image" class="product-image">
            </div>
            <div class="col-md-6">
                <h4>Product Name: {{ $item->product->name }}</h4>
                <p>Price: ${{ number_format($item->price, 2) }}</p>
                <p>Quantity: {{ $item->quantity }}</p>
            </div>
            <div class="col-md-4 text-right">
                <h4>Total: ${{ number_format($item->price * $item->quantity, 2) }}</h4>
            </div>
        </div>
    @endforeach

    <form action="{{ route('paypal') }}" method="POST" class="text-center">
        @csrf
        <input type="hidden" name="price" value="{{ $cartTotal }}">
        <input type="hidden" name="product_name" value="{{ $cartItems->first()->product->name }}">
        <input type="hidden" name="quantity" value="{{ $cartItems->sum('quantity') }}">
        <button type="submit" class="btn btn-paypal btn-lg">Pay with PayPal</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
