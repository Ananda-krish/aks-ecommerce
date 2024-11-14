<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>User Registration</title>
</head>
<body>
    <div class="col-sm-6 offset-sm-3 mt-5">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            @if (session()->has('message'))
                <p class="alert alert-success">{{ session('message') }}</p>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Name input -->
            <div class="form-outline mb-4">
                <input type="text" id="name" class="form-control" name="name" required />
                <label class="form-label" for="name">Name</label>
            </div>

            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="email" id="email" class="form-control" name="email" required />
                <label class="form-label" for="email">Email address</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="password" id="password" class="form-control" name="password" required />
                <label class="form-label" for="password">Password</label>
            </div>

            <!-- Password confirmation -->
            <div class="form-outline mb-4">
                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required />
                <label class="form-label" for="password_confirmation">Confirm Password</label>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Register</button>
            <p>Already registered? <a href="{{ route('login') }}">Login</a></p>
        </form>
    </div>
</body>
</html>
