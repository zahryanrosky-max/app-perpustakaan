<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Anggota</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        th { background: #f4f4f4; }
        .alert { padding: 10px; background: #dcfce7; color: #166534; margin-bottom: 15px; border-radius: 4px; }
        .btn { display: inline-block; padding: 6px 12px; background: #2563eb; color: #fff; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; }
        .btn-danger { background: #dc2626; }
        .search-box { margin-top: 15px; display: flex; gap: 8px; }
        .search-box input { padding: 6px 10px; width: 250px; }
        .pagination-box { margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Daftar Anggota</h1>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <p><a href="{{ route('members.create') }}" class="btn">+ Tambah Anggota</a></p>

    <form method="GET" action="{{ route('members.index') }}" class="search-box">
        <input type="text" name="search" placeholder="Cari nama anggota..." value="{{ request('search') }}">
        <button type="submit" class="btn">Cari</button>
        @if(request('search'))
            <a href="{{ route('members.index') }}" style="align-self: center; margin-left: 5px;">Reset</a>
        @endif
    </form>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($members as $index => $member)
                <tr>
                    <td>{{ $members->firstItem() + $index }}</td>
                    <td>{{ $member['nim'] }}</td>
                    <td>{{ $member['nama'] }}</td>
                    <td>{{ $member['email'] }}</td>
                    <td>{{ $member['nomor_telepon'] }}</td>
                    <td>
                        <span style="font-weight: bold; color: {{ $member['status'] === 'aktif' ? '#166534' : '#991b1b' }}">
                            {{ ucfirst($member['status']) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('members.show', $member['id']) }}">Detail</a> |
                        <a href="{{ route('members.edit', $member['id']) }}">Edit</a> |
                        <form action="{{ route('members.destroy', $member['id']) }}" method="POST" style="display: inline;" onsubmit="return confirm('Hapus anggota ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #dc2626; cursor: pointer; padding: 0; text-decoration: underline;">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data anggota ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination-box">
        {{ $members->appends(request()->query())->links() }}
    </div>
</body>
</html>