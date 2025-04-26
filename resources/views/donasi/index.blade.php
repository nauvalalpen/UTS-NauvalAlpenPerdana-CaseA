@extends('layouts.app') {{-- Use the main layout --}}

@section('title', 'Daftar Donasi') {{-- Page Title --}}

@section('content')
    <div class="container">
        <h1 class="mb-4">Daftar Donasi</h1>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('donasi.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Tambah Donasi Baru
            </a>
            <a href="{{ route('donasi.deleted') }}" class="btn btn-outline-secondary">
                <i class="bi bi-archive me-1"></i> Lihat Riwayat Dihapus
            </a>
        </div>

        {{-- Display success message if exists --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Responsive Table --}}
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-striped table-bordered table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center" width="60">No</th>
                        <th>Nama Donatur</th>
                        <th>Email</th>
                        <th>Nominal</th>
                        <th>Metode Pembayaran</th>
                        <th>Tgl Donasi</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($donasis as $index => $donasi)
                        {{-- Loop through donation data --}}
                        <tr>
                            <td class="text-center">{{ $index + $donasis->firstItem() }}</td>
                            <td>{{ $donasi->nama_donatur }}</td>
                            <td>{{ $donasi->email ?? '-' }}</td>
                            <td>Rp {{ number_format($donasi->nominal, 0, ',', '.') }}</td> {{-- Currency format --}}
                            <td>{{ $donasi->metode_pembayaran }}</td>
                            <td>{{ $donasi->tanggal_donasi->format('d M Y') }}</td> {{-- Date format --}}
                            <td class="text-center">
                                <span
                                    class="badge rounded-pill
                            @if ($donasi->status == 'dikonfirmasi') bg-success
                            @elseif($donasi->status == 'batal') bg-danger
                            @else bg-warning text-dark @endif">
                                    {{ ucwords($donasi->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('donasi.edit', $donasi->id) }}" class="btn btn-sm btn-warning"
                                        title="Edit">
                                        <i class="bi bi-pencil-fill"></i> Edit
                                    </a>
                                    {{-- Form for Delete button (Soft Delete) --}}
                                    <form action="{{ route('donasi.destroy', $donasi->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus donasi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="bi bi-trash-fill"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="bi bi-inbox text-muted" style="font-size: 2rem;"></i>
                                    <p class="mt-2 mb-0">Belum ada data donasi.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination with information --}}
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                Menampilkan {{ $donasis->firstItem() ?? 0 }} hingga {{ $donasis->lastItem() ?? 0 }} dari
                {{ $donasis->total() }} data
            </div>
            <div>
                {{ $donasis->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    {{-- Bootstrap Icons CSS --}}
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <style>
            /* Custom pagination styling */
            .pagination {
                margin-bottom: 0;
            }

            .page-item.active .page-link {
                background-color: #0d6efd;
                border-color: #0d6efd;
            }

            .page-link {
                color: #0d6efd;
            }

            .page-link:hover {
                color: #0a58ca;
            }

            /* Improve table appearance */
            .table {
                border-collapse: collapse;
                border: none;
            }

            .table-responsive {
                border: 1px solid rgba(0, 0, 0, .125);
            }

            /* Improve empty state */
            .bi-inbox {
                opacity: 0.5;
            }
        </style>
    @endpush

@endsection
