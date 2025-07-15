@extends('template')

@section('content')
    <div class="container-fluid">
        @include('partials.alert')

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-800">{{ $pageTitle }}</h1>

            <a href="/visits/create" class="btn btn-primary">+ Kunjugan</a>
        </div>

        @include('pages.loans.table')
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
