@extends('template')
@section('title', "Lihat Buku - $data->title")

@php
    $categories = \App\Models\BookCategory::all();
@endphp

@section('content')
    <div class="container-fluid">
        @include('partials.alert')

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text--black">Detail Buku</h1>

            <a href="{{ route('book.edit', $data->id) }}" class="btn btn-primary">Edit</a>
        </div>

        <form method="POST" action={{ route('book.update', $data->id) }}>
            @method('PUT')
            @csrf
            <div class="card p-4">
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input readonly type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        placeholder="Masukkan Judul" name="title" value="{{ $data->title ?? '' }}">

                    @error('title')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="author">Penulis</label>
                    <input readonly type="text" class="form-control @error('author') is-invalid @enderror" id="author"
                        placeholder="Masukkan Penulis" name="author" value="{{ $data->author ?? '' }}">

                    @error('author')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="publisher">Penerbit</label>
                    <input readonly type="text" class="form-control @error('publisher') is-invalid @enderror"
                        id="publisher" placeholder="Masukkan Penerbit" name="publisher"
                        value="{{ $data->publisher ?? '' }}">

                    @error('publisher')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="publish_year">Tahun Terbit</label>
                    <input readonly type="number" min="1900" max="{{ \Carbon\Carbon::now()->year }}"
                        class="form-control @error('publish_year') is-invalid @enderror" id="publish_year"
                        name="publish_year" placeholder="Tahun Terbit" value="{{ $data->publish_year ?? '' }}">

                    @error('publish_year')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category_id">Kategori</label>
                    <input readonly type="text" class="form-control" id="category_id" name="publish_year"
                        placeholder="Kategori" value="{{ $data->category->name ?? '' }}">
                    </select>

                    @error('category_id')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </form>

        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
            <h1 class="h4 mb-0 text--black">Salinan</h1>
        </div>

        <div class="card p-3">
            {!! $dataTable->table() !!}
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
