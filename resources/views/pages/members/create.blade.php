@extends('template')
@section('title', 'Tambah Anggota')


@section('content')
    <div class="container-fluid">
        @include('partials.alert')

        <div>
            <h1 class="h4 mb-0 text--black">Tambah Anggota</h1>
            <p class="text--black">Harap isi data yang diperlukan.</p>
        </div>

        <form method="POST" action="{{ route('members.store') }}">
            @csrf
            <div class="card p-4">
                <div class="form-group">
                    <label for="id_anggota">ID Anggota</label>
                    <input type="text" class="form-control @error('id_anggota') is-invalid @enderror" id="id_anggota"
                        name="id_anggota" value="{{ old('id_anggota') }}" placeholder="Masukkan ID Anggota">
                    @error('id_anggota')
                        <div class="d-block invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                        name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama">
                    @error('nama')
                        <div class="d-block invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $member->email ?? '') }}">
                </div>


                <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik"
                        name="nik" value="{{ old('nik') }}" placeholder="Masukkan NIK">
                    @error('nik')
                        <div class="d-block invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                        name="alamat" value="{{ old('alamat') }}" placeholder="Masukkan Alamat">
                    @error('alamat')
                        <div class="d-block invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nomor_telepon">Nomor Telepon</label>
                    <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomor_telepon"
                        name="nomor_telepon" value="{{ old('nomor_telepon') }}" placeholder="Masukkan Nomor Telepon">
                    @error('nomor_telepon')
                        <div class="d-block invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status_anggota">Status Anggota</label>
                    <select name="status_anggota" id="status_anggota"
                        class="form-control @error('status_anggota') is-invalid @enderror">
                        <option value="">-- Pilih Status --</option>
                        <option value="ASN" {{ old('status_anggota') == 'ASN' ? 'selected' : '' }}>ASN</option>
                        <option value="Non ASN" {{ old('status_anggota') == 'Non ASN' ? 'selected' : '' }}>Non ASN</option>
                    </select>
                    @error('status_anggota')
                        <div class="d-block invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="/members" class="btn btn-secondary mr-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>

