@extends('template')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $pageTitle }}</h1>
        </div>

        <div class="row row-cols-5 no-gutters">
            <div class="card col">
                <div class="card-body">
                    <h5 class="card-title"> <i class="fa fa-users mr-2" aria-hidden="true"></i> Jumlah Anggota</h5>
                    <p class="card-text text-primary" style="font-size: 80px;">{{ $data->members_count ?? 0 }}</p>
                </div>
            </div>

            <div class="card col">
                <div class="card-body">
                    <h5 class="card-title"> <i class="fa fa-book mr-2" aria-hidden="true"></i> Jumlah Buku</h5>
                    <p class="card-text text-primary" style="font-size: 80px;">{{ $data->books_count ?? 0 }}</p>
                </div>
            </div>

            <div class="card col">
                <div class="card-body">
                    <h5 class="card-title"> <i class="fa fa-copy mr-2" aria-hidden="true"></i> Jumlah Salinan</h5>
                    <p class="card-text text-primary" style="font-size: 80px;">{{ $data->copies_count ?? 0 }}</p>
                </div>
            </div>

            <div class="card col">
                <div class="card-body">
                    <h5 class="card-title"> <i class="fa fa-lock mr-2" aria-hidden="true"></i> Jumlah Staff</h5>
                    <p class="card-text text-primary" style="font-size: 80px;">{{ $data->staffs_count ?? 0 }}</p>
                </div>
            </div>

            <div class="card col">
                <div class="card-body">
                    <h5 class="card-title"> <i class="fa fa-check mr-2" aria-hidden="true"></i> Kunjungan Hari Ini</h5>
                    <p class="card-text text-primary" style="font-size: 80px;">{{ $data->visits_count ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="row row-cols-2">
            <div class="col card no-gutters mt-3" style="width=100%;">
                <div class="card-body">
                    <h5 class="card-title">Kunjungan Bulan Ini</h5>
                    <canvas id="visit_chart"></canvas>
                </div>
            </div>

            <div class="col card no-gutters mt-3" style="width=100%;">
                <div class="card-body">
                    <h5 class="card-title">Peminjaman Buku Bulan Ini</h5>
                    <canvas id="loan_chart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="vendor/chart.js/Chart.min.js"></script>

    <script>
        /**
         * Loan chart
         **/
        const loanContext = document.getElementById('loan_chart').getContext('2d');
        const loanBarChart = new Chart(loanContext, {
            type: 'bar',
            data: {
                labels: @json($data->loan_labels ?? []),
                datasets: [{
                    label: 'Peminjaman',
                    data: @json($data->loan_data ?? []),
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: false,
                    }
                }
            }
        });

        /**
         * Visit chart
         **/
        const visitContext = document.getElementById('visit_chart').getContext('2d');
        const visitBarChart = new Chart(visitContext, {
            type: 'bar',
            data: {
                labels: @json($data->visit_labels ?? []),
                datasets: [{
                    label: 'Kunjungan',
                    data: @json($data->visit_data ?? []),
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: false,
                    }
                }
            }
        });
    </script>
@endpush
