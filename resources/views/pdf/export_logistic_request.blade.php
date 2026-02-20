<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #04AA6D;
            color: white;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h2>Rekomendasi Stok Tahun {{ $tahun }}</h2>

    <table id="customers">
        <tr>
            <th>No</th>
            <th>Nama Logistik</th>
            <th>Stok Saat Ini</th>
            <th>Rata-rata Penggunaan per Bulan</th>
            <th>Rekomendasi Kebutuhan Tahunan</th>
            <th>Status</th>
        </tr>

        @forelse($logisticrequests as $i => $item)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $item['nama_logistik'] }}</td>
            <td>{{ $item['stok_saat_ini'] }}</td>
            <td>{{ $item['rata_bulanan'] }}</td>
            <td>{{ $item['rekomendasi_tahunan'] }}</td>
            <td>{{ $item['status'] }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6">Tidak ada data tersedia</td>
        </tr>
        @endforelse
    </table>
</body>
</html>
