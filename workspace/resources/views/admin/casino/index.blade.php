<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Casinos</title>
</head>
<body>
<p><a href="{{ route('casino.create') }}">Create Casino</a></p>
<ul>
    <li>
        Casino 1
        | <a href="{{ route('casino.show', ['id' => 1]) }}">Preview</a>
        | <a href="{{ route('casino.edit', ['id' => 1]) }}">Edit</a>
        | <form action="{{ route('casino.destroy', ['id' => 1]) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="Delete">
            </form>
    </li>
</ul>
</body>
</html>