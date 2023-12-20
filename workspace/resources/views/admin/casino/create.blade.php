<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Casino</title>
</head>
<body>
    <form action="{{ route('casino.store') }}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name">
        <button type="submit">Submit</button>
    </form>
</body>
</html>
