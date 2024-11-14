<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <title>Shopping Cart</title>
    <script>
        function validateAddressForm() {
            const fields = ['flat_no', 'area', 'location', 'city', 'district', 'pincode', 'state'];
            let isValid = true;

            fields.forEach(field => {
                const input = document.getElementById(field);
                if (!input.value) {
                    isValid = false;
                    input.classList.add('error');
                } else {
                    input.classList.remove('error');
                }
            });

            if (!isValid) {
                alert("Please fill in all address fields before proceeding to checkout.");
            }

            return isValid;
        }
    </script>
    <style>
        .error {
            border: 1px solid red;
        }
    </style>
</head>
<body>
    <div class="super_container">
        @include('users.template.header')

        <div class="card">
            <div class="row">
                <div class="col-md-8 cart">
                    <div class="title">
                        <div class="row">
                            <div class="col"><h4><b>Shopping Cart</b></h4></div>
                            <div class="col align-self-center text-right text-muted">{{ count($cartItems) }} items</div>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @foreach ($cartItems as $item)
                        <div class="row border-top border-bottom">
                            <div class="row main align-items-center">
                                <div class="col-2">
                                    <img class="img-fluid" src="{{ $item->product->image }}">
                                </div>
                                <div class="col">
                                    <div class="row text-muted">{{ $item->product->name }}</div>
                                    <div class="row">Quantity: {{ $item->quantity }}</div>
                                </div>
                                <div class="col">&euro; {{ number_format($item->price * $item->quantity, 2) }}
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="back-to-shop"><a href="{{ route('userproduct') }}">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
                </div>

                <div class="col-md-4 summary">
                    <div><h5><b>Summary</b></h5></div>
                    <hr>
                    <div class="row">
                        <div class="col" style="padding-left:0;">ITEMS {{ count($cartItems) }}</div>
                        <div class="col text-right">
                            &euro; {{ number_format($cartTotal, 2) }}
                        </div>
                    </div>
                    <form id="address-form" action="{{ route('checkout') }}" method="POST" onsubmit="return validateAddressForm()">
                        @csrf
                        <h5>Shipping Address</h5>
                        <div class="form-group">
                            <label for="flat_no">Flat No:</label>
                            <input type="text" id="flat_no" name="flat_no" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="area">Area:</label>
                            <input type="text" id="area" name="area" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="location">Location:</label>
                            <input type="text" id="location" name="location" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="city">City:</label>
                            <input type="text" id="city" name="city" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="district">District:</label>
                            <input type="text" id="district" name="district" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="pincode">Pincode:</label>
                            <input type="text" id="pincode" name="pincode" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="state">State:</label>
                            <input type="text" id="state" name="state" class="form-control" required>
                        </div>

                        <p>SHIPPING</p>
                        <select name="shipping" class="form-control">
                            <option value="5.00">Standard Delivery - &euro;5.00</option>
                        </select>
                        <p>GIVE CODE</p>
                        <input id="code" name="discount_code" placeholder="Enter your code" class="form-control">

                        <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                            <div class="col">TOTAL PRICE</div>
                            <div class="col text-right">&euro; {{ number_format($cartTotal + 5.00, 2) }}</div>
                        </div>
                        <button class="btn btn-primary" type="submit">CHECKOUT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
