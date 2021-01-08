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
                        <br>
                        @if (session('failure'))
                            <div class="alert alert-danger alert-dismissible flash-div  fade show">
                                {{ session('failure') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <br>
                        <div class="p-5">
                        <div class="text-center mb-5 ">
                            <h1 class= "text-white">
                            <img src="asset/image/landing page/logo.png" alt="" height="70">
                                REGISTRASI 
                            </h1>
                        </div>
                        <form class="user" method='POST'>
                            <div class="form-group">
                            <input type="email" class="form-control form-control-user" name="email" id="email" aria-describedby="emailHelp" placeholder="Masukkan email anda ...">
                            </div>
                            @error('email') 
                                <p style="color:red ;">{{$message}}</p>
                            @enderror
                            <div class="form-group">
                            <input type="username" class="form-control form-control-user" name="username" id="username" aria-describedby="usernameHelp" placeholder="Masukkan username anda ...">
                            </div>
                            @error('username') 
                                <p style="color:red ;">{{$message}}</p>
                            @enderror
                            <div class="form-group">
                            <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Masukkan kata Sandi anda ...">
                            </div>
                            @error('password') 
                                <p style="color:red ;">{{$message}}</p>
                            @enderror
                            <div class="form-group">
                            <input type="password" class="form-control form-control-user" name="confirm_password" id="confirm_password" placeholder="Masukkan ulang kata Sandi anda ...">
                            </div>
                            @error('confirm_password') 
                                <p style="color:red ;">{{$message}}</p>
                            @enderror
                            <br>
                            <br>    
                            {{ csrf_field()  }}
                            <!-- onclick="return confirm('Silakan cek email anda , kode verifikasi telah kami kirim !')" -->
                            <button type="submit" value='submit'  class="btn btn-primary btn-user btn-block">Register</button>
                        </form>
                        <hr>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
@endsection