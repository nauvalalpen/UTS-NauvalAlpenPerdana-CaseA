@extends('layouts.app')

@section('title', 'Tambah Donasi Baru')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tambah Donasi Baru</h1>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('donasi.store') }}" method="POST">
                    @csrf {{-- CSRF Token --}}

                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label for="nama_donatur" class="form-label">Nama Donatur <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_donatur') is-invalid @enderror"
                                id="nama_donatur" name="nama_donatur" value="{{ old('nama_donatur') }}" required>
                            @error('nama_donatur')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="nominal" class="form-label">Nominal Donasi <span
                                    class="text-danger">*</span></label>
                            <div class="input-group @error('nominal') has-validation @enderror"> {{-- Add has-validation for proper feedback placement --}}
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control @error('nominal') is-invalid @enderror"
                                    id="nominal" name="nominal" value="{{ old('nominal') }}" required min="1000">
                                @error('nominal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="metode_pembayaran" class="form-label">Metode Pembayaran <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('metode_pembayaran') is-invalid @enderror"
                                id="metode_pembayaran" name="metode_pembayaran" value="{{ old('metode_pembayaran') }}"
                                required placeholder="Contoh: Transfer Bank BNI">
                            @error('metode_pembayaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tanggal_donasi" class="form-label">Tanggal Donasi <span
                                    class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_donasi') is-invalid @enderror"
                                id="tanggal_donasi" name="tanggal_donasi" value="{{ old('tanggal_donasi', date('Y-m-d')) }}"
                                required> {{-- Default to today --}}
                            @error('tanggal_donasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status"
                                required>
                                <option value="menunggu konfirmasi"
                                    {{ old('status', 'menunggu konfirmasi') == 'menunggu konfirmasi' ? 'selected' : '' }}>
                                    Menunggu Konfirmasi</option>
                                <option value="dikonfirmasi" {{ old('status') == 'dikonfirmasi' ? 'selected' : '' }}>
                                    Dikonfirmasi</option>
                                <option value="batal" {{ old('status') == 'batal' ? 'selected' : '' }}>Batal</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Simpan Donasi</button>
                        <a href="{{ route('donasi.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
