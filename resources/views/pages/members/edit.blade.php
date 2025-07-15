@extends('template')
@section('title', "Edit Anggota - $data->name")

@section('content')
    <div class="container-fluid">
        @include('partials.alert')

        <div class="d-sm-flex align-items-center justify-content-between">
            <div>
                <h1 class="h4 mb-0 text--black">Edit Anggota</h1>
                <p class="text--black">Harap isi data yang diperlukan.</p>
            </div>
        </div>

        <form method="POST" action={{ route('members.update', $data->id) }} enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card p-4">
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
                    <label for="address">Alamat</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                        placeholder="Masukkan Alamat" name="address" value="{{ $data->address ?? '' }}">

                    @error('address')
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
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        placeholder="Masukkan Email" name="email" value="{{ $data->email ?? '' }}">

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
                <a href="/members/" class="btn btn-secondary mr-2">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</a>
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
