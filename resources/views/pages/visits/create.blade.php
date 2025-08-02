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
                <button type="button" onClick="onSubmitVisit()" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>
@endsection

@push('style')
    <link href="/vendor/select2/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="/vendor/select2/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#member_id').select2({
                placeholder: 'Pilih Anggota',
                ajax: {
                    url: "{{ url('/members/search') }}", // pastikan sesuai dengan route
                    dataType: 'json',
                    delay: 500,
                    data: function(params) {
                        return {
                            term: params.term // ini cocok dengan $request->get('term') di controller
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map((member) => ({
                                id: member.id,
                                text: `${member.name} - ${member.email}`
                            }))
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1
            });
        });

        const onSubmitVisit = async () => {
            const result = await Swal.fire({
                title: 'Konfirmasi Kunjungan',
                text: 'Pastikan data yang diisi benar',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, simpan',
                cancelButtonText: 'Batal'
            });

            if (result.isConfirmed) {
                document.getElementById('visit-form').submit();
            }
        }
    </script>
@endpush
