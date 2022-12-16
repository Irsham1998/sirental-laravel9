@extends('layouts\app')
@section('title', 'Book Store')

@section('content')
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Book Store</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Book Store</h6>
        </nav>
        <form action="" method="get">
            <div class="row mt-4 mb-2">
                <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                    <select name="category" id="category" class="form-select">
                        <option selected>Search by category</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5 mb-2">
                    <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" name="title" id="title" class="form-control"
                            placeholder="Search by title">
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 mb-2 text-center">
                    <button class="btn btn-dark input-block-level form-control">
                        <i class="fas fa-search" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </form>
        {{-- book --}}
        <div class="row pt-2">
            <div class="card">
                <div class="card-body">
                    {{-- card book --}}
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach ($books as $itembook)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="card">
                                    @if ($itembook->cover != '')
                                        <img src="{{ asset('storage/cover/' . $itembook->cover) }}" class="card-img-top"
                                            draggable="false">
                                    @else
                                        <img src="{{ asset('assets/img/cover-book.png') }}" class="card-img-top"
                                            draggable="false">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $itembook->title }}</h5>
                                        <p class="card-text">
                                            @foreach ($itembook->categories as $item)
                                                <span class="badge text-bg-secondary">
                                                    {{ $item->name }}
                                                </span>
                                            @endforeach
                                        </p>
                                        <div class="row">
                                            @if ($itembook->status == 'in stock')
                                                <a class="btn btn-success btn-md mb-0 justify-content-end" href="">
                                                    Rent now
                                                </a>
                                            @else
                                                <a class="btn btn-secondary btn-md mb-0 justify-content-end disabled"
                                                    href="">
                                                    Sedang dipinjam
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- card book --}}
                </div>
            </div>
        </div>
        {{-- book --}}
    @endsection
