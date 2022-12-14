@extends('layouts\app')
@section('title', 'Users')

@section('content')
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Users Banned</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Users Banned</h6>
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
                                    <h4>Users Banned List</h4>
                                </div>
                                <div class="d-grid col-12 col-md-4 p-2">
                                    <a href="/users" class="btn btn-success btn-md btn-block mb-0 " type="">
                                        User active
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
                                        Nama
                                    </th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">
                                        Email
                                    </th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">
                                        Phone
                                    </th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">
                                        Address
                                    </th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">
                                        Status
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bannedList as $item)
                                    <tr>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0 text-center">
                                                {{ $loop->iteration }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0 text-left">
                                                {{ $item->name }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0 text-left">
                                                {{ $item->email }}
                                            </p>
                                        </td>
                                        <td>
                                            @if ($item->phone != '')
                                                <p class="text-sm font-weight-bold mb-0 text-left">
                                                    {{ $item->phone }}
                                                </p>
                                            @else
                                                <p class="text-sm font-weight-bold mb-0 text-left">
                                                    -
                                                </p>
                                            @endif
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0 text-left">
                                                {{ $item->address }}
                                            </p>
                                        </td>
                                        <td>
                                            @if ($item->status == 'active')
                                                <p class="text-sm font-weight-bold mb-0 text-left">
                                                    <span class="badge text-bg-success">{{ $item->status }}</span>
                                                </p>
                                            @else
                                                <p class="text-sm font-weight-bold mb-0 text-left">
                                                    <span class="badge text-bg-danger">{{ $item->status }}</span>
                                                </p>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-link text-danger text-gradient px-3 mb-0 dropdown-item"
                                                href="/users-restore/{{ $item->email }}"><i
                                                    class="fas fa-pencil-alt text-dark me-2"></i>
                                                Unbanned
                                            </a>
                                            {{-- <form action="/users-banned/{{ $item->email }}" method="POST"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button
                                                    class="btn btn-link text-danger text-gradient px-3 mb-0 dropdown-item"
                                                    onclick="return confirm('Apakah anda yakin banned {{ $item->name }} ?')">
                                                    <i class="far fa-trash-alt me-2"></i>
                                                    Banned
                                                </button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            No have users data
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
