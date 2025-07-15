@extends('template')
@section('title', "Lihat Staff - $data->name")

@section('content')
    <div class="container-fluid">
        @include('partials.alert')

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text--black">Detail Staff</h1>

            <a href="{{ route('staffs.edit', $data->id) }}" class="btn btn-primary">Edit</a>
        </div>

        <form>
            <div class="card p-4">
                <div class="form-group">
                    <label for="role_id">Peran</label>
                    <input readonly type="text" class="form-control" value="{{ $data->role->name }}">
                </div>

                <div class="form-group">
                    <label for="name">Nama</label>
                    <input readonly type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Masukkan Nama" name="name" value="{{ $data->name ?? '' }}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input readonly type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                        placeholder="Masukkan Email" name="email" value="{{ $data->email ?? '' }}">
                </div>

                <div class="form-group">
                    <label for="phone_number">Nomor Telepon</label>
                    <input readonly type="text" class="form-control @error('phone_number') is-invalid @enderror"
                        id="phone_number" placeholder="Masukkan Nomor Telepon" name="phone_number"
                        value="{{ $data->phone_number ?? '' }}">
                </div>

                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input readonly type="text" class="form-control @error('password') is-invalid @enderror"
                        id="password" placeholder="Masukkan Kata Sandi" name="password"
                        value="{{ $data->password ?? 'password0101' }}">
                </div>

                <div class="form-group">
                    <label for="profile_picture">Foto</label>
                    <div>
                        <img src="{{ $data->profile_picture ? '/storage/' . $data->profile_picture : '' }}"
                            id="profile_picture-preview" alt=""
                            style="width: 150px; aspect-ratio: 2/3; border: 1px solid black;">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
