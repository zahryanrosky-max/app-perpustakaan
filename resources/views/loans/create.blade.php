@extends('layouts.app')

@section('content')
    <h1>Tambah Transaksi Peminjaman</h1>

    @if ($errors->any())
        <div style="background: #fee2e2; color: #b91c1c; padding: 12px 16px; border-radius: 4px; margin-bottom: 16px;">
            <strong>Terjadi kesalahan input:</strong>
            <ul style="margin: 8px 0 0 20px; padding: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('loans.store') }}" method="POST" style="max-width: 520px; background: #fff; padding: 20px; border-radius: 6px; border: 1px solid #e2e8f0;">
        @csrf

        <p style="margin-top: 0; background: #f1f5f9; padding: 10px 12px; border-radius: 4px;">
            <em>Petugas pencatat: <strong>{{ auth()->user()->name }}</strong> (otomatis dari akun yang login).</em>
        </p>

        <div style="margin-bottom: 14px;">
            <label for="member_id" style="display: block; font-weight: bold; margin-bottom: 4px;">Anggota Peminjam</label>
            <select name="member_id" id="member_id" style="width: 100%; padding: 8px; box-sizing: border-box;">
                <option value="">-- Pilih Anggota --</option>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                        {{ $member->nama ?? $member->name }}
                    </option>
                @endforeach
            </select>
            @error('member_id')
                <div style="color: #b91c1c; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 14px;">
            <label for="tanggal_pinjam" style="display: block; font-weight: bold; margin-bottom: 4px;">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" style="width: 100%; padding: 8px; box-sizing: border-box;">
            @error('tanggal_pinjam')
                <div style="color: #b91c1c; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 14px;">
            <label for="tanggal_kembali" style="display: block; font-weight: bold; margin-bottom: 4px;">Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" id="tanggal_kembali" value="{{ old('tanggal_kembali', date('Y-m-d', strtotime('+7 days'))) }}" style="width: 100%; padding: 8px; box-sizing: border-box;">
            @error('tanggal_kembali')
                <div style="color: #b91c1c; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display: block; font-weight: bold; margin-bottom: 6px;">Pilih Buku yang Dipinjam (minimal 1)</label>
            <div style="border: 1px solid #cbd5e1; padding: 10px; border-radius: 4px; max-height: 200px; overflow-y: auto;">
                @foreach ($books as $book)
                    <div style="margin-bottom: 6px;">
                        <label style="font-weight: normal; cursor: pointer;">
                            <input type="checkbox" name="book_ids[]" value="{{ $book->id }}" {{ is_array(old('book_ids')) && in_array($book->id, old('book_ids')) ? 'checked' : '' }}>
                            {{ $book->judul ?? $book->title }}
                        </label>
                    </div>
                @endforeach
            </div>
            @error('book_ids')
                <div style="color: #b91c1c; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" style="background: #2563eb; color: #fff; border: none; padding: 10px 16px; border-radius: 4px; cursor: pointer;">
                Simpan Peminjaman
            </button>
            <a href="{{ route('loans.index') }}" style="padding: 10px 16px; border: 1px solid #cbd5e1; border-radius: 4px; text-decoration: none; color: #334155;">
                Batal
            </a>
        </div>
    </form>
@endsection