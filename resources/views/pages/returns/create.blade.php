@extends('template')

@section('content')
    <div class="container-fluid">
        @include('partials.alert')

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-800">{{ $pageTitle }}</h1>
        </div>

        <form id="return-form" method="POST" action="{{ route('returns.store') }}">
            @csrf
            <div class="card p-4">
                <div class="form-group">
                    <label for="member_id">Anggota</label>
                    <select id="member_id" class="js-example-basic-single js-states form-control" name="member_id">
                        @if (request()->get('member_id'))
                            @php
                                $member = \App\Models\User::find(request()->get('member_id'));
                            @endphp

                            @if ($member)
                                <option value="{{ request()->get('member_id') }}">
                                    {{ $member->name }}</option>
                            @endif
                        @endif
                    </select>

                    @error('member_id')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="copy_id">Salinan</label>
                    <select id="copy_id" class="js-example-basic-single js-states form-control" name="copy_id">
                        @if (request()->get('copy_code'))
                            @php
                                $copy = \App\Models\BookCopy::where('code', request()->get('copy_code'))->first();
                            @endphp

                            @if ($copy)
                                <option value="{{ $copy->id }}">
                                    {{ $copy->book->title . ' - ' . $copy->code }}</option>
                            @endif
                        @endif
                    </select>

                    @error('copy_id')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="updated_at">Tanggal Pengembalian</label>
                    <input type="date" class="form-control" name="updated_at" value="{{ date('Y-m-d') }}" />

                    @error('updated_at')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="button" onClick="onSubmitReturnBook()" class="btn btn-primary">Simpan Pengembalian</a>
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
                initSelection: 1,
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
                    },
                },
            });

            $('#copy_id').select2({
                placeholder: 'Kode Salinan',
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

        const onSubmitReturnBook = async (event) => {
            const {
                isConfirmed
            } = await Swal.fire({
                title: 'Konfirmasi Peminjaman',
                text: 'Pastikan data yang diisi benar',
                showCancelButton: true,
            })

            if (isConfirmed) {
                const form = document.getElementById('return-form')
                form.submit();
            }
        }
    </script>
@endpush
