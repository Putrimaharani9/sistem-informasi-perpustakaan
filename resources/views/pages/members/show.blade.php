@extends('template')
@section('title', "Lihat Anggota - $data->name")

@section('content')
    <div class="container-fluid">
        @include('partials.alert')

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text--black">Detail Anggota</h1>

            <a href="{{ route('members.edit', $data->id) }}" class="btn btn-primary">Edit</a>
        </div>

        <form method="POST" action={{ route('members.store') }} enctype="multipart/form-data">
            @csrf
            <div class="card p-4">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input readonly type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Masukkan Nama" name="name" value="{{ $data->name ?? '' }}">

                    @error('name')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Alamat</label>
                    <input readonly type="text" class="form-control @error('address') is-invalid @enderror"
                        id="address" placeholder="Masukkan Alamat" name="address" value="{{ $data->address ?? '' }}">

                    @error('address')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone_number">Nomor Telepon</label>
                    <input readonly type="text" class="form-control @error('phone_number') is-invalid @enderror"
                        id="phone_number" placeholder="Masukkan Nomor Telepon" name="phone_number"
                        value="{{ $data->phone_number ?? '' }}">

                    @error('phone_number')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input readonly type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        placeholder="Masukkan Email" name="email" value="{{ $data->email ?? '' }}">

                    @error('email')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="profile_picture">Foto</label>
                    <div class="d-flex flex-column" style="gap: 10px;">
                        <img src="{{ $data->profile_picture ? '/storage/' . $data->profile_picture : '' }}" id="profile_picture-preview" alt=""
                            style="width: 150px; aspect-ratio: 2/3; border: 1px solid black;">
                    </div>

                    @error('profile_picture')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </form>
    </div>
@endsection
