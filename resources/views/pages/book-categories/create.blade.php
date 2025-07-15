@extends('template')
@section('title', 'Tambah Kategori Buku')


@section('content')
    <div class="container-fluid">
        @include('partials.alert')

        <div>
            <h1 class="h4 mb-0 text--black">Tambah Kategori Buku</h1>
            <p class="text--black">Harap isi data yang diperlukan.</p>
        </div>

        <form method="POST" action={{ route('book-categories.store') }}>
            @csrf
            <div class="card p-4">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Masukkan Nama" name="name" value="{{ old('name') ?? '' }}">

                    @error('name')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="/book-categories" class="btn btn-secondary mr-2">Kembali</a>
                <button type="submit" class="btn btn-primary">Buat</a>
            </div>
        </form>
    </div>
@endsection
