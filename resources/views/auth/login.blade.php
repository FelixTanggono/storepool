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
                        <form class="user" method='POST'>
                            <div>
                            <!-- @if(Session::has('message'))
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                            @endif -->
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if (session('failure'))
                                <div class="alert alert-danger alert-dismissible fade show">
                                    {{ session('failure') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            </div>
                            <div class="form-group">
                            <input type="email" class="form-control form-control-user" name="email" id="email" aria-describedby="emailHelp" placeholder="Masukkan email anda ...">
                            </div>
                            <div class="form-group">
                            <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Masukkan kata Sandi anda ...">
                            </div>
                            <div class="form-group">
                            <div class="custom-control custom-checkbox small">
                                <input type="checkbox" class="custom-control-input" id="customCheck" name="remember">
                                <label class="custom-control-label text-white" for="customCheck" >Ingat Saya</label>
                            </div>
                            </div>
                            {{ csrf_field()  }}

                            <button type="submit" value='submit'  class="btn btn-primary btn-user btn-block">Login</button>
                        </form>
                        <hr>
                        <div class="text-center user">
                            <a class=" btn btn-primary btn-user btn-block" href="/forgotPassword">Lupa Kata Sandi?</a>
                        </div>
                        <hr>
                        <div class="text-center user">
                            <a class=" btn btn-primary btn-user btn-block" href="/register">Buat Akun!</a>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
@endsection