<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/formulir.css')}}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<div class="container mt-5">
<div class="row">
        <div class="col-md-3 order-md-first image-container mt-5 d-flex flex-column align-items-center">
            <img src="{{asset('img/form.png')}}" alt="Gambar" style="margin-top: -20px; width: 100%; height: 20%;">
            <div class="dropdown mt-3">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('form-kunjungan') }}">Formulir Kunjungan</a>
                    <a class="dropdown-item" href="{{ route('surveypengguna') }}">Survey Kepuasan</a>
                    <a class="dropdown-item" href="{{ route('daftartamukunjungan') }}">Buku Kunjungan Tamu</a>
                    <a class="dropdown-item" href="/">Home</a>
                </div>
            </div>
            </div>

            <div class="col-md-9">
                <div class="card">
                    <!-- Judul "Tamu Kunjungan" dan Menu Dropdown -->
                    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                        <h2 class="card-title">Survey Kepuasan</h2>
                    </div>
                    <!-- End Judul "Tamu Kunjungan" dan Menu Dropdown -->

            <div class="card-body w-100">
                <form action="/form" method="post">
                    @csrf
                <form>
                    <label for="rating">1. Seberapa mudah Anda menavigasi aplikasi kami?</label>
                <div>
                    <input type="radio" id="rating-5" name="rating" value="5">
                    <label for="rating-5">Sangat Mudah</label>
                </div>
                <div>
                    <input type="radio" id="rating-4" name="rating" value="4">
                    <label for="rating-4">Mudah</label>
                </div>
                <div>
                    <input type="radio" id="rating-3" name="rating" value="3">
                    <label for="rating-3">Sangat Sulit</label>
                </div>
                <div>
                    <input type="radio" id="rating-2" name="rating" value="2">
                    <label for="rating-2">Sulit</label>
                </div>
                <br>

                <label for="rating">2. Seberapa baik Anda merasa aplikasi kami memenuhi ekspektasi Anda?</label>
                <div>
                    <input type="radio" id="rating-5" name="rating" value="5">
                    <label for="rating-5">Sangat Mudah</label>
                </div>
                <div>
                    <input type="radio" id="rating-4" name="rating" value="4">
                    <label for="rating-4">Mudah</label>
                </div>
                <div>
                    <input type="radio" id="rating-3" name="rating" value="3">
                    <label for="rating-3">Sangat Sulit</label>
                </div>
                <div>
                    <input type="radio" id="rating-2" name="rating" value="2">
                    <label for="rating-2">Sulit</label>
                </div>
                <br>

                <label for="rating">3. Apakah Anda menyukai tata letak dan desain visual dari aplikasi kami?</label>
                <div>
                    <input type="radio" id="rating-5" name="rating" value="5">
                    <label for="rating-5">Sangat Mudah</label>
                </div>
                <div>
                    <input type="radio" id="rating-4" name="rating" value="4">
                    <label for="rating-4">Mudah</label>
                </div>
                <div>
                    <input type="radio" id="rating-3" name="rating" value="3">
                    <label for="rating-3">Sangat Sulit</label>
                </div>
                <div>
                    <input type="radio" id="rating-2" name="rating" value="2">
                    <label for="rating-2">Sulit</label>
                </div>
                <br>

                <label for="rating">4. Apakah Anda mengalami kesulitan dalam menemukan fitur atau informasi tertentu di dalam aplikasi?</label>
                <div>
                    <input type="radio" id="rating-5" name="rating" value="5">
                    <label for="rating-5">Sangat Mudah</label>
                </div>
                <div>
                    <input type="radio" id="rating-4" name="rating" value="4">
                    <label for="rating-4">Mudah</label>
                </div>
                <div>
                    <input type="radio" id="rating-3" name="rating" value="3">
                    <label for="rating-3">Sangat Sulit</label>
                </div>
                <div>
                    <input type="radio" id="rating-2" name="rating" value="2">
                    <label for="rating-2">Sulit</label>
                </div>
                
                </form>
          
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-secondary" style="width: 100%;">Submit</button>
                </div>




<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
