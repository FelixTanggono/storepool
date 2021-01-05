@extends('authmaster')

@section('content')
     <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6" style="background-color: #113448 ;">
                        <div class="p-5">
                        <div class="text-center mb-5 ">
                            <h1 class= "text-white">
                            <img src="asset/image/landing page/logo.png" alt="" height="70">
                            STOREPOOL 
                            </h1>
                        </div>
                        <form class="user" method='GET'>
                            <div class="form-group">
                            <input type="email" class="form-control form-control-user" name="email" id="email" aria-describedby="emailHelp" placeholder="Masukkan email anda ...">
                            </div>
                            <div class="form-group">
                            </div>
                            <br>
                            <a href="/login" class="btn btn-primary btn-user btn-block" onclick="return confirm('Silakan cek email anda , kode verifikasi telah kami kirim !')">
                                Kirim Kode Verifikasi
                            </a>
                        </form>
                        <hr>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
@endsection