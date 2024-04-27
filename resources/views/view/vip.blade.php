@extends('app')

@section('content')
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="css/popup.css">
</head>

<div class="card">
    <div class="card-body">
    <h4 class="font-weight-bold mb-0">Data Tamu VIP</h4>
    <br>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="dropdown">
                <button class="btn btn-dark dropdown-toggle" type="button" id="exportDropdownButton" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 20px; color:#fff;">
                    Rekap
                </button>
                <ul class="dropdown-menu" aria-labelledby="exportDropdownButton">
                <li><a class="dropdown-item" href="{{ route('cetak-vip-form') }}" id="exportPdfButton"><i class="fas fa-file-pdf"></i> PDF</a></li>
                    <li><a class="dropdown-item" href="{{ route('excel-vip') }}" id="exportExcelButton"><i class="fas fa-file-excel"></i> Excel</a></li>
                </ul>
            </div>
            
            <button class="btn btn-success" type="button" style="padding: 5px 10px; color: #fff; margin-right: 10px;" onclick="togglePopup()">
                <i class="fas fa-plus"></i> &nbsp;Tambah Data
            </button>
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="table-list">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>KD.Undangan</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Keperluan</th>
                        <th>Asal Instansi</th>
                        <th>No HP</th>
                        <th>Rencana Tanggal Pertemuan</th>
                        <th>Status</th>
                        <th>Departemen</th>
                        <th>Seksi</th>
                        <th>Keterangan</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Looping through vips, but limited to 10 per page -->
                    @php
                    $currentPage = $vips->currentPage() ?? 1; // Get current page
                    $startNumber = ($currentPage - 1) * 10 + 1; // Calculate starting number
                    @endphp
                    <!-- Looping through vips, but limited to 10 per page -->
                    @foreach($vips as $index => $vip)
                    <tr>
                        <td>{{ ($vips->currentPage() - 1) * $vips->perPage() + $loop->index + 1 }}</td>
                        <td>{{ $vip->id }}</td>
                        <td>{{ $vip->nama }}</td>
                        <td>{{ $vip->alamat }}</td>
                        <td>{{ $vip->keperluan }}</td>
                        <td>{{ $vip->asal_instansi }}</td>
                        <td>{{ $vip->no_hp }}</td>
                        <td>{{ $vip->tanggal }}</td>
                        <td>{{ $vip->status }}</td>
                        <td>{{ $vip->departemen }}</td>
                        <td>{{ $vip->seksi }}</td>
                        <td>{{ $vip->ket }}</td>
                        
                        <td>
    <div style="display: flex; align-items: center;">
        <button onclick="togglePopupedit({{ $vip->id }})" class="btn btn-primary" style="color: white; padding: 5px 10px; height: auto;">
            <i class="fas fa-edit"></i>&nbsp;Edit
        </button>
        <form action="{{ route('vip.destroy', $vip->id) }}" method="POST" class="delete-form" style="margin-left: 5px;">
            @method('delete')
            @csrf
            <button onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-danger" style="color: white; padding: 5px 10px; height: auto;">
                <i class="fas fa-trash-alt"></i>&nbsp;Delete
            </button>
        </form>
    </div>
</td>

                    </tr>
                    @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
</div>


        <!-- Pagination -->
        <br></br>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
            <li class="page-item {{ ($vips->onFirstPage()) ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $vips->previousPageUrl() }}">Previous</a>
            </li>
            @for ($i = 1; $i <= $vips->lastPage(); $i++)
            <li class="page-item {{ ($vips->currentPage() == $i) ? 'active' : '' }}">
                <a class="page-link" href="{{ $vips->url($i) }}">{{ $i }}</a>
            </li>
            @endfor
            <li class="page-item {{ ($vips->currentPage() == $vips->lastPage()) ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $vips->nextPageUrl() }}">Next</a>
            </li>
            </ul>
        </nav>
        <!-- End Pagination -->
    


<!-- POP UP TAMBAH DATA-->
<div id="popup" style="display: none; position: fixed; top: 55%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border-radius: 10px; border: 1px solid #ccc; /* abu-abu yang lebih muda */ box-shadow: 0 0 20px rgba(0, 0, 0, 0.3); max-width: 400px; max-height: 80vh; overflow-y: auto; z-index: 9999;">
    <h4 style="margin-top: 0; margin-bottom: 20px; text-align: center;">Tambah Data Tamu VIP</h4>
    
    <form action="{{ route('vip.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama">
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat">
        </div>
        <div class="form-group">
            <label for="keperluan">Keperluan</label>
            <input type="text" class="form-control" id="keperluan" name="keperluan" placeholder="Masukkan keperluan">
        </div>
        <div class="form-group">
            <label for="asal_instansi">Asal Instansi</label>
            <input type="text" class="form-control" id="asal_instansi" name="asal_instansi" placeholder="Masukkan asal instansi">
        </div>
        <div class="form-group">
            <label for="no_hp">No HP</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan nomor HP">
        </div>
        <div class="form-group" id="departemenadd">
            <label for="departemen">Departemen</label>
            <select class="form-control" id="departemenadd" name="departemen">
                <option><-- Pilih Departemen --></option>
                <option value="keuangan">Keuangan</option>
                <option value="ketenagakerjaan">Ketenagakerjaan</option>
                <option value="paud/tk">Paud/Tk</option>
                <option value="sd">SD</option>
                <option value="smp">SMP</option>
               ]
                <!-- Tambahkan opsi lainnya sesuai dengan kebutuhan -->
            </select>
        </div>
        <div class="form-group" id="seksiadd">
            <label for="seksi">Seksi</label>
            <select class="form-control" id="seksiadd" name="seksi">
             
                <option value="kurikulum/penilaian">Kurikulum dan Penilaian</option>
                <option value="sarana/prasarana">Sarana dan Prasarana</option>
                <option value="pendidik_sd">Pendidik dan Tenaga SD</option>
                <option value="pendidik_smp">Pendidik dan Tenaga SMP</option>
              
                <!-- Editkan opsi lainnya sesuai dengan kebutuhan -->
            </select>
        </div>
        <div class="form-group" id="statusadd">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option>Proses</option>
                <option value="approved" class="approved">Approved</option>
                <option value="rejected" class="rejected">Rejected</option>
                <option value="pending" class="pending">Pending</option>
            </select>
                <!-- Editkan opsi lainnya sesuai dengan kebutuhan -->
            </select>
        </div>
        <div class="form-group">
            <label for="ket">Keterangan</label>
            <input type="text" class="form-control" id="ket" name="ket" placeholder="Masukkan Keterangan">
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Masukkan Tanggal">
        </div>
        <div style="text-align: center;">
            <button type="submit" class="btn btn-primary" style="margin-right: 10px; color:#fff;">Submit</button>
            <button type="button" class="btn btn-secondary" style="color:#fff;" onclick="togglePopup()">Close</button>
        </div>
    </form>
</div>
<!-- END POP UP TAMBAH DATA-->
@foreach($vips as $vip)
<!-- POP UP Edit DATA-->
<div id="popupedit{{ $vip->id }}" style="display: none; position: fixed; top: 55%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border-radius: 10px; border: 1px solid #ccc; /* abu-abu yang lebih muda */ box-shadow: 0 0 20px rgba(0, 0, 0, 0.3); max-width: 400px; max-height: 80vh; overflow-y: auto; z-index: 9999;">
    <!-- Konten Pop-up Edit -->
    <h4 style="margin-top: 0; margin-bottom: 20px; text-align: center;">Edit Data Tamu VIP</h4>
    
    <form action="{{ route('vip.update', $vip->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama" value="{{ $vip->nama }}">
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat" value="{{ $vip->alamat }}">
        </div>
        <div class="form-group">
            <label for="keperluan">Keperluan</label>
            <input type="text" class="form-control" id="keperluan" name="keperluan" placeholder="Masukkan keperluan" value="{{ $vip->keperluan }}">
        </div>
        <div class="form-group">
            <label for="asal_instansi">Asal Instansi</label>
            <input type="text" class="form-control" id="asal_instansi" name="asal_instansi" placeholder="Masukkan asal instansi" value="{{ $vip->asal_instansi }}">
        </div>
        <div class="form-group">
            <label for="status">No HP</label>
            <input type="text" class="form-control" id="status" name="status" placeholder="Masukkan nomor HP" value="{{ $vip->no_hp }}">
        </div>
        <div class="form-group">
            <label for="status">Tanggal</label>
            <input type="date" class="form-control" id="status" name="tanggal" placeholder="Masukkan Tanggal" value="{{ $vip->tanggal }}">
        </div>
        <div class="form-group">
            <label for="departemen">Departemen</label>
            <select class="form-control" id="departemen" name="departemen" value="{{ $vip->departemen }}">
             
                <option value="keuangan">Keuangan</option>
                <option value="ketenagakerjaan">Ketenagakerjaan</option>
                <option value="paud/tk">Paud/Tk</option>
                <option value="sd">SD</option>
                <option value="smp">SMP</option>
              
                <!-- Editkan opsi lainnya sesuai dengan kebutuhan -->
            </select>
        </div>
        <div class="form-group">
            <label for="seksi">Seksi</label>
            <select class="form-control" id="seksi" name="seksi" value="{{ $vip->seksi }}">
             
                <option value="kurikulum/penilaian">Kurikulum dan Penilaian</option>
                <option value="sarana/prasarana">Sarana dan Prasarana</option>
                <option value="pendidik_sd">Pendidik dan Tenaga SD</option>
                <option value="pendidik_smp">Pendidik dan Tenaga SMP</option>
              
                <!-- Editkan opsi lainnya sesuai dengan kebutuhan -->
            </select>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" value="{{ $vip->status }}">
                <option>Proses</option>
                <option value="approved" class="approved">Approved</option>
                <option value="rejected" class="rejected">Rejected</option>
                <option value="pending" class="pending">Pending</option>
            </select>
                <!-- Editkan opsi lainnya sesuai dengan kebutuhan -->
            </select>
        </div>
        <div class="form-group">
            <label for="ket">Keterangan</label>
            <input type="text" class="form-control" id="ket" name="ket" placeholder="Masukkan asal instansi" value="{{ $vip->ket }}">
        </div>
  
        <div style="text-align: center;">
            <button type="submit" class="btn btn-warning" style="margin-right: 10px; color:#fff;">Submit</button>
            <button type="button" class="btn btn-secondary" style="color:#fff;" onclick="togglePopupedit('{{ $vip->id }}')">Close</button>
        </div>
    </form>
</div>
@endforeach

<!-- END POP UP Edit DATA-->


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

    // Ambil elemen dropdown
var dropdown = document.getElementById("status-dropdown");

// Tambahkan event listener untuk menangani perubahan nilai dropdown
dropdown.addEventListener("change", function() {
    // Ambil nilai (value) dari opsi yang dipilih
    var selectedValue = dropdown.value;

    // Terapkan warna ke dropdown berdasarkan nilai yang dipilih
    switch (selectedValue) {
        case "pending":
            dropdown.style.backgroundColor = "yellow"; // Warna untuk pending
            break;
        case "approved":
            dropdown.style.backgroundColor = "green"; // Warna untuk approved
            break;
        case "rejected":
            dropdown.style.backgroundColor = "red"; // Warna untuk rejected
            break;
        default:
            dropdown.style.backgroundColor = ""; // Kembalikan ke warna default jika tidak ada nilai yang cocok
            break;
    }
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
    function togglePopupedit(id) {
        var popup = document.getElementById('popupedit' + id);
        if (popup.style.display === 'none') {
            popup.style.display = 'block';
        } else {
            popup.style.display = 'none';
        }
    }
</script>
@endsection