@extends('template')
@section('title', "Edit Buku - $data->title")

@php
    $categories = \App\Models\BookCategory::all();
@endphp

@section('content')
    <div class="container-fluid">
        @include('partials.alert')
        
        <div class="d-sm-flex align-items-center justify-content-between">
            <div>
                <h1 class="h4 mb-0 text--black">Edit Buku</h1>
                <p class="text--black">Harap isi attribut buku yang diperlukan.</p>
            </div>
        </div>

        <form method="POST" action={{ route('book.update', $data->id) }}>
            @method('PUT')
            @csrf
            <div class="card p-4">
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        placeholder="Masukkan Judul" name="title" value="{{ $data->title ?? '' }}">

                    @error('title')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="author">Penulis</label>
                    <input type="text" class="form-control @error('author') is-invalid @enderror" id="author"
                        placeholder="Masukkan Penulis" name="author" value="{{ $data->author ?? '' }}">

                    @error('author')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="publisher">Penerbit</label>
                    <input type="text" class="form-control @error('publisher') is-invalid @enderror" id="publisher"
                        placeholder="Masukkan Penerbit" name="publisher" value="{{ $data->publisher ?? '' }}">

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
                        name="publish_year" placeholder="Tahun Terbit" value="{{ $data->publish_year ?? '' }}">

                    @error('publish_year')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category_id">Kategori</label>
                    <select class="form-control  @error('category_id') is-invalid @enderror" id="category_id"
                        name="category_id" value="{{ $data->category_id ?? '' }}">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id === $data->category_id ? 'selected' : '' }}>{{ $category->name }}
                            </option>
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
                <button type="submit" class="btn btn-primary">Simpan</a>
            </div>
        </form>

        <hr>

        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
            <h1 class="h4 mb-0 text--black">Salinan</h1>
            <a href="/books/{{ $data->id }}/copies/create" class="btn btn-primary">+ Tambah</a>
        </div>

        <div class="card p-3">
            {!! $dataTable->table() !!}
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        const onDeleteCopy = async (event) => {
            const form = event.target.parentElement.querySelector('[data-for="DELETE"]');

            const {
                isConfirmed
            } = await Swal.fire({
                title: 'Apakah Anda yakin untuk menghapus data ini?',
                text: 'Data yang sudah dihapus tidak dapat dikembalikan.',
                icon: 'question',
                showCancelButton: true,
            });

            form.submit();
        }
    </script>
@endpush
