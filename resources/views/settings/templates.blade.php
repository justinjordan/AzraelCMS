@extends('layouts.admin')

@php
    $breadcrumbs = collect([
        [
            'label' => 'Settings',
            'href'  => '/admin/settings',
        ],
        [
            'label' => 'Templates',
            'href'  => '/admin/settings/templates',
        ],
    ]);
@endphp

@section('content')
@endsection
