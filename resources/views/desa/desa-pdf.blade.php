<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        .bg-title {
            background-color: #dddddd;
        }
    </style>
</head>

<body>

    <h2>DATA DESA DAERAH KLATEN UTARA</h2>

    <table>
        <tr class="bg-title">
            <th>No</th>
            <th>Desa</th>
            <th>KI Desa</th>
        </tr>
        @foreach ($desas as $index => $data)
            <tr>
                <td class="text-gray-800">{{ $loop->iteration }}</td>
                <td class="text-gray-800">{{ $data->name }}</td>
                <td class="text-gray-800">{{ $data->koordinator }}</td>
            </tr>
        @endforeach
    </table>

</body>

</html>
