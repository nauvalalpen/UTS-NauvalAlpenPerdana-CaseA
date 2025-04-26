@extends('layouts.app')

@section('title', 'Riwayat Donasi Dihapus')

@section('content')
    <div class="container">
        <h1 class="mb-4">Riwayat Donasi Dihapus</h1>
        <div class="mb-3">
            <a href="{{ route('donasi.index') }}" class="btn btn-outline-secondary">← Kembali ke Daftar Donasi</a>
        </div>

        <div class="table-responsive shadow-sm">
            <table class="table table-striped table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Donatur</th>
                        <th>Email</th>
                        <th>Nominal</th>
                        <th>Tanggal Dihapus</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($deletedDonasis as $index => $donasi)
                        <tr>
                            <td>{{ $index + $deletedDonasis->firstItem() }}</td>
                            <td>{{ $donasi->nama_donatur }}</td>
                            <td>{{ $donasi->email ?? '-' }}</td>
                            <td>Rp {{ number_format($donasi->nominal, 0, ',', '.') }}</td>
                            <td>{{ $donasi->deleted_at ? $donasi->deleted_at->format('d M Y H:i:s') : '-' }}</td>
                            {{-- Display deletion timestamp --}}
                            <td>
                                {{-- Restore Button (using GET link or POST form) --}}
                                <a href="{{ route('donasi.restore', $donasi->id) }}" class="btn btn-sm btn-success me-1"
                                    onclick="return confirm('Pulihkan data donasi ini?')" title="Pulihkan"><i
                                        class="bi bi-arrow-counterclockwise"></i> Pulihkan</a>

                                {{-- Form for Permanent Delete --}}
                                <form action="{{ route('donasi.forceDelete', $donasi->id) }}" method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('PERINGATAN! Aksi ini akan menghapus data secara permanen dan tidak bisa dikembalikan. Lanjutkan?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus Permanen"><i
                                            class="bi bi-trash3-fill"></i> Hapus Permanen</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data donasi yang dihapus.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Display Pagination Links at Bottom Right --}}
        <div class="d-flex justify-content-end mt-3">
            {{ $deletedDonasis->links() }}
        </div>
    </div>

    {{-- Optional: Add Bootstrap Icons CSS if you use icons like above --}}
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    @endpush

@endsection
