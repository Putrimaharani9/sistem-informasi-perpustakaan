@extends('template')

@section('content')
    <div class="container-fluid">
        @include('partials.alert')

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-800">{{ $pageTitle }}</h1>

            <div class="d-flex">
                <div class="btn-group mr-2">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="fa fa-file-import mr-2" aria-hidden="true"></i> Import </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" data-toggle="modal" data-target="#book-import-modal"
                            href="#">Buku</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#book-copy-import-modal"
                            href="#">Salinan</a>
                    </div>
                </div>

                <a href="/books/create" class="btn btn-primary">+ Tambah</a>
            </div>
        </div>

        @include('pages.books.table')
        @include('pages.books.import_modal')
        @include('pages.books.import_copy_modal')
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        const onDeleteBook = async (event) => {
            const form = event.target.parentElement.querySelector('[data-for="DELETE"]');

            const {
                isConfirmed
            } = await Swal.fire({
                title: 'Apakah Anda yakin untuk menghapus data ini?',
                text: 'Data yang sudah dihapus tidak dapat dikembalikan.',
                icon: 'question',
                showCancelButton: true,
            });

            if (!isConfirmed) return;

            form.submit();
        }
    </script>
@endpush
