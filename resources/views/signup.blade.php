<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
</head>
<body>
    <h1>Sign Up</h1>
    <form action="{{ route('signup.submit') }}" method="POST">
        @csrf
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" required><br><br>
        
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        
        <button type="submit">Sign Up</button>
    </form>
    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

</body>
</html>
