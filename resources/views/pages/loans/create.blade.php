@extends('template')

@section('content')
    <div class="container-fluid">
        @include('partials.alert')

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-800">{{ $pageTitle }}</h1>
        </div>

        <form id="loan-form" method="POST" action="{{ route('loans.store') }}">
            @csrf
            <div class="card p-4">
                <div class="form-group">
                    <label for="member_id">Anggota</label>
                    <select id="member_id" class="js-example-basic-single js-states form-control" name="member_id"></select>

                    @error('member_id')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="copy_id">Buku</label>
                    <select id="copy_id" class="js-example-basic-single js-states form-control" name="copy_id"></select>

                    @error('copy_id')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="return_date">Tanggal Pengembalian</label>
                    <input type="date" class="form-control" name="return_date" />

                    @error('return_date')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="button" onClick="onSubmitBookLoan()" class="btn btn-primary">Buat</a>
            </div>
        </form>
    </div>
@endsection

@push('style')
    <link href="/vendor/select2/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="/vendor/select2/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#member_id').select2({
                placeholder: 'Pilih Anggota',
                ajax: {
                    url: "{{ route('members.ajax.get') }}",
                    dataType: 'json',
                    data: function(params) {
                        return {
                            search: params.term,
                            page: params.page || 1
                        }
                    },
                    delay: 800,
                    processResults: function(data) {
                        return {
                            results: data.data.map((data) => ({
                                id: data.id,
                                text: `${data.name} - ${data.email}`
                            })),
                            pagination: {
                                more: data.last_page > data.current_page
                            }
                        };
                    }
                },
            });

            $('#copy_id').select2({
                placeholder: 'Pilih Buku',
                ajax: {
                    url: "{{ route('copies.ajax.get') }}",
                    dataType: 'json',
                    data: function(params) {
                        return {
                            search: params.term,
                            page: params.page || 1
                        }
                    },
                    delay: 800,
                    processResults: function(data) {
                        return {
                            results: data.data.map((data) => ({
                                id: data.id,
                                text: `${data.book.title} - ${data.code}`
                            })),
                            pagination: {
                                more: data.last_page > data.current_page
                            }
                        };
                    }
                },
            });
        });

        const onSubmitBookLoan = async (event) => {
            const {
                isConfirmed
            } = await Swal.fire({
                title: 'Konfirmasi Peminjaman',
                text: 'Pastikan data yang diisi benar',
                showCancelButton: true,
            })

            if (isConfirmed) {
                const form = document.getElementById('loan-form')
                form.submit();
            }
        }
    </script>
@endpush
