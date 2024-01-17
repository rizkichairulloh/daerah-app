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
            <th>Nama</th>
            <th>Desa</th>
            <th>Kelompok</th>
            <th>Dapukan</th>
        </tr>
        @foreach ($daerahs as $index => $data)
            <tr>
                <td class="text-gray-800">{{ $loop->iteration }}</td>
                <td class="text-gray-800">{{ $data->name }}</td>
                <td class="text-gray-800">{{ $data->desa->name }}</td>
                <td class="text-gray-800">{{ $data->kelompok->name }}</td>
                <td class="text-gray-800">{{ $data->dapukan }}</td>
            </tr>
        @endforeach
    </table>

</body>

</html>
