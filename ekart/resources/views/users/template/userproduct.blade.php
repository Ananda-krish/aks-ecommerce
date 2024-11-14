<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <!-- Add AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <title>ekart</title>
</head>
<body>
    <div class="super_container">
        @include('users.template.header')

        <!-- Main Content Section -->
        <div class="container product-container mt-5 mb-5">
            <div class="d-flex justify-content-center row">
                <div class="col-md-10">
                    @if(session('success'))
                        <div class="alert alert-success" id="successMessage">{{ session('success') }}</div>
                    @endif
                    @if(session('message'))
                        <div class="alert alert-danger" id="errorMessage">{{ session('message') }}</div>
                    @endif

                    @forelse ($products as $index => $product)
                        <div class="row p-3 product-item border rounded mt-3 {{ $index % 2 == 0 ? 'bg-light-blue' : 'bg-light-green' }}"
                             data-aos="fade-left" data-aos-delay="{{ $index * 100 }}" data-aos-duration="800">
                            <div class="col-md-3">
                                <img class="img-fluid rounded product-image" src="{{ asset('storage/images/'.$product->image) }}" alt="{{ $product->name }}">
                            </div>
                            <div class="col-md-6">
                                <h5 class="product-name">{{ $product->name }}</h5>
                                <div class="product-info">
                                    <span class="badge badge-primary">{{ $product->category->name }}</span>
                                    <span>Status: <strong class="text-success">{{ $product->status_text }}</strong></span>
                                    <span>❤️ Fav: <strong>{{ $product->is_favourate_text }}</strong></span>
                                </div>
                                <p class="product-description">{{ $product->description ?: 'Product description not available.' }}</p>
                            </div>
                            <div class="col-md-3 d-flex flex-column align-items-end">
                                <h4 class="price text-primary">${{ number_format($product->price, 2) }}</h4>
                                @if($product->original_price > $product->price)
                                    <span class="text-muted strike-text">${{ number_format($product->original_price, 2) }}</span>
                                @endif
                                <span class="text-success">Free shipping</span>
                                <form action="{{ route('cart.add') }}" method="POST" class="mt-2">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="d-flex">
                                        <input type="number" name="quantity" min="1" value="1" class="form-control mr-2" style="width: 60px;">
                                        <button type="submit" class="btn btn-dark btn-sm">Add to Cart</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">No products found for your search.</p>
                    @endforelse

                    <div class="mt-3">{{ $products->links() }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add the footer here if needed -->

    <!-- Add AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script>
        // Initialize AOS
        AOS.init();

        // Function to hide the success or error message after 2 seconds
        setTimeout(function() {
            let successMessage = document.getElementById('successMessage');
            if (successMessage) {
                successMessage.style.display = 'none';
            }

            let errorMessage = document.getElementById('errorMessage');
            if (errorMessage) {
                errorMessage.style.display = 'none';
            }
        }, 2000); // 2000 milliseconds = 2 seconds
    </script>
</body>
</html>
