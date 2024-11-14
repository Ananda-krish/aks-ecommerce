<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>User Login</title>
</head>
<body>
    <div class="col-sm-6 offset-sm-3 mt-5">
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif
            <div class="form-outline mb-4">
                <input type="email" id="email" class="form-control" name="email" required />
                <label class="form-label" for="email">Email address</label>
            </div>
            <div class="form-outline mb-4">
                <input type="password" id="password" class="form-control" name="password" required />
                <label class="form-label" for="password">Password</label>
            </div>
            <button type="submit" class="btn btn-primary btn-block mb-4">Login</button>
            <p>Not registered? <a href="{{ route('register') }}">Register</a></p>
        </form>
    </div>
</body>
</html>
