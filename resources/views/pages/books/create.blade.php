@extends('template')
@section('title', 'Tambah Buku')

@php
    $categories = \App\Models\BookCategory::all();
@endphp

@section('content')
    <div class="container-fluid">
        @include('partials.alert')

        <div>
            <h1 class="h4 mb-0 text--black">Tambah Buku</h1>
            <p class="text--black">Harap isi attribut buku yang diperlukan.</p>
        </div>

        <form method="POST" action={{ route('book.store') }}>
            @csrf
            <div class="card p-4">
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        placeholder="Masukkan Judul" name="title" value="{{ old('title') ?? '' }}">

                    @error('title')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="author">Penulis</label>
                    <input type="text" class="form-control @error('author') is-invalid @enderror" id="author"
                        placeholder="Masukkan Penulis" name="author" value="{{ old('author') ?? '' }}">

                    @error('author')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="publisher">Penerbit</label>
                    <input type="text" class="form-control @error('publisher') is-invalid @enderror" id="publisher"
                        placeholder="Masukkan Penerbit" name="publisher" value="{{ old('publisher') ?? '' }}">

                    @error('publisher')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="publish_year">Tahun Terbit</label>
                    <input type="number" min="1900" max="{{ \Carbon\Carbon::now()->year }}"
                        class="form-control @error('publish_year') is-invalid @enderror" id="publish_year"
                        name="publish_year" placeholder="Tahun Terbit" value="{{ old('publish_year') ?? '' }}">

                    @error('publish_year')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category_id">Kategori</label>
                    <select class="form-control  @error('category_id') is-invalid @enderror" id="category_id"
                        name="category_id" value="{{ old('category_id') ?? '' }}">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                    @error('category_id')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="/books" class="btn btn-secondary mr-2">Kembali</a>
                <button type="submit" class="btn btn-primary">Buat</a>
            </div>
        </form>
    </div>
@endsection
