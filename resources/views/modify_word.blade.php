<!DOCTYPE html>
<html>
<head>
    <title>Modify Word Document</title>
</head>
<body>
    <h1>Modify Word Document</h1>
    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('modify.word') }}" method="POST">
        @csrf
        
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br><br>

        <label for="date">Date:</label>
        <input type="text" name="date" id="date" required><br><br>

        <label for="message">Message:</label>
        <textarea name="message" id="message" required></textarea><br><br>

        <button type="submit">Modify and Download</button>
    </form>
</body>
</html>
