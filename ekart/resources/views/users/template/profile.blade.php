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

    <title>User Profile</title>
</head>
<body>
    <div class="super_container">
        @include('users.template.header')

        <!-- Main Content Section -->
        <div class="container profile-container mt-5 mb-5">
            <div class="d-flex justify-content-center row">
                <div class="col-md-10">
                    @if(session('success'))
                        <div class="alert alert-success" id="successMessage">{{ session('success') }}</div>
                    @endif
                    @if(session('message'))
                        <div class="alert alert-danger" id="errorMessage">{{ session('message') }}</div>
                    @endif

                    <div class="row p-3 profile-item border rounded mt-3" data-aos="fade-left" data-aos-duration="800">
                        <!-- User Profile Picture (optional) -->
                        <div class="col-md-3 text-center">
                            <img src="{{ asset('storage/images/' . Auth::user()->profile_image) }}" alt="User Profile Image" class="img-fluid rounded-circle" width="150">
                            <div class="mt-2">
                                <a href="" class="btn btn-primary btn-sm">Edit Profile</a>
                            </div>
                        </div>

                        <!-- User Details -->
                        <div class="col-md-9">
                            <h4 class="user-name">{{ Auth::user()->name }}</h4>
                            <div class="user-info">
                                <span><strong>Email:</strong> {{ Auth::user()->email }}</span><br>
                                <span><strong>Joined:</strong> {{ Auth::user()->created_at->format('d M, Y') }}</span>
                            </div>

                            <hr>

                            <!-- Profile Actions (Optional) -->
                            <div class="profile-actions">
                                <a href="" class="btn btn-warning btn-sm">Change Password</a>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline mt-2">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- User Payment Details Section -->
<div class="row mt-5">
    <div class="col-12">
        <h5>Payment History</h5>
        @if($payments->isEmpty())
            <p>No payments found.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Payment ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Payment Method</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                        <tr>
                            <td>{{ $payment->payment_id }}</td>
                            <td>{{ $payment->product_name }}</td>
                            <td>{{ $payment->quantity }}</td>
                            <td>${{ number_format($payment->amount, 2) }}</td>
                            <td>
                                @if($payment->payment_status == 'COMPLETED')
                                    <span class="badge badge-success">Completed</span>
                                @elseif($payment->payment_status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @else
                                    <span class="badge badge-danger">Failed</span>
                                @endif
                            </td>
                            <td>{{ $payment->payment_method }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

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

        // Function to hide the success or error message after 3 seconds
        setTimeout(function() {
            let successMessage = document.getElementById('successMessage');
            if (successMessage) {
                successMessage.style.display = 'none';
            }

            let errorMessage = document.getElementById('errorMessage');
            if (errorMessage) {
                errorMessage.style.display = 'none';
            }
        }, 3000); // 3000 milliseconds = 3 seconds
    </script>
</body>
</html>
