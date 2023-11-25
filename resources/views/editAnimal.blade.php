<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Animal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            height: auto;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <form method="POST" action="{{ route('admin.updateAnimal', ['id' => $animal->id]) }}">
        @csrf
        @method('PUT')
        <h1>Edit Animal</h1>

        @foreach($fields as $field)
        <label for="{{ $field['name'] }}">{{ $field['label'] }}:</label>

        @if ($field['type'] === 'enum')
        <select name="{{ $field['name'] }}" required>
            @foreach ($field['options'] as $option)
            <option value="{{ $option }}" {{ $animal->{$field['name']} === $option ? 'selected' : '' }}>{{ $option }}</option>
            @endforeach
        </select>
        @elseif ($field['type'] === 'date')
        <input type="date" name="{{ $field['name'] }}" value="{{ $animal->{$field['name']} }}" required>
        @elseif ($field['type'] === 'tinyint')
        <input type="checkbox" name="{{ $field['name'] }}" {{ $animal->{$field['name']} == 1 ? 'checked' : '' }} value="1">
        @else
        <input type="{{ $field['type'] }}" name="{{ $field['name'] }}" value="{{ $animal->{$field['name']} }}" required>
        @endif

        <br>
        @endforeach

        <button type="submit">Save</button>
        <a href="{{ route('admin.index') }}"><button>Retour</button></a>
    </form>
</body>

</html>