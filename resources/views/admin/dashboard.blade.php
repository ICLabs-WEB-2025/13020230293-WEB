@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('styles')
<style>
    .info-card {
        border-left: 5px solid var(--admin-primary-color);
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        border-radius: .5rem;
        background-color: white;
    }
    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15)!important;
    }
    .info-card .card-body { padding: 1.5rem; }
    .info-card .card-title { font-weight: 500; color: #6c757d; text-transform: uppercase; font-size: 0.9rem; }
    .info-card .card-text-value { font-size: 2rem; font-weight: 700; }
    .info-card .icon { font-size: 2.5rem; opacity: 0.3; }

    .info-card.card-comments .card-text-value, .info-card.card-comments .icon { color: var(--admin-primary-color); }
    .info-card.card-new-comments { border-left-color: #ffc107; }
    .info-card.card-new-comments .card-text-value, .info-card.card-new-comments .icon { color: #ffc107; }

    .chart-card .card-header, .performance-card .card-header {
        background-color: #f8f9fa; /* Latar belakang header kartu chart */
        border-bottom: 1px solid #dee2e6;
    }
    .chart-card h5, .performance-card h5 {
        font-weight: 600;
        color: #333;
    }
</style>
@endsection

@section('content')

{{-- Baris untuk Info Cards (Sekarang hanya 2 kartu) --}}
<div class="row g-4 mb-4">
    {{-- Total Komentar Card --}}
    <div class="col-lg-6 col-md-6">
        <div class="card shadow-sm info-card card-comments">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-2">Total Komentar</h5>
                    <p class="card-text-value mb-0">{{ $totalComments }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-comments"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Komentar Baru (7 Hari) Card --}}
    <div class="col-lg-6 col-md-6">
        <div class="card shadow-sm info-card card-new-comments">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-2">Komentar Baru (7hr)</h5>
                    <p class="card-text-value mb-0">{{ $newComments }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-comment-medical"></i>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Baris untuk Chart Utama --}}
<div class="row g-4">
    {{-- Chart Aktivitas Komentar (Line Chart) --}}
    <div class="col-lg-7"> {{-- Chart ini mengambil porsi lebih besar --}}
        <div class="card shadow-sm chart-card">
            <div class="card-header">
                <h5 class="mb-0">Aktivitas Komentar (7 Hari Terakhir)</h5>
            </div>
            <div class="card-body">
                <canvas id="commentsLineChart" style="max-height: 320px;"></canvas>
            </div>
        </div>
    </div>

    {{-- Chart Performa Komentar Bulanan (Horizontal Bar Chart) --}}
    <div class="col-lg-5"> {{-- Chart ini di sampingnya --}}
        <div class="card shadow-sm performance-card">
            <div class="card-header">
                <h5 class="mb-0">Performa Komentar per Bulan</h5>
            </div>
            <div class="card-body">
                @if($barChartMonthlyLabels->count() > 0)
                <canvas id="monthlyCommentsBarChart" style="max-height: 320px;"></canvas>
                @else
                <p class="text-muted text-center mb-0">Belum ada data komentar bulanan yang cukup.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const lineCtx = document.getElementById('commentsLineChart')?.getContext('2d');
        if (lineCtx) {
            const lineChartLabels = @json($lineChartLabels);
            const lineChartData = @json($lineChartData);
            new Chart(lineCtx, {
                type: 'line',
                data: {
                    labels: lineChartLabels,
                    datasets: [{
                        label: 'Jumlah Komentar',
                        data: lineChartData,
                        borderColor: 'var(--admin-primary-color)',
                        backgroundColor: 'rgba(88, 135, 178, 0.1)',
                        fill: true,
                        tension: 0.3,
                        pointBackgroundColor: 'var(--admin-primary-color)',
                        pointBorderColor: '#fff',
                        pointHoverRadius: 7,
                        pointHoverBackgroundColor: 'var(--admin-primary-color)',
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }, plugins: { legend: { display: true, position: 'bottom' } } }
            });
        }

        // Horizontal Bar Chart
        const barCtx = document.getElementById('monthlyCommentsBarChart')?.getContext('2d');
        if (barCtx) {
            const barChartMonthlyLabels = @json($barChartMonthlyLabels);
            const barChartMonthlyData = @json($barChartMonthlyData);
            new Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: barChartMonthlyLabels,
                    datasets: [{
                        label: 'Jumlah Komentar',
                        data: barChartMonthlyData,
                        backgroundColor: barChartMonthlyData.map(() => `rgba(88, 135, 178, ${Math.random() * (0.8 - 0.4) + 0.4})`), // Warna biru dengan variasi opacity
                        borderColor: 'var(--admin-primary-color)',
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { x: { beginAtZero: true, ticks: { precision: 0 } } },
                    plugins: { legend: { display: false } }
                }
            });
        }
    });
</script>
@endpush
