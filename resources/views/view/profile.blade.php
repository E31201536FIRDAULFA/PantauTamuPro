@extends('app')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <div>
        <h4 class="font-weight-bold mb-0">Manajemen Data Akun User</h4>
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
            <li><a class="dropdown-item" href="{{ route('cetak-profile') }}" target="_blank" id="exportPdfButton"><i class="fas fa-file-pdf"></i> PDF</a></li>
            <li><a class="dropdown-item" href="{{ route('excel-profile') }}" id="exportExcelButton"><i class="fas fa-file-excel"></i> Excel</a></li>
        </ul>
    </div>
    <ul>
        <button class="btn btn-dark" type="button" style="padding: 5px 10px; color: #fff; margin-right: 10px;" onclick="togglePopup()">
            <i class="fas fa-plus"></i> &nbsp;Tambah Akun
        </button>
    </ul>
</div>


<!-- SECTION CONTAINER TABEL-->
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
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>No HP</th>
                                    <th>TTL</th>
                                    <th>Option</th>
                                </thead>
                                <tbody>
                                   <!-- Looping through vips, but limited to 10 per page -->
                                   @php
                                    $currentPage = $profiles->currentPage() ?? 1; // Get current page
                                    $startNumber = ($currentPage - 1) * 10 + 1; // Calculate starting number
                                    @endphp
                                    <!-- Looping through profiles, but limited to 10 per page -->
                                    @foreach($profiles as $index => $profile)
                                    <tr>
                                        <td>{{ ($profiles->currentPage() - 1) * $profiles->perPage() + $loop->index + 1 }}</td>
                                        <td>{{ $profile->nama }}</td>
                                        <td>{{ $profile->username }}</td>
                                        <td>{{ $profile->email }}</td>
                                        <td>{{ $profile->alamat }}</td>
                                        <td>{{ $profile->no_hp }}</td>
                                        <td>{{ $profile->tanggal_lahir }}</td>
                                        <td>
                                            <button onclick="togglePopupedit({{ $profile->id }})" class="btn btn-success" style="color: white; padding: 5px 10px; height: auto;"> 
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
         <!-- Pagination -->
         <br></br>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
            <li class="page-item {{ ($profiles->onFirstPage()) ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $profiles->previousPageUrl() }}">Previous</a>
            </li>
            @for ($i = 1; $i <= $profiles->lastPage(); $i++)
            <li class="page-item {{ ($profiles->currentPage() == $i) ? 'active' : '' }}">
                <a class="page-link" href="{{ $profiles->url($i) }}">{{ $i }}</a>
            </li>
            @endfor
            <li class="page-item {{ ($profiles->currentPage() == $profiles->lastPage()) ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $profiles->nextPageUrl() }}">Next</a>
            </li>
            </ul>
        </nav>
        <!-- End Pagination -->
    </div>
</section>
<!-- END SECTION CONTAINER TABEL -->



<!-- POP UP TAMBAH DATA -->
<div id="popup" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); max-width: 700px; ">
    <h4 style="margin-top: 0; margin-bottom: 20px; text-align: center;">Tambah Data Tamu Kunjungan</h4>
    
    <form action="{{ route('profile.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan asal email">
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan asal alamat">
        </div>
        <div class="form-group">
            <label for="no_hp">No.Hp</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan asal nohp">
        </div>
        <div class="form-group">
            <label for="tanggal_lahir">TTL</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Masukkan asal ttl">
        </div>
        
        <div style="text-align: center;">
            <button type="submit" class="btn btn-primary" style="margin-right: 10px;">Submit</button>
            <button type="button" class="btn btn-secondary" onclick="togglePopup()">Close</button>
        </div>
    </form>
</div>
<!-- END POP UP TAMBAH DATA -->

<!-- POP UP EDIT DATA -->
<div id="popupedit" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); max-width: 700px; ">
    <h4 style="margin-top: 0; margin-bottom: 20px; text-align: center;">Edit Data Tamu Kunjungan</h4>

    <form action="{{ route('profile.update', $profile->id) }}" method="POST">
    @csrf
    @method('PUT')
        <div class="form-group">
            <label for="nipd">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $profile->nama }}">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ $profile->username }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ $profile->email }}">
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $profile->alamat }}">
        </div>
        <div class="form-group">
            <label for="no_hp">No.Hp</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $profile->no_hp }}">
        </div>
        <div class="form-group">
            <label for="tanggal_lahir">TTL</label>
            <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $profile->tanggal_lahir }}">
        </div>
        
        <div style="text-align: center;">
            <button type="submit" class="btn btn-primary" style="margin-right: 10px;">Update</button>
            <button type="button" class="btn btn-secondary" onclick="togglePopupedit()">Close</button>
        </div>
    </form>
</div>
<!-- END POP UP EDIT DATA -->


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

    function konfirmasiHapus(id) {
        // Menampilkan jendela konfirmasi dengan pesan khusus
        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            // Jika pengguna mengklik "OK", lakukan penghapusan
            hapusData(id);
        } else {
            // Jika pengguna mengklik "Batal", tidak lakukan apa-apa
            return;
        }
    }

    function hapusData(id) {
        // Di sini Anda akan menempatkan kode untuk menghapus data
        alert("Data berhasil dihapus dengan ID: " + id); // Contoh pesan konfirmasi
    }
</script>
@endsection
