
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Branches</div>

            <div class="card-body">
                {!! $dataTable->table(['class' => 'table table-bordered', 'width' => '100%']) !!}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush
