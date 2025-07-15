@extends('template')
@section('title', "Lihat Kategori Buku - $data->name")

@section('content')
    <div class="container-fluid">
        @include('partials.alert')

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text--black">Detail Kategori Buku</h1>

            <a href="{{ route('book-categories.edit', $data->id) }}" class="btn btn-primary">Edit</a>
        </div>

        <form">
            <div class="card p-4">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input readonly type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Masukkan Nama" name="name" value="{{ $data->name ?? '' }}">
                </div>
            </div>
        </form>
    </div>
@endsection
