<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    @if (session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        
        <button type="submit">Login</button>
    </form>
</body>
</html>
