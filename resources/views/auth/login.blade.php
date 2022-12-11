@extends('layouts\auths')
@section('title', 'Login')

@section('content')
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                @if (session('status'))
                                    <div class="alert alert-danger">
                                        {{ session('message') }}
                                    </div>
                                @endif
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Masuk</h4>
                                    <p class="mb-0">Ketikan email dan password</p>
                                </div>
                                <div class="card-body">
                                    <form action="/" method="POST" role="form" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="email" class="form-control form-control-lg" placeholder="Email"
                                                aria-label="Email" name="email" id="email">
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control form-control-lg"
                                                placeholder="Password" aria-label="Password" name="password" id="password">
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Ingat saya</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Masuk</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Tidak memiliki akun?
                                        <a href="/register" class="text-primary text-gradient font-weight-bold">Daftar</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
            background-size: cover;">
                                <span class="mask bg-gradient-primary opacity-6"></span>
                                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Banyak kisah menarik dari
                                    sebuah buku"</h4>
                                <p class="text-white position-relative">Semakin mudah tulisan itu terlihat, semakin banyak
                                    upaya yang benar-benar dilakukan penulis dalam prosesnya.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
