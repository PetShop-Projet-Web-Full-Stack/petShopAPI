<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Petshop</title>

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
            text-align: left;
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
</head>

<body>
    <h1 style="text-align: center">Petshop</h1>
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
</body>

</html>