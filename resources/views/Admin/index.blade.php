@extends('layout.Admin')

@section('content')
    <div class="container-fluid mt-3">

        <!-- Header -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Statistik -->
        <div class="row">

            <!-- Pengunjung -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Pengunjung
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
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
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

            <!-- Berita -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Berita
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $newsCount }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Placeholder -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Aktivitas Lain
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    -
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- Grafik -->
        <div class="row">
            <div class="col-12">

                <div class="card shadow mb-4">

                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Grafik Kunjungan
                        </h6>
                    </div>

                    <div class="card-body">

                        <div style="height:350px;">
                            <canvas id="visitorChart"></canvas>
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {

    const ctx = document.getElementById('visitorChart');

    const daysInMonth = {{ $daysInMonth }};
    const visitorRaw = {!! json_encode($visitorRaw) !!};

    let labels = [];
    let counts = [];
    let colors = [];
    let borderColors = [];

    // Warna variasi
    const colorList = [
        '#4e73df','#1cc88a','#36b9cc','#f6c23e',
        '#e74a3b','#858796','#5a5c69','#20c997',
        '#6610f2','#fd7e14','#0dcaf0','#198754'
    ];

    // Generate data 1 bulan
    for (let i = 1; i <= daysInMonth; i++) {

        labels.push(i);

        let dateKey =
        "{{ \Carbon\Carbon::now()->format('Y-m') }}-" +
        String(i).padStart(2,'0');

        let value = visitorRaw[dateKey] ?? 0;

        counts.push(value);

        // Pilih warna beda tiap tanggal
        let color = value > 0
            ? colorList[i % colorList.length]
            : '#eeeeee';

        colors.push(color);
        borderColors.push(color);
    }


    new Chart(ctx, {

        type: 'bar',

        data: {

            labels: labels,

            datasets: [{

                label: 'Kunjungan Bulan Ini',

                data: counts,

                backgroundColor: colors,

                borderColor: borderColors,

                borderWidth: 1,

                borderRadius: 6,

                barThickness: 14

            }]

        },

        options: {

            responsive: true,
            maintainAspectRatio: false,

            plugins: {

                legend: {
                    display: false
                },

                title: {
                    display: true,
                    text: 'Kalender Kunjungan Bulan Ini',
                    font: {
                        size: 18
                    }
                }

            },

            scales: {

                x: {
                    grid:{
                        display:false
                    },
                    title:{
                        display:true,
                        text:'Tanggal'
                    }
                },

                y:{
                    beginAtZero:true,
                    ticks:{
                        precision:0
                    },
                    title:{
                        display:true,
                        text:'Jumlah Pengunjung'
                    }
                }

            }

        }

    });

});
</script>
@endsection
