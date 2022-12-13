@extends('layouts\app')
@section('title', 'Books Edit')

@stack('prepend-style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stack('addon-style')

@section('content')
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Books Edit</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Books Edit</h6>
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
                                    <h4>Books Edit</h4>
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
                                    <form action="#" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <label for="book_code" class="form-label">Code</label>
                                                    <input type="text" class="form-control" id="book_code"
                                                        name="book_code" value="{{ $bookEdit->book_code }}" required
                                                        readonly>
                                                </div>
                                                <div class="col-12 col-md-6 mb-2">
                                                    <label for="title" class="form-label">Title</label>
                                                    <input type="text" class="form-control" id="title" name="title"
                                                        value="{{ $bookEdit->title }}" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <label for="image" class="form-label">Cover Book</label>
                                                    <input type="file" class="form-control" id="image"
                                                        name="image">
                                                    {{-- currentCover --}}
                                                    <label for="title" class=" mt-2 form-label">
                                                        Current Cover
                                                    </label><br>
                                                    <div class="text-center mb-3">
                                                        @if ($bookEdit->cover != '')
                                                            <img src="{{ asset('storage/cover/' . $bookEdit->cover) }}"
                                                                class="rounded w-50" alt="">
                                                        @else
                                                            <img src="{{ asset('assets/img/cover-book.png') }}"
                                                                class="rounded w-50" alt="">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-2 mt-1">
                                                    <label for="title" class="form-label">Genre</label>
                                                    <select name="categories[]" id="category"
                                                        class="form-control js-example-basic-multiple" multiple="multiple">
                                                        @foreach ($Categories as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    {{-- currentCategory --}}
                                                    <label for="title" class=" mt-2 form-label">
                                                        Current Category</label><br>
                                                    @foreach ($bookEdit->categories as $item)
                                                        <span class="badge badge-xs bg-gradient-success">
                                                            {{ $item->name }}
                                                        </span>
                                                    @endforeach
                                                    {{-- currentCategory --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-primary btn-md btn-block mb-0" type="submit">
                                                Update
                                            </button>
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
