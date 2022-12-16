@extends('layouts\app')
@section('title', 'Books')

@section('content')
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Books</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Books</h6>
        </nav>
    </div>
    {{-- table --}}
    <div class="row pt-2">
        <div class="col-12">
            <div class="card mb-4 mt-3">
                <div class="card-header pb-0">
                    {{-- notif --}}
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
                    {{-- notif --}}
                    <div class="container">
                        <div class="row">
                            <div class="row">
                                <div class="col-md-8 p-2">
                                    <h4>Books List</h4>
                                </div>
                                <div class="d-grid col-12 col-md-4 p-2">
                                    <a class="btn btn-primary btn-md btn-block mb-0 justify-content-end" href="/books-add">
                                        Add new book
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                        Kode
                                    </th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">
                                        Title
                                    </th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">
                                        Category
                                    </th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">
                                        Status
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($books as $item)
                                    <tr>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0 text-center">
                                                {{ $loop->iteration }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0 text-left">
                                                {{ $item->book_code }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0 text-left">
                                                {{ $item->title }}
                                            </p>
                                        </td>
                                        <td>
                                            @foreach ($item->categories as $category)
                                                <p class="align-middle text-xs text-left">
                                                    <span class="badge badge-sm bg-gradient-success">
                                                        {{ $category->name }}
                                                    </span>
                                                </p>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($item->status == 'in stock')
                                                <p class="text-sm font-weight-bold mb-0 text-left">
                                                    {{ $item->status }}
                                                </p>
                                            @else
                                                <p class="text-sm text-danger font-weight-bold mb-0 text-left">
                                                    {{ $item->status }}
                                                </p>
                                            @endif
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
                                                            href="/books-edit/{{ $item->slug }}"><i
                                                                class="fas fa-pencil-alt text-dark me-2"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form action="/books-delete/{{ $item->slug }}" method="POST"
                                                            class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button
                                                                class="btn btn-link text-danger text-gradient px-3 mb-0 dropdown-item"
                                                                onclick="return confirm('Apakah anda yakin menghapus {{ $item->title }} ?')">
                                                                <i class="far fa-trash-alt me-2"></i>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            No have book data
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- table --}}
@endsection
