@extends('template')
@section('title', $pageTitle)

@section('content')
    <div class="container-fluid">
        @include('partials.alert')

        <div class="d-flex flex-column">
            <h1 class="h4 mb-0 text--black">{{ $pageTitle }}</h1>
            <p class="text--black">Harap isi attribut yang diperlukan.</p>
        </div>

        <form method="POST" class="card p-4" action={{ route('settings.update', $setting->id) }}>
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control id="name" placeholder="Nama" name="title"
                    value="{{ $setting->name }}" readonly>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea name="description" id="description" class="form-control" readonly>{{ $setting->description ?? '' }}</textarea>
            </div>

            <div class="form-group">
                <label for="default_value">Nilai Default</label>
                <input type="text"" class="form-control id="default_value" name="default_value"
                    placeholder="Nilai Default" value="{{ $setting->default_value ?? '' }}" readonly>
            </div>

            <div class="form-group">
                <label for="value">Nilai Sekarang</label>
                <input type="text"" class="form-control id="value" name="value" placeholder="Nilai Sekarang"
                    value="{{ $setting->value ?? '' }}">
            </div>

            <div class="d-flex justify-content-between mt-4">
                <button type="button" onClick="onReset()" class="btn btn-danger me-auto">Reset</button>

                <div class="d-flex">
                    <a href="../" class="btn btn-secondary mr-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</a>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        const onReset = async () => {
            const {
                isConfirmed
            } = await Swal.fire({
                title: 'Apakah Anda yakin untuk mereset data ini?',
                text: 'Data yang sudah direset tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
            })
            if (!isConfirmed) return;

            $('[name="value"]').val($('[name="default_value"]').val());
        }
    </script>
@endpush
