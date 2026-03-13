@extends('layout.Admin')

@section('content')
    <div class="container-fluid mt-3">

        <!-- Header -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Statistik -->
        <div class="row">

            <!-- Visitor Hari Ini -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Visitor Hari Ini
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $visitorToday }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visitor Bulan Ini -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Visitor Bulan Ini
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $visitorMonth }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Visitor -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Total Visitor
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $visitorCount }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pesan -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pesan Masuk
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $messageCount }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-envelope fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- Grafik -->
        <div class="row">
            <div class="col-lg-8">

                <div class="card shadow mb-4">

                    <div class="card-header py-3 d-flex justify-content-between">

                        <h6 class="m-0 font-weight-bold text-primary">
                            Grafik Kunjungan
                        </h6>

                        <div class="d-flex gap-2">

                            <select id="monthSelect" class="form-select form-select-sm w-auto">
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}" {{ $m == $selectedMonth ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month((int) $m)->translatedFormat('F') }}
                                    </option>
                                @endfor
                            </select>

                            <select id="yearSelect" class="form-select form-select-sm w-auto">
                                @for ($y = now()->year - 5; $y <= now()->year + 1; $y++)
                                    <option value="{{ $y }}" {{ $y == $selectedYear ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endfor
                            </select>

                        </div>

                    </div>

                    <div class="card-body">
                        <div style="height:350px;">
                            <canvas id="visitorChart"></canvas>
                        </div>
                    </div>

                </div>

            </div>


            <!-- Berita Terbaru -->
            <div class="col-lg-4">

                <div class="card shadow mb-4">

                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Berita Terbaru
                        </h6>
                    </div>

                    <div class="card-body">

                        @forelse($latestNews as $news)
                            <div class="border-bottom pb-2 mb-2">

                                <div class="small text-gray-500">
                                    {{ $news->created_at->format('d M Y') }}
                                </div>

                                <div class="font-weight-bold">
                                    {{ $news->title }}
                                </div>

                            </div>

                        @empty

                            <p class="text-muted">Belum ada berita</p>
                        @endforelse

                    </div>
                </div>

                <!-- Kalender -->
                <div class="card shadow mb-4">

                    <div class="card-header py-3 d-flex justify-content-between align-items-center">

                        <h6 class="m-0 font-weight-bold text-primary">
                            Kalender
                        </h6>

                        <div class="d-flex gap-2">

                            <select id="calendarMonth" class="form-select form-select-sm">
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}">
                                        {{ \Carbon\Carbon::create()->month((int) $m)->translatedFormat('F') }}
                                    </option>
                                @endfor
                            </select>

                            <select id="calendarYear" class="form-select form-select-sm">
                                @for ($y = now()->year - 5; $y <= now()->year + 5; $y++)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>

                        </div>

                    </div>

                    <div class="card-body">

                        <div id="miniCalendar"></div>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const canvas = document.getElementById('visitorChart');

            if (!canvas) return;

            const ctx = canvas.getContext('2d');

            // ===============================
            // Data dari Laravel
            // ===============================
            const labels = Array.from({
                length: {{ $daysInMonth }}
            }, (_, i) => i + 1);

            const counts = {!! json_encode(array_values($visitors)) !!};

            // ===============================
            // Gradient warna grafik
            // ===============================
            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, "rgba(54,162,235,0.4)");
            gradient.addColorStop(1, "rgba(54,162,235,0.02)");

            // ===============================
            // Chart
            // ===============================
            const visitorChart = new Chart(ctx, {

                type: 'line',

                data: {

                    labels: labels,

                    datasets: [{
                        label: "Visitor",
                        data: counts,
                        borderColor: "#36A2EB",
                        backgroundColor: gradient,
                        fill: true,
                        tension: 0.45,
                        borderWidth: 3,
                        pointRadius: 3,
                        pointHoverRadius: 7,
                        pointBackgroundColor: "#36A2EB",
                        pointHoverBackgroundColor: "#ffffff",
                        pointBorderColor: "#ffffff",
                        pointHoverBorderColor: "#36A2EB"
                    }]

                },

                options: {

                    responsive: true,
                    maintainAspectRatio: false,

                    plugins: {

                        legend: {
                            display: false
                        },

                        tooltip: {
                            backgroundColor: "#111",
                            padding: 10,
                            cornerRadius: 6
                        },

                        title: {
                            display: true,
                            text: "Trend Pengunjung {{ \Carbon\Carbon::create()->month($selectedMonth)->translatedFormat('F') }} {{ $selectedYear }}",
                            font: {
                                size: 18,
                                weight: "bold"
                            }
                        }

                    },

                    scales: {

                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: "#6c757d"
                            }
                        },

                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0,
                                color: "#6c757d"
                            },
                            grid: {
                                borderDash: [4, 4]
                            }
                        }

                    }

                }

            });


            // ===============================
            // Filter Bulan & Tahun
            // ===============================

            const monthSelect = document.getElementById('monthSelect');
            const yearSelect = document.getElementById('yearSelect');

            function reloadChart() {

                let month = monthSelect.value;
                let year = yearSelect.value;

                let url = new URL(window.location.href);

                url.searchParams.set('month', month);
                url.searchParams.set('year', year);

                window.location.href = url.toString();
            }

            if (monthSelect) {
                monthSelect.addEventListener('change', reloadChart);
            }

            if (yearSelect) {
                yearSelect.addEventListener('change', reloadChart);
            }

        });
    </script>

    <script>
        function generateCalendar(month, year) {

            const calendar = document.getElementById("miniCalendar");

            const today = new Date();

            month = parseInt(month);
            year = parseInt(year);

            const firstDay = new Date(year, month - 1, 1).getDay();
            const daysInMonth = new Date(year, month, 0).getDate();

            let html = `
        <div class="calendar-grid">

            <div class="calendar-day">M</div>
            <div class="calendar-day">S</div>
            <div class="calendar-day">S</div>
            <div class="calendar-day">R</div>
            <div class="calendar-day">K</div>
            <div class="calendar-day">J</div>
            <div class="calendar-day">S</div>
    `;

            for (let i = 0; i < firstDay; i++) {
                html += "<div></div>";
            }

            for (let d = 1; d <= daysInMonth; d++) {

                let isToday =
                    d === today.getDate() &&
                    month === (today.getMonth() + 1) &&
                    year === today.getFullYear();

                let className = isToday ? "calendar-today" : "calendar-date";

                html += `<div class="${className}">${d}</div>`;
            }

            html += "</div>";

            calendar.innerHTML = html;
        }


        // set default bulan dan tahun
        const monthSelect = document.getElementById("calendarMonth");
        const yearSelect = document.getElementById("calendarYear");

        const now = new Date();

        monthSelect.value = now.getMonth() + 1;
        yearSelect.value = now.getFullYear();

        generateCalendar(monthSelect.value, yearSelect.value);


        // ketika diganti
        monthSelect.addEventListener("change", function() {
            generateCalendar(this.value, yearSelect.value);
        });

        yearSelect.addEventListener("change", function() {
            generateCalendar(monthSelect.value, this.value);
        });
    </script>
@endpush
