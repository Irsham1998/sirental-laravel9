@extends('layouts\app')
@section('title', 'Categories')

@section('content')
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Categories</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Categories</h6>
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
                    <div class="container">
                        <!-- Stack the columns on mobile by making one full-width and the other half-width -->
                        <form action="/categories-add" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-8 p-2">
                                    <input type="text" class="form-control form-control-md" placeholder="Genre"
                                        aria-label="Genre" name="name" id="name" required>
                                </div>
                                <div class="d-grid col-12 col-md-4 p-2">
                                    <button class="btn btn-primary btn-md btn-block mb-0 " type="submit">
                                        Add new genre
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- test --}}
                </div>
            </div>
        </div>
    </div>
    {{-- end add data --}}
    <div class="row mt-2">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h4>Genre List</h4>
                </div>
                <div class="card-body px-0 pt-0 pb-2 mt-4">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                        #
                                    </th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">
                                        Genre
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categoryData as $item)
                                    <tr>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0 text-center">
                                                {{ $loop->iteration }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0 text-left">
                                                {{ $item['name'] }}
                                            </p>
                                        </td>
                                        <td class="align-middle">
                                            <div class="dropdown">
                                                <button class="btn btn-link text-secondary mb-0" aria-haspopup="true"
                                                    aria-expanded="false" data-bs-toggle="dropdown">
                                                    <i class="fa fa-ellipsis-v text-xs"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="btn btn-link text-dark text-gradient px-3 mb-0 dropdown-item"
                                                            href="/categories-edit/{{ $item->slug }}"><i
                                                                class="fas fa-pencil-alt text-dark me-2"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form action="/categories-delete/{{ $item->slug }}" method="POST"
                                                            class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button
                                                                class="btn btn-link text-danger text-gradient px-3 mb-0 dropdown-item"
                                                                onclick="return confirm('Apakah anda yakin menghapus {{ $item->name }} ?')">
                                                                <i class="far fa-trash-alt me-2"></i>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
