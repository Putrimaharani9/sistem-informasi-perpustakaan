@extends('template')
@section('title', "Edit Kategori Buku - $data->name")

@php
    $roles = App\Models\UserRole::all();
@endphp

@section('content')
    <div class="container-fluid">
        @include('partials.alert')

        <div class="d-sm-flex align-items-center justify-content-between">
            <div>
                <h1 class="h4 mb-0 text--black">Edit Kategori Buku</h1>
                <p class="text--black">Harap isi data yang diperlukan.</p>
            </div>
        </div>

        <form method="POST" action={{ route('staffs.update', $data->id) }} enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card p-4">
                <div class="form-group">
                    <label for="role_id">Peran</label>
                    <select class="form-control  @error('role_id') is-invalid @enderror" id="role_id" name="role_id"
                        value="{{ $data->role_id ?? '' }}">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ $role->id === $data->role_id ? 'selected' : '' }}>
                                {{ $role->name }}</option>
                        @endforeach
                    </select>

                    @error('role_id')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Masukkan Nama" name="name" value="{{ $data->name ?? '' }}">

                    @error('name')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="email"
                        placeholder="Masukkan Email" name="email" value="{{ $data->name ?? '' }}">

                    @error('email')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone_number">Nomor Telepon</label>
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                        placeholder="Masukkan Nomor Telepon" name="phone_number" value="{{ $data->phone_number ?? '' }}">

                    @error('phone_number')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input type="text" class="form-control @error('password') is-invalid @enderror" id="password"
                        placeholder="Masukkan Kata Sandi" name="password" value="{{ $data->password ?? 'password0101' }}">

                    @error('password')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="profile_picture">Foto</label>
                    <div class="d-flex flex-column" style="gap: 10px;">
                        <img src="{{ $data->profile_picture ? '/storage/' . $data->profile_picture : '' }}"
                            id="profile_picture-preview" alt=""
                            style="width: 150px; aspect-ratio: 2/3; border: 1px solid black;">

                        <input type="file" class="form-control @error('profile_picture') is-invalid @enderror"
                            id="profile_picture" name="profile_picture" onChange="onChangeProfilePicture(event)">
                    </div>

                    @error('profile_picture')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="/book-categories" class="btn btn-secondary mr-2">Kembali</a>
                <button type="submit" class="btn btn-primary">Buat</a>
            </div>
        </form>
    </div>

    <script>
        const onChangeProfilePicture = (event) => {
            const previewImageElement = document.getElementById('profile_picture-preview');
            previewImageElement.setAttribute('src', URL.createObjectURL(event.target.files[0]));
            previewImageElement.style.display = 'block';
        }
    </script>
@endsection
