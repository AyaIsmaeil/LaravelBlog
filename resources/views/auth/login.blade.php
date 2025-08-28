<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>    
<div class="container">
    <h2 class="text-center">Login</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first('message') }}
            </div>
        @endif
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p  class="text-center">Don't have an account? <a href="{{ route('register.form') }}">Register</a></p>
    </div>
    
</body>
</html>