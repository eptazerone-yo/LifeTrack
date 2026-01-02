@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4 fw-bold">Daftar Keuangan</h3>

    <a href="{{ route('finance.create') }}" class="btn btn-primary mb-4">
        <i class="bi bi-plus-circle"></i> Tambah Data Keuangan
    </a>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @php
        $totalIncome = $finances->where('type','income')->sum('amount');
        $totalExpense = $finances->where('type','expense')->sum('amount');
    @endphp

    @if($finances->isEmpty())
        {{-- EMPTY STATE --}}
        <div class="card shadow-sm">
            <div class="card-body text-center py-5">

                <lottie-player
                    src="{{ asset('json/empty-finance.json') }}"
                    background="transparent"
                    speed="1"
                    style="width:260px; height:260px; margin:auto;"
                    loop autoplay>
                </lottie-player>

                <h5 class="mt-3 fw-semibold">
                    Belum ada data keuangan
                </h5>

                <p class="text-muted mb-3">
                    Catat semua pemasukan dan pengeluaranmu agar lebih teratur 💰
                </p>

                <a href="{{ route('finance.create') }}" class="btn btn-dark">
                    Tambah Data Pertama
                </a>
            </div>
        </div>
    @else
        {{-- SUMMARY --}}
        <div class="row mb-3">
            <div class="col">
                <span class="badge bg-success me-2">
                    Pemasukan: Rp {{ number_format($totalIncome,0,',','.') }}
                </span>
                <span class="badge bg-danger">
                    Pengeluaran: Rp {{ number_format($totalExpense,0,',','.') }}
                </span>
            </div>
        </div>

        {{-- DATA TABLE --}}
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>Tipe</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Deskripsi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($finances as $finance)
                            <tr>
                                <td>{{ $finance->date }}</td>
                                <td>
                                    <span class="badge {{ $finance->type === 'income' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($finance->type) }}
                                    </span>
                                </td>
                                <td>{{ $finance->category }}</td>
                                <td>Rp {{ number_format($finance->amount, 0, ',', '.') }}</td>
                                <td>{{ $finance->description ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('finance.edit', $finance->id) }}"
                                    class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('finance.destroy', $finance->id) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
