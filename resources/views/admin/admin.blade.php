@extends('template')

@section('title', 'Page d\'administration')

@section('header')
@parent
@endsection

@section('content')
<section>
    <h1 style="text-align: center">Petshop</h1>
    <div style="display: flex; justify-content: space-between;">
        <button type="button" style="background-color: #5cb85c; border: none; margin: 5px; padding: 5px">
            <a href="{{ route('admin.addAnimal') }}" style="color: black; text-decoration: none">Ajouter un animal</a>
        </button>

        <button type="button" style="background-color: #5cb85c; border: none; margin: 5px; padding: 5px">
            <a href="{{ route('admin.addPetShop') }}" style="color: black; text-decoration: none">Ajouter un petshop</a>
        </button>
    </div>
    <div style="display: flex; gap: 20px">
        <table>
            <thead>
                <th>
                    Animals
                </th>
                <th class="w-10">
                    Editer
                </th>
                <th class="w-10">
                    Supprimer
                </th>
            </thead>
            <tbody>
                @foreach($animals as $animal)
                <tr>
                    <td>
                        {{ $animal->name }}
                    </td>
                    <td class="cursor">
                        <a href="{{ route('admin.editAnimal', ['id' => $animal->id]) }}">✏️</a>
                    </td>
                    <td class="cursor">
                        <a href="{{ route('admin.deleteAnimal', ['id' => $animal->id]) }}">🗑️</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <table>
            <thead>
                <th>
                    Animals
                </th>
                <th class="w-10">
                    Editer
                </th>
                <th class="w-10">
                    Supprimer
                </th>
            </thead>
            <tbody>
                @foreach($petshops as $petshop)
                <tr>
                    <td>
                        {{ $petshop->name }}
                    </td>
                    <td class="cursor">
                        <a href="{{ route('admin.editPetShop', ['id' => $petshop->id]) }}">✏️</a>
                    </td>
                    <td class="cursor">
                        <a href="{{ route('admin.deletePetShop', ['id' => $petshop->id]) }}">🗑️</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection

@section('footer')
@parent
<style>
    body {
        font-family: Arial, sans-serif;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }

    a {
        text-decoration: none;
    }

    .cursor {
        cursor: pointer;
    }

    .cursor:hover {
        background-color: #ddd;
    }

    .w-10 {
        width: 10%;
    }

    @media screen and (max-width: 600px) {
        table {
            border: 0;
        }

        th,
        td {
            border: 1px solid #ddd;
            display: block;
            width: 100%;
            box-sizing: border-box;
        }

        th {
            text-align: center;
        }
    }
</style>
@endsection