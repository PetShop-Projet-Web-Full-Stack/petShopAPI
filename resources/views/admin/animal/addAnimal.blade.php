@extends('template')

@section('title', 'Ajouter un animal')

@section('header')
@parent
@stop

@section('content')
<section>
    <form method="POST" action="{{ route('admin.createAnimal')}}">
        @csrf
        @method('PUT')
        <h1>Add Animal</h1>
        <div class="d-flex col gap-3 justify-content-center flex-wrap">
            <div class='col-5'>
                <label for="race">Race:</label>
                <select name="race">
                    @foreach ($races as $race)
                    <option value="{{ $race->id }}">{{ $race->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class='col-5'>
                <label for="petshop">Animalerie:</label>
                <select name="petshop">
                    @foreach ($petShops as $petshop)
                    <option value="{{ $petshop->id }}">{{ $petshop->name }}</option>
                    @endforeach
                </select>
            </div>
            @foreach($fields as $field)
            <div class="col-5">
                @if ($field['type'] === 'enum')
                <label for="{{ $field['name'] }}">{{ $field['label'] }}:</label>
                <select name="{{ $field['name'] }}" required>
                    @foreach ($field['options'] as $option)
                    <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
                @elseif ($field['type'] === 'date')
                <label for="{{ $field['name'] }}">{{ $field['label'] }}:</label>
                <input type="date" name="{{ $field['name'] }}" required>
                @elseif ($field['type'] === 'tinyint')
                <div class="form-check">
                    <input type="checkbox" name="{{ $field['name'] }}" class="form-check-input" value="1">
                    <label for="{{ $field['name'] }}" class="form-label">
                        {{ $field['label'] }}
                    </label>
                </div>
                @else
                <label for="{{ $field['name'] }}">{{ $field['label'] }}:</label>
                <input type="{{ $field['type'] }}" name="{{ $field['name'] }}" required>
                @endif
            </div>
            @endforeach

        </div>
        <button type="submit">Add</button>
        <a href="{{ route('admin.index') }}">
            <button type="button">Retour</button>
        </a>
    </form>
</section>
@endsection

@section('footer')
@parent
<style>
    section {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 56px 0 0 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 40vw;
        height: auto;
        margin: 3rem;
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
@stop