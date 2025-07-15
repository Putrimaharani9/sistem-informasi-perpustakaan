@extends('template')

@section('content')
    <div class="container-fluid">
        @include('partials.alert')

        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <div>
                <h1 class="h4 mb-0 text--black">{{ $pageTitle }}</h1>
            </div>
        </div>

        <form method="POST" action={{ route('profile.update') }} enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card p-4">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Masukkan Nama" name="name" value="{{ $user->name ?? '' }}">

                    @error('name')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                        placeholder="Masukkan Email" name="email" value="{{ $user->email ?? '' }}">

                    @error('email')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone_number">Nomor Telepon</label>
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                        placeholder="Masukkan Nomor Telepon" name="phone_number" value="{{ $user->phone_number ?? '' }}">

                    @error('phone_number')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="profile_picture">Foto</label>
                    <div class="d-flex flex-column" style="gap: 10px;">
                        <img src="{{ getProfilePicture() }}" id="profile_picture-preview" alt=""
                            style="width: 150px; aspect-ratio: 2/3; border: 1px solid black; object-fit: cover">

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

        <hr>

        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <div>
                <h1 class="h4 mb-0 text--black">Ubah Kata Sandi</h1>
            </div>
        </div>

        <form method="POST" action="{{ route('profile.update-password') }}">
            @method('PUT')
            @csrf
            <div class="card p-4">
                <div class="form-group">
                    <label for="current_password">Kata Sandi Sekarang</label>
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                        id="current_password" placeholder="Masukkan Kata Sandi Sekarang" name="current_password">

                    @error('current_password')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="new_password">Kata Sandi Baru</label>
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                        id="new_password" placeholder="Masukkan Kata Sandi Baru" name="new_password">

                    @error('new_password')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="repeat_new_password">Ulangi</label>
                    <input type="password" class="form-control @error('repeat_new_password') is-invalid @enderror"
                        id="repeat_new_password" placeholder="Ulangi Kata Sandi Baru" name="repeat_new_password">

                    @error('repeat_new_password')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
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
