@extends('template')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $pageTitle }}</h1>
    </div>

    <div class="row row-cols-1 row-cols-md-3 row-cols-xl-4 no-gutters">
        <div class="card col">
            <div class="card-body">
                <h5 class="card-title"> <i class="fa fa-users mr-2" aria-hidden="true"></i> Buku Dipinjam</h5>
                <p class="card-text text-primary" style="font-size: 80px;">{{ $data->active_loans_count ?? 0 }}</p>
            </div>
        </div>

        <div class="card col">
            <div class="card-body">
                <h5 class="card-title"> <i class="fa fa-book mr-2" aria-hidden="true"></i> Harus Dikembalikan</h5>
                <p class="card-text text-primary" style="font-size: 80px;">{{ $data->need_return_count ?? 0 }}</p>
            </div>
        </div>

        <div class="card col">
            <div class="card-body">
                <h5 class="card-title"> <i class="fa fa-check mr-2" aria-hidden="true"></i> Kunjungan Bulan Ini</h5>
                <p class="card-text text-primary" style="font-size: 80px;">{{ $data->visits_count ?? 0 }}</p>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-xl-2 no-gutters">
        <div class="col card no-gutters mt-3" style="width:100%;">
            <div class="card-body">
                <h5 class="card-title">Buku</h5>
                <div class="table-responsive">
                    {!! $loansDataTable->table() !!}
                </div>
            </div>
        </div>

        <div class="col card no-gutters mt-3" style="width:100%;">
            <div class="card-body">
                <h5 class="card-title">Kunjungan Bulan Ini</h5>
                <div class="table-responsive">
                    {!! $visitsDataTable->table() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{ $loansDataTable->scripts() }}
{{ $visitsDataTable->scripts() }}
@endpush