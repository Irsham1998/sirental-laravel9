@extends('layouts\app')
@section('title', 'Books')

@section('content')
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Books Add</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Books Add</h6>
        </nav>
    </div>
    {{-- table --}}
    <div class="row pt-2">
        <div class="col-12">
            <div class="card mb-4 mt-3">
                <div class="card-header pb-0">
                    <div class="container">
                        <div class="row">
                            <div class="row">
                                <div class="col-md-12 p-2">
                                    <h4>Books Add</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- add data --}}
                <div class="row py-4">
                    <div class="col-12 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-body p-3">
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
                                    <form action="/books-add" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <label for="book_code" class="form-label">Code</label>
                                                    <input type="text" class="form-control" id="book_code"
                                                        name="book_code" value="{{ old('book_code') }}" required>
                                                </div>
                                                <div class="col-12 col-md-6 mb-2">
                                                    <label for="title" class="form-label">Title</label>
                                                    <input type="text" class="form-control" id="title" name="title"
                                                        value="{{ old('title') }}" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label for="image" class="form-label">Cover Book</label>
                                                    <input type="file" class="form-control" id="image"
                                                        name="image">
                                                </div>
                                            </div>
                                            <div class="d-grid gap-2">
                                                <button class="btn btn-primary btn-md btn-block mb-0" type="submit">
                                                    Save
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
            </div>
        </div>
    </div>
    {{-- table --}}
@endsection
