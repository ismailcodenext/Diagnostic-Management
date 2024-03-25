@extends('layout.dashboard-sidenav')
@section('title','Doctor')
@section('content')
    @include('components.back-end.doctor.doctor-list')
    @include('components.back-end.doctor.doctor-create')
@endsection
