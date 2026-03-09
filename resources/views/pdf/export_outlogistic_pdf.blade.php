<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
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
    </style>
</head>
<body>
    <h1>Data Logistik Keluar</h1>
    <table id="customers">
        <tr>
            <th>No</th>
            <th>Nama Logistik</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Penerima</th>
            <th>Alamat</th>
            <th>Jenis Bencana</th>
            <th>Dokumentasi</th>
        </tr>
        @if($outlogistics->count() > 0)
            @foreach($outlogistics as $outlogistic)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ optional($outlogistic->logistic)->nama_logistik }}</td>
                    <td>{{ $outlogistic->jumlah_logistik_keluar }}</td>
                    <td>{{ optional($outlogistic->logistic)->satuan_logistik }}</td>
                    <td>{{ $outlogistic->nama_penerima }}</td>
                    <td>{{ $outlogistic->alamat_penerima }}</td>
                    <td>{{ $outlogistic->keterangan_keluar }}</td>
                    <td>
                        @if($outlogistic->dokumentasi_keluar)
                            <img src="{{ public_path('uploads/outlogistic/' . basename($outlogistic->dokumentasi_keluar)) }}"
                                width="90" height="90">
                        @else
                            Tidak ada gambar
                        @endif
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8" style="text-align: center;">Tidak ada data logistik keluar!</td>
            </tr>
        @endif
    </table>

</body>

</html>