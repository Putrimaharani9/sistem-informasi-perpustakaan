@extends('template')
@section('title', 'Tambah Salinan')

@section('content')
    <div class="container-fluid">
        <div>
            <h1 class="h4 mb-0 text--black">Tambah Salinan</h1>
            <p class="text--black">Harap isi data yang diperlukan.</p>
        </div>

        <form method="POST" action={{ route('copy.store', $parent->id) }}>
            @csrf
            <div class="card p-4">
                <div class="form-group">
                    <label for="code">Kode</label>
                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code"
                        placeholder="Masukkan Kode" name="code" value="{{ old('Kode') ?? '' }}">

                    @error('code')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="/books/{{ $parent->id }}/edit" class="btn btn-secondary mr-2">Kembali</a>
                <button type="submit" class="btn btn-primary">Tambah</a>
            </div>
        </form>
    </div>
@endsection
