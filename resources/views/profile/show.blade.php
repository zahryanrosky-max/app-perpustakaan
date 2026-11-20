@extends('layouts.app')

@section('content')
    <h1>Profil Pengguna</h1>

    @if (session('success'))
        <div style="background: #d1fae5; color: #065f46; padding: 10px 14px; border-radius: 4px; margin-bottom: 16px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background: #fff; padding: 20px; border-radius: 6px; border: 1px solid #e2e8f0; margin-bottom: 24px; max-width: 500px;">
        <h2 style="margin-top: 0; font-size: 18px;">Informasi Akun</h2>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 8px 0; font-weight: bold; width: 120px;">Nama</td>
                <td style="padding: 8px 0;">: {{ $user->name }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Email</td>
                <td style="padding: 8px 0;">: {{ $user->email }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Role</td>
                <td style="padding: 8px 0;">: {{ ucfirst($user->role) }}</td>
            </tr>
        </table>
    </div>

    <div style="background: #fff; padding: 20px; border-radius: 6px; border: 1px solid #e2e8f0; max-width: 500px;">
        <h2 style="margin-top: 0; font-size: 18px;">Ganti Password</h2>

        <form action="{{ route('profile.password') }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 12px;">
                <label for="current_password" style="display: block; font-weight: bold; margin-bottom: 4px;">Password Lama</label>
                <input type="password" name="current_password" id="current_password" style="width: 100%; padding: 8px; box-sizing: border-box;">
                @error('current_password')
                    <div style="color: #b91c1c; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 12px;">
                <label for="password" style="display: block; font-weight: bold; margin-bottom: 4px;">Password Baru</label>
                <input type="password" name="password" id="password" style="width: 100%; padding: 8px; box-sizing: border-box;">
                @error('password')
                    <div style="color: #b91c1c; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="password_confirmation" style="display: block; font-weight: bold; margin-bottom: 4px;">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" id="password_confirmation" style="width: 100%; padding: 8px; box-sizing: border-box;">
            </div>

            <button type="submit" style="background: #2563eb; color: #fff; border: none; padding: 10px 16px; border-radius: 4px; cursor: pointer;">
                Simpan Password Baru
            </button>
        </form>
    </div>
@endsection