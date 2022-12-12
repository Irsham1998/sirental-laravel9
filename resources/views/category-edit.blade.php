@extends('layouts\app')
@section('title', 'Category Edit')

@section('content')
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Categories</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Category Edit</h6>
        </nav>
    </div>
    {{-- add data --}}
    <div class="row py-4">
        <div class="col-12 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    @if (Session::has('status'))
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <div class="alert alert-success mt-2 w-100 text-center font-weight-bolder text-light"
                                    role="alert">
                                    {{ Session::get('message') }}
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                @foreach ($errors->all() as $error)
                                    <div
                                        class="alert alert-danger w-100  align-middle text-center font-weight-bolder text-light">
                                        {{ $error }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <form action="/categories-edit/{{ $categoryEdit->slug }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="d-flex">
                                <div class="p-2 col-8">
                                    <div class="mb-2">
                                        <input type="text" class="form-control form-control-md" placeholder="Genre"
                                            aria-label="Genre" value="{{ $categoryEdit->name }}" name="name"
                                            id="name" required>
                                    </div>
                                </div>
                                <div class="p-2 flex-shrink-1 col-4 text-end">
                                    <button class="btn btn-primary btn-md mb-0" href="#" type="submit">
                                        Update genre
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end add data --}}
@endsection
