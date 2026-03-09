<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .table thead th {
            vertical-align: middle;
            text-align: center;
        }

        .table tbody td {
            vertical-align: middle;
            text-align: center;
        }

        .img-responsive {
            display: block;
            max-width: 100%;
            height: auto;
        }

        .table {
            width: 100%;
            page-break-inside: avoid;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #04AA6D;
            color: white;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tr:hover {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4 style="font-size: 2rem;">Detail Logistik Keluar </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4 style="color: blue;">Data Penerima</h4>
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold" for="nama_penerima">Nama Penerima:</label>
                            <p>{{ $outlogistic->nama_penerima }}</p>
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold" for="nik_kk_penerima">NIK / KK:</label>
                            <p>{{ $outlogistic->nik_kk_penerima }}</p>
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold" for="nomor_telepon">Nomor Telepon:</label>
                            <p>{{ $outlogistic->nomor_telepon }}</p>
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold" for="alamat_penerima">Alamat Penerima:</label>
                            <p>{{ $outlogistic->alamat_penerima }}</p>
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold" for="tanggal_keluar">Tanggal Kejadian:</label>
                            <p>{{ \Carbon\Carbon::parse($outlogistic->tanggal_keluar)->translatedFormat('l, d F Y') }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4 style="color: blue;">Data Logistik</h4>
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold" for="nama_logistik_keluar">Nama Logistik:</label>
                            <p>{{ $outlogistic->logistic->nama_logistik }}</p>
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold" for="kode_logistik">Kode Logistik:</label>
                            <p>{{ $outlogistic->logistic->kode_logistik }}</p>
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold" for="satuan_logistik_keluar">Satuan Logistik:</label>
                            <p>{{ $outlogistic->logistic->satuan_logistik }}</p>
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold" for="jumlah_logistik_keluar">Jumlah:</label>
                            <p>{{ $outlogistic->jumlah_logistik_keluar }}</p>
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold" for="keterangan_keluar">Jenis Bencana:</label>
                            <p>{{$outlogistic->keterangan_keluar}}</p>
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold" for="dokumentasi_keluar">Dokumentasi Keluar:</label>
                            @if($outlogistic->dokumentasi_keluar)
                                <img src="{{ public_path('uploads/outlogistic/' . basename($outlogistic->dokumentasi_keluar)) }}"
                                    width="90" height="90">
                            @else
                                <p>Tidak ada gambar</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label style="font-weight: bold;">Ditambahkan Pada:</label>
                        <p>{{ \Carbon\Carbon::parse($outlogistic->created_at)->translatedFormat('l, d F Y') }}</p>
                    </div>
                    <div class="col mb-3">
                        <label style="font-weight: bold;">Diperbarui Pada:</label>
                        <p>{{ \Carbon\Carbon::parse($outlogistic->updated_at)->translatedFormat('l, d F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">Kode Logistik</th>
                            <th class="text-center">Nama Logistik</th>
                            <th class="text-center">Satuan</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Tanggal Kejadian</th>
                            <th class="text-center">Jenis Bencana</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">{{ $outlogistic->logistic->kode_logistik }}</td>
                            <td class="text-center">{{ $outlogistic->logistic->nama_logistik }}</td>
                            <td class="text-center">{{ $outlogistic->logistic->satuan_logistik }}</td>
                            <td class="text-center">{{ $outlogistic->jumlah_logistik_keluar}}</td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($outlogistic->tanggal_keluar)->translatedFormat('l, d F Y') }}
                            </td>
                            <td class="text-center">{{ $outlogistic->keterangan_keluar }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>