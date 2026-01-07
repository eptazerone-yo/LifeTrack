@extends('layouts.app')

@section('content')
<div class="container">

<h3 class="mb-4 fw-bold">Wishlist Saya</h3>

{{-- FLASH MESSAGE --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-3">
        <i class="bi bi-check-circle me-1"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@php
    $statusColors = [
        'ingin' => 'secondary',
        'ditunda' => 'warning',
        'dibeli' => 'success',
    ];
@endphp

{{-- SUMMARY --}}
<div class="row mb-3">
    <div class="col">
        <span class="badge bg-secondary">🕒 Ingin: {{ $wishlists->where('status','ingin')->count() }}</span>
        <span class="badge bg-warning text-dark">⏳ Ditunda: {{ $wishlists->where('status','ditunda')->count() }}</span>
        <span class="badge bg-success">✅ Dibeli: {{ $wishlists->where('status','dibeli')->count() }}</span>
    </div>
</div>

<a href="{{ route('wishlist.create') }}" class="btn btn-primary mb-4">
    <i class="bi bi-plus-circle"></i> Tambah Wishlist
</a>

@if($wishlists->isEmpty())
    {{-- EMPTY STATE --}}
    <div class="card shadow-sm">
        <div class="card-body text-center py-5">
            <lottie-player
                src="{{ asset('json/empty-wishlist.json') }}"
                background="transparent"
                speed="1"
                style="width:260px; height:260px; margin:auto;"
                loop autoplay>
            </lottie-player>

            <h5 class="mt-3 fw-semibold">Belum ada wishlist</h5>
            <p class="text-muted mb-3">Ayo, Tambahkan barang impianmu ✨</p>
            <a href="{{ route('wishlist.create') }}" class="btn btn-dark">
                Tambah Wishlist Pertama
            </a>
        </div>
    </div>
@else
    {{-- TABLE --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-bordered align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Item</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Prioritas</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($wishlists as $wishlist)
                    <tr>
                        <td>{{ $wishlist->item_name }}</td>
                        <td>Rp {{ number_format($wishlist->price,0,',','.') }}</td>
                        <td>
                            <span class="badge bg-{{ $statusColors[$wishlist->status] ?? 'secondary' }}">
                                {{ ucfirst($wishlist->status) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $wishlist->priority }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('wishlist.edit', $wishlist->id) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('wishlist.destroy', $wishlist->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus wishlist ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">
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
