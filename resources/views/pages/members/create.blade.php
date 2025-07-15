@extends('template')
@section('title', 'Tambah Anggota')


@section('content')
    <div class="container-fluid">
        @include('partials.alert')

        <div>
            <h1 class="h4 mb-0 text--black">Tambah Anggota</h1>
            <p class="text--black">Harap isi data yang diperlukan.</p>
        </div>

        <form method="POST" action={{ route('members.store') }} enctype="multipart/form-data">
            @csrf
            <div class="card p-4">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Masukkan Nama" name="name" value="{{ old('name') ?? '' }}">

                    @error('name')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Alamat</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                        placeholder="Masukkan Alamat" name="address" value="{{ old('address') ?? '' }}">

                    @error('address')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone_number">Nomor Telepon</label>
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                        placeholder="Masukkan Nomor Telepon" name="phone_number" value="{{ old('phone_number') ?? '' }}">

                    @error('phone_number')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        placeholder="Masukkan Email" name="email" value="{{ old('email') ?? '' }}">

                    @error('email')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        placeholder="Masukkan Password" name="password" value="{{ old('password') ?? '' }}">

                    @error('password')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="profile_picture">Foto</label>
                    <div class="d-flex flex-column" style="gap: 10px;">
                        <img src="https://placehold.co/600x400" id="profile_picture-preview" alt=""
                            style="width: 150px; aspect-ratio: 2/3; border: 1px solid black; display: none;">

                        <input type="file" class="form-control @error('profile_picture') is-invalid @enderror"
                            id="profile_picture" name="profile_picture"
                            onChange="onChangeProfilePicture(event)">
                    </div>

                    @error('profile_picture')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="/books" class="btn btn-secondary mr-2">Kembali</a>
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
