@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="mb-4 fw-bold">Jadwal Saya</h3>

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
            'pending' => 'secondary',
            'ongoing' => 'warning',
            'done'    => 'success',
        ];
        $statusIcons = [
            'pending' => '⏳',
            'ongoing' => '🔄',
            'done'    => '✅',
        ];
    @endphp

    {{-- SUMMARY --}}
    <div class="row mb-3">
        <div class="col">
            <span class="badge bg-secondary">
                ⏳ Pending: {{ $schedules->where('status','pending')->count() }}
            </span>
            <span class="badge bg-warning text-dark">
                🔄 Ongoing: {{ $schedules->where('status','ongoing')->count() }}
            </span>
            <span class="badge bg-success">
                ✅ Done: {{ $schedules->where('status','done')->count() }}
            </span>
        </div>
    </div>

    <a href="{{ route('schedule.create') }}" class="btn btn-primary mb-4">
        <i class="bi bi-plus-circle"></i> Tambah Jadwal
    </a>

    @if($schedules->isEmpty())
        {{-- EMPTY STATE --}}
        <div class="card shadow-sm">
            <div class="card-body text-center py-5">
                <lottie-player
                    src="{{ asset('json/empty-schedule.json') }}"
                    background="transparent"
                    speed="1"
                    style="width:260px; height:260px; margin:auto;"
                    loop autoplay>
                </lottie-player>

                <h5 class="mt-3 fw-semibold">Belum ada jadwal</h5>
                <p class="text-muted mb-3">Mulai atur rencana harianmu ✨</p>
                <a href="{{ route('schedule.create') }}" class="btn btn-dark">
                    Tambah Jadwal Pertama
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
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Catatan</th>
                            <th>Prioritas</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schedules as $schedule)
                        <tr>
                            <td>{{ $schedule->title }}</td>
                            <td>{{ $schedule->date }}</td>
                            <td>{{ $schedule->time }}</td>
                            <td>
                                <span class="badge bg-{{ $statusColors[$schedule->status] }}">
                                    {{ $statusIcons[$schedule->status] }}
                                    {{ ucfirst($schedule->status) }}
                                </span>
                            </td>
                            <td>{{ $schedule->notes ?? '-' }}</td>
                            <td>
                                <span class="badge {{ 
                                    $schedule->priority == 'high' ? 'bg-danger' :
                                    ($schedule->priority == 'normal' ? 'bg-primary' : 'bg-secondary')
                                }}">
                                    {{ ucfirst($schedule->priority) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('schedule.edit', $schedule->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('schedule.destroy', $schedule->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
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
