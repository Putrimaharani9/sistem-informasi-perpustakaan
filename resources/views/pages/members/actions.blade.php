<div class="dropdown">
    <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
            <path d="M5 10C3.9 10 3 10.9 3 12C3 13.1 3.9 14 5 14C6.1 14 7 13.1 7 12C7 10.9 6.1 10 5 10ZM19 10C17.9 10 17 10.9 17 12C17 13.1 17.9 14 19 14C20.1 14 21 13.1 21 12C21 10.9 20.1 10 19 10ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"/>
        </svg>
    </button>

    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ route('members.show', $member->id_anggota) }}">Lihat</a>
        <a class="dropdown-item" href="{{ route('members.edit', $member->id_anggota) }}">Ubah</a>

        <form method="POST" action="{{ route('members.destroy', $member->id_anggota) }}" onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="dropdown-item text-danger">Hapus</button>
        </form>
    </div>
</div>
