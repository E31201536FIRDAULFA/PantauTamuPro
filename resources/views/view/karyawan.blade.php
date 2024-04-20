@extends('app')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <div>
        <h4 class="font-weight-bold mb-0">Manajemen Data Karyawan</h4>
    </div>
    <div>
        <p id="reportButton"></p>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mt-3 mb-3">
    <div class="dropdown" style="margin-left: 10px;">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="exportDropdownButton" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 20px;">
            Rekap
        </button>
        <ul class="dropdown-menu" aria-labelledby="exportDropdownButton">
            <li><a class="dropdown-item" href="{{ route('cetak-karyawan') }}" target="_blank" id="exportPdfButton"><i class="fas fa-file-pdf"></i> PDF</a></li>
            <li><a class="dropdown-item" href="{{ route('excel-karyawan') }}" id="exportExcelButton"><i class="fas fa-file-excel"></i> Excel</a></li>
        </ul>
    </div>
    <ul>
    <button class="btn btn-dark" type="button" style="padding: 5px 10px; color: #fff; margin-right: 10px;" onclick="togglePopup()">
        <i class="fas fa-plus"></i> &nbsp;Tambah Karyawan
    </button>
</ul>
</div>

<!-- SECTION CONTAINER TABEL -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-striped table-hover" id="table-list">
                                <thead>
                                    <th>No.</th>
                                    <th>NIPD</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Divisi</th>
                                    <th>Option</th>
                                </thead>
                                <tbody>
                                    @foreach($karyawan as $index => $karyawan)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $karyawan->nipd }}</td>
                                        <td>{{ $karyawan->nama }}</td>
                                        <td>{{ $karyawan->jabatan }}</td>
                                        <td>{{ $karyawan->divisi }}</td>
                                        <td>
                                        <button onclick="togglePopupedit({{ $karyawan->id }})" class="btn btn-success" style="color: white; padding: 5px 10px; height: auto;">
                                            <i class="fas fa-edit"></i>&nbsp;Edit
                                        </button><br><br>
                                        <button onclick="konfirmasiHapus()" class="btn btn-danger" style="color: white; padding: 5px 10px; height: auto;">
                                            <i class="fas fa-trash-alt"></i>&nbsp;Delete
                                        </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION CONTAINER TABEL -->


<!-- POP UP TAMBAH KARYAWAN -->
<div id="popup" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); max-width: 400px;">
    <h4 style="margin-top: 0; margin-bottom: 20px; text-align: center;">Tambah Data Karyawan</h4>
    
    <form action="{{ route('karyawan.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="nipd">Nipd</label>
            <input type="text" class="form-control" id="nipd" name="nipd" placeholder="Masukkan nipd">
        </div>
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama">
        </div>
        <div class="form-group">
            <label for="jabatan">Jabatan</label>
            <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Masukkan jabatan">
        </div>
        <div class="form-group">
            <label for="divisi">Divisi</label>
            <input type="text" class="form-control" id="divisi" name="divisi" placeholder="Masukkan asal divisi">
        </div>
        
        <div style="text-align: center;">
            <button type="submit" class="btn btn-primary" style="margin-right: 10px;">Submit</button>
            <button type="button" class="btn btn-secondary" onclick="togglePopup()">Close</button>
        </div>
    </form>
</div>
<!-- END POP UP TAMBAH KARYAWAN -->

<!-- POP UP EDIT KARYAWAN -->
<div id="popupedit" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); max-width: 400px;">
    <h4 style="margin-top: 0; margin-bottom: 20px; text-align: center;">Edit Data Karyawan</h4>
    
    <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nipd">Nipd</label>
            <input type="text" class="form-control" id="nipd" name="nipd" value="{{ $karyawan->nipd }}">
        </div>
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $karyawan->nama }}">
        </div>
        <div class="form-group">
            <label for="jabatan">Jabatan</label>
            <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $karyawan->jabatan }}">
        </div>
        <div class="form-group">
            <label for="divisi">Divisi</label>
            <input type="text" class="form-control" id="divisi" name="divisi" value="{{ $karyawan->divisi }}">
        </div>
        
        <div style="text-align: center;">
            <button type="submit" class="btn btn-primary" style="margin-right: 10px;">Submit</button>
            <button type="button" class="btn btn-secondary" onclick="togglePopupedit()">Close</button>
        </div>
    </form>
</div>
<!-- END POP UP EDIT KARYAWAN -->

<script>
    // Mendapatkan tombol "Report"
    var reportButton = document.getElementById('reportButton');

    // Mendapatkan tanggal hari ini
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
    var yyyy = today.getFullYear();

    today = mm + '/' + dd + '/' + yyyy;

    // Mengganti teks tombol dengan tanggal hari ini
    reportButton.innerHTML = today;

    // Export to PDF
    document.getElementById('exportPdfButton').addEventListener('click', function() {
        // Your logic for exporting to PDF goes here
        console.log('Export to PDF clicked');
    });

    // Export to Excel
    document.getElementById('exportExcelButton').addEventListener('click', function() {
        // Your logic for exporting to Excel goes here
        console.log('Export to Excel clicked');
    });

    // Function to toggle popup
    function togglePopup() {
        var popup = document.getElementById('popup');
        if (popup.style.display === 'none') {
            popup.style.display = 'block';
        } else {
            popup.style.display = 'none';
        }
    }

    // Function to toggle popup edit
    function togglePopupedit() {
        var popup = document.getElementById('popupedit');
        if (popup.style.display === 'none') {
            popup.style.display = 'block';
        } else {
            popup.style.display = 'none';
        }
    }

    function konfirmasiHapus() {
            // Menampilkan jendela konfirmasi dengan pesan khusus
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                // Jika pengguna mengklik "OK", lakukan penghapusan
                hapusData();
            } else {
                // Jika pengguna mengklik "Batal", tidak lakukan apa-apa
                return;
            }
        }

        function hapusData() {
            // Di sini Anda akan menempatkan kode untuk menghapus data
            alert("Data berhasil dihapus!"); // Contoh pesan konfirmasi
        }
</script>
@endsection
