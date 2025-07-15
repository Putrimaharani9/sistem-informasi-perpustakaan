@extends('template')

@section('content')
    <div class="container-fluid">
        @include('partials.alert')

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-800">{{ $pageTitle }}</h1>
        </div>

        <form id="visit-form" method="POST" action="{{ route('visits.store') }}">
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
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="button" onClick="onSubmitVisit()" class="btn btn-primary">Tambah</a>
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
        });

        const onSubmitVisit = async (event) => {
            const {
                isConfirmed
            } = await Swal.fire({
                title: 'Konfirmasi Kunjungan',
                text: 'Pastikan data yang diisi benar',
                showCancelButton: true,
            })

            if (isConfirmed) {
                const form = document.getElementById('visit-form')
                form.submit();
            }
        }
    </script>
@endpush
