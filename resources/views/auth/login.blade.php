<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('loginpage/style.css') }}">
    <title>TOEIC Log In</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form>
                <h1>Login</h1>
                <span>untuk masuk ke dalam sistem</span>
                <br>
                <input type="text" placeholder="Username">
                <input type="password" placeholder="Password">
                <br>
                <a href="#">Belum memiliki akun?</a>
                <button type="submit">Login</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form>
                <img src="{{ asset('loginpage/img/login.png') }}" style="width: 250px; height: auto;">
                {{-- <br><br>
                <button type="button" style="background-color: transparent; border-color: #000000; color:#000000" 
                    {{ route('admin.dashboard') }}>Kembali</button> --}}
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Tentang Kami</h1>
                    <p>Sistem Pendaftaran Ujian TOEIC adalah sistem yang dirancang untuk pendaftaran serta pengelolaan ujian TOEIC (Test of English for International Communication) bagi mahasiswa Politeknik Negeri Malang.</p>
                    <button class="hidden" id="login">Kembali</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <br><br>
                    <h1>Selamat Datang</h1>
                    <p style="font-size: 18px">di Sistem Pendaftaran Ujian TOEIC Politeknik Negeri Malang.</p>
                    <br>
                    <button class="hidden" id="register">Lanjut</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('loginpage/script.js') }}"></script>
</body>

</html>