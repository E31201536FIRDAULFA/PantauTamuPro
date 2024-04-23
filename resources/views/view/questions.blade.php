@extends('app')

@section('content')
<div class="card">
    <div class="card-body">
    <h4 class="font-weight-bold mb-0">Data Survey Kepuasan Pengguna</h4>
    <br>
<div class="d-flex justify-content-between align-items-center mt-3 mb-3">

 <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="exportDropdownButton" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 20px;">
            Rekap
        </button>
        <ul class="dropdown-menu" aria-labelledby="exportDropdownButton">
            <li><a class="dropdown-item" href="{{ route('cetak-questions') }}" target="_blank" id="exportPdfButton"><i class="fas fa-file-pdf"></i> PDF</a></li>
            <li><a class="dropdown-item" href="{{ route('excel-questions') }}" id="exportExcelButton"><i class="fas fa-file-excel"></i> Excel</a></li>
        </ul>
    </div>
    <button class="btn btn-dark" type="button" style="padding: 5px 10px; color: #fff; margin-right: 10px;" onclick="togglePopup()">
        <i class="fas fa-plus"></i> &nbsp;Tambah Pertanyaan
    </button>
</div>

<!-- SECTION CONTAINER TABEL -->

                        <div class="table-responsive">
                        <table class="table table-striped table-hover" id="table-list">
                                <thead>
                                    <tr>
                                    <th>No.</th>
                                    <th>Pertanyaan</th>
                                    <th>Baik</th>
                                    <th>Sangat Baik</th>
                                    <th>Buruk</th>
                                    <th>Sangat Buruk</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($surveys as $index => $survey)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $survey->question }}</td>
                                        <td>{{ $survey->baik }}</td>
                                        <td>{{ $survey->sangat_baik }}</td>
                                        <td>{{ $survey->buruk }}</td>
                                        <td>{{ $survey->sangat_buruk }}</td>
                                        <td class="d-flex align-items-center">
                                        <button onclick="togglePopupedit({{ $survey->id }})" class="btn btn-success" style="color: white; padding: 5px 10px; height: auto;">
                                            <i class="fas fa-edit"></i>&nbsp;Edit
                                        </button> &nbsp;
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
<!-- END SECTION CONTAINER TABEL -->

<!-- Pagination -->
<br></br>
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item {{ ($surveys->onFirstPage()) ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $surveys->previousPageUrl() }}">Previous</a>
        </li>
        @for ($i = 1; $i <= $surveys->lastPage(); $i++)
        <li class="page-item {{ ($surveys->currentPage() == $i) ? 'active' : '' }}">
            <a class="page-link" href="{{ $surveys->url($i) }}">{{ $i }}</a>
        </li>
        @endfor
        <li class="page-item {{ ($surveys->currentPage() == $surveys->lastPage()) ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $surveys->nextPageUrl() }}">Next</a>
        </li>
    </ul>
</nav>
<!-- End Pagination -->


<!-- POP UP TAMBAH QUESTIONS -->
<div id="popup" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); max-width: 400px;">
    <h4 style="margin-top: 0; margin-bottom: 20px; text-align: center;">Tambah Data QUESTIONS</h4>
    
    <form action="{{ route('survey.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="question">Pertanyaan</label>
            <input type="text" class="form-control" id="question" name="question" placeholder="Masukkan question">
        </div>
        <div class="form-group">
            <label for="baik">Baik</label>
            <input type="text" class="form-control" id="baik" name="baik" placeholder="Masukkan baik">
        </div>
        <div class="form-group">
            <label for="sangat_baik">Sangat Baik</label>
            <input type="text" class="form-control" id="sangat_baik" name="sangat_baik" placeholder="Masukkan sangat_baik">
        </div>
        <div class="form-group">
            <label for="buruk">Buruk</label>
            <input type="text" class="form-control" id="buruk" name="buruk" placeholder="Masukkan asal buruk">
        </div>
        <div class="form-group">
            <label for="sangat_buruk">Sangat Buruk</label>
            <input type="text" class="form-control" id="sangat_buruk" name="sangat_buruk" placeholder="Masukkan asal sangat_buruk">
        </div>
        
        <div style="text-align: center;">
            <button type="submit" class="btn btn-primary" style="margin-right: 10px;">Submit</button>
            <button type="button" class="btn btn-secondary" onclick="togglePopup()">Close</button>
        </div>
    </form>
</div>
<!-- END POP UP TAMBAH QUESTIONS -->

<!-- POP UP EDIT QUESTIONS -->
<div id="popupedit" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); max-width: 400px;">
    <h4 style="margin-top: 0; margin-bottom: 20px; text-align: center;">Edit Data QUESTIONS</h4>
    
    <form action="{{ route('survey.update', $survey->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="question">Pertanyaan</label>
            <input type="text" class="form-control" id="question" name="question" placeholder="Masukkan question" value="{{ $survey->question }}">
        </div>
        <div class="form-group">
            <label for="baik">Baik</label>
            <input type="text" class="form-control" id="baik" name="baik" placeholder="Masukkan baik" value="{{ $survey->baik }}">
        </div>
        <div class="form-group">
            <label for="sangat_baik">Sangat Baik</label>
            <input type="text" class="form-control" id="sangat_baik" name="sangat_baik" placeholder="Masukkan sangat_baik" value="{{ $survey->sangat_baik }}">
        </div>
        <div class="form-group">
            <label for="buruk">Buruk</label>
            <input type="text" class="form-control" id="buruk" name="buruk" placeholder="Masukkan asal buruk" value="{{ $survey->buruk }}">
        </div>
        <div class="form-group">
            <label for="sangat_buruk">Sangat Buruk</label>
            <input type="text" class="form-control" id="sangat_buruk" name="sangat_buruk" placeholder="Masukkan asal sangat_buruk" value="{{ $survey->sangat_buruk }}">
        </div>

        <div style="text-align: center;">
            <button type="submit" class="btn btn-primary" style="margin-right: 10px;">Submit</button>
            <button type="button" class="btn btn-secondary" onclick="togglePopupedit()">Close</button>
        </div>
    </form>
</div>
<!-- END POP UP EDIT QUESTIONS -->

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
