@extends('app')

@section('content')

<div class="card">
    <div class="card-body">
    <h4 class="font-weight-bold mb-0">Data Tamu Kunjungan</h4>
    <br>
<div class="d-flex justify-content-between align-items-center">
<div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="exportDropdownButton" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 20px;">
                    Rekap
                </button>
                <ul class="dropdown-menu" aria-labelledby="exportDropdownButton">
                    <li><a class="dropdown-item" href="{{ route('cetak-karyawan') }}" target="_blank" id="exportPdfButton"><i class="fas fa-file-pdf"></i> PDF</a></li>
                    <li><a class="dropdown-item" href="{{ route('excel-karyawan') }}" id="exportExcelButton"><i class="fas fa-file-excel"></i> Excel</a></li>
                </ul>
            </div>
    <button class="btn btn-dark" type="button" style="padding: 5px 10px; color: #fff; margin-right: 10px;" onclick="togglePopup()">
        <i class="fas fa-plus"></i> &nbsp;Tambah Karyawan
    </button>
</div>

<!-- SECTION CONTAINER TABEL -->

                        <div class="table-responsive">
                        <table class="table table-striped table-hover" id="table-list">
                                <thead>
                                    <tr>
                                    <th>No.</th>
                                    <th>NIPD</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Divisi</th>
                                    <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($karyawans as $index => $karyawan)
                                    <tr>
                                        <td>{{ ($karyawans->currentPage() - 1) * $karyawans->perPage() + $loop->index + 1 }}</td>
                                        <td>{{ $karyawan->nipd }}</td>
                                        <td>{{ $karyawan->nama }}</td>
                                        <td>{{ $karyawan->jabatan }}</td>
                                        <td>{{ $karyawan->divisi }}</td>
                                        <td class="d-flex align-items-center">
                                        <button onclick="togglePopupedit({{ $karyawan->id }})" class="btn btn-success" style="color: white; padding: 5px 10px; height: auto;"> 
                                                <i class="fas fa-edit"></i>&nbsp;Edit
                                            </button>&nbsp;
                                            <form action="{{ route('karyawan.destroy', $karyawan->id) }}" method="POST" class="delete-form">
                                            @method('delete')
                                            @csrf
                                            <button onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-danger" style="color: white; padding: 5px 10px; height: auto;">
                                                <i class="fas fa-trash-alt"></i>&nbsp;Delete
                                            </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END SECTION CONTAINER TABEL -->
  
        <!-- Pagination -->
        <br></br>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
            <li class="page-item {{ ($karyawans->onFirstPage()) ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $karyawans->previousPageUrl() }}">Previous</a>
            </li>
            @for ($i = 1; $i <= $karyawans->lastPage(); $i++)
            <li class="page-item {{ ($karyawans->currentPage() == $i) ? 'active' : '' }}">
                <a class="page-link" href="{{ $karyawans->url($i) }}">{{ $i }}</a>
            </li>
            @endfor
            <li class="page-item {{ ($karyawans->currentPage() == $karyawans->lastPage()) ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $karyawans->nextPageUrl() }}">Next</a>
            </li>
            </ul>
        </nav>
        <!-- End Pagination -->




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
@foreach($karyawans as $karyawan)
<div id="popupedit{{ $karyawan->id }}" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); max-width: 700px; z-index: 9999;">   
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
            <button type="button" class="btn btn-secondary" onclick="togglePopupedit('{{ $karyawan->id }}')">Close</button>
        </div>
    </form>
</div>
@endforeach
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
