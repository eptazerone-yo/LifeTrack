@extends('layouts.app')

@section('content')
<h3 class="mb-4 fw-bold">Dashboard</h3>

{{--  RINGKASAN ANGKA  --}}
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <small class="text-muted">Total Jadwal</small>
                <h4 class="fw-bold">{{ $totalSchedule }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <small class="text-muted">Total Pemasukan</small>
                <h4 class="fw-bold text-success">
                    Rp {{ number_format($totalIncome, 0, ',', '.') }}
                </h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <small class="text-muted">Total Pengeluaran</small>
                <h4 class="fw-bold text-danger">
                    Rp {{ number_format($totalExpense, 0, ',', '.') }}
                </h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <small class="text-muted">Total Wishlist</small>
                <h4 class="fw-bold">{{ $totalWishlist }}</h4>
            </div>
        </div>
    </div>
</div>

{{-- GRAFIK KEUANGAN--}}
<div class="card shadow-sm mb-4 border-0">
    <div class="card-body">
        <h5 class="fw-bold mb-3">Grafik Keuangan Bulanan</h5>
        <canvas id="financeChart" height="120"></canvas>
    </div>
</div>

{{-- ================= LIST BAWAH ================= --}}
<div class="row">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Upcoming Schedule</h6>
                <ul class="list-group list-group-flush">
                    @forelse($upcomingSchedules as $item)
                        <li class="list-group-item">
                            {{ $item->title }} <br>
                            <small class="text-muted">{{ $item->date }}</small>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Tidak ada jadwal</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Top Wishlist</h6>
                <ul class="list-group list-group-flush">
                    @forelse($priorityWishlist as $item)
                        <li class="list-group-item">
                            {{ $item->item_name }} <br>
                            <small class="text-muted">Priority: {{ ucfirst($item->priority) }}</small>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Tidak ada wishlist</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const financeData = @json($financeChart);

    const labels = financeData.map(item => item.month);
    const incomeData = financeData.map(item => item.income);
    const expenseData = financeData.map(item => item.expense);

    const ctx = document.getElementById('financeChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Pemasukan',
                    data: incomeData,
                },
                {
                    label: 'Pengeluaran',
                    data: expenseData,
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });
</script>
@endsection
