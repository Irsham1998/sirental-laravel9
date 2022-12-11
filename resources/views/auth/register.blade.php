@extends('layouts\auths')
@section('title', 'Register')

@section('content')
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
            style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">Selamat Datang!</h1>
                        <p class="text-lead text-white">Lakukan pendaftaran akun untuk mendapatkan keuntungan lainnya</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="row px-3">
                            <div class="card-body vh-100">
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="card-header text-center pt-4">
                                    <h5>Daftar</h5>
                                </div>
                                <form action="/register" method="POST" role="form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Name" aria-label="Name"
                                            name="name" id="name" required autofocus>
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control" placeholder="Email" aria-label="Email"
                                            name="email" id="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" class="form-control" placeholder="Password"
                                            aria-label="Password" name="password" id="password" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="number" class="form-control" placeholder="Phone number"
                                            aria-label="Phone number" name="phone" id="phone">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Address"
                                            aria-label="Address" name="address" id="address" required>
                                    </div>
                                    <div class="form-check form-check-info text-start">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
                                            checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms
                                                and Conditions</a>
                                        </label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Daftar</button>
                                    </div>
                                    <p class="text-sm mt-3 mb-0">Sudah punya akun? <a href="/"
                                            class="text-dark font-weight-bolder">Masuk</a></p>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
