@extends('layouts\app')
@section('title', 'Book Rent')

@stack('prepend-style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stack('addon-style')

@section('content')
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Book Rent</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Book Rent</h6>
        </nav>
    </div>
    {{-- add data --}}
    <div class="row py-4">
        <div class="col-12 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    @if (session('status'))
                        <div class="alert alert-{{ session('status') }}">
                            {{ session('message') }}
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
                        <form action="/book-rent-add" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label for="user" class="form-label">User</label>
                                        <select class="form-control js-example-basic-multiple" name="user_id" id="user"
                                            aria-label="Default select example" required>
                                            <option selected>Choose user</option>
                                            @foreach ($userlist as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="book" class="form-label">Title book</label>
                                        <select class="form-select js-example-basic-multiple" name="book_id" id="book"
                                            required>
                                            <option selected>Choose book need rent</option>
                                            @foreach ($booklist as $item)
                                                <option value="{{ $item->id }}">{{ $item->title }}
                                                    | {{ $item->book_code }} | [{{ $item->status }}]
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 text-start mt-3">
                                    <button class="btn btn-primary btn-md mb-0" href="#" type="submit">
                                        Rent
                                    </button>
                                </div>
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

@stack('prepend-script')
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
@stack('addon-script')
