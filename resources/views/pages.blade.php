@extends('layouts.admin')

@php
    $breadcrumbs = collect([
        [
            'label' => 'Pages',
            'href'  => '/admin/pages',
        ],
    ]);
@endphp

@section('content')
    <pages-panel></pages-panel>
@endsection
