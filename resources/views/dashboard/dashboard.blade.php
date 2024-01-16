@extends('dashboard.layouts.main')

@section('isibody')
    <div class="page-header">
        <h4 class="page-title">{{ $title }}</h4>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body ">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">User</p>
                                <h4 class="card-title">{{ auth()->user()->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                <i class="far fa-newspaper"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Subscribers</p>
                                <h4 class="card-title">1303</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-sm-6 col-md-5">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="far fa-chart-bar"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Sales Order</p>
                                <h4 class="card-title">IDR {{ number_format($salesOrder, 2, '.', ',') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-5">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                <i class="far fa-check-circle"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Purchase Order</p>
                                <h4 class="card-title">IDR {{ number_format($purchaseOrder, 2, '.', ',') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Top Products</div>
                </div>
                <div class="card-body pb-0">
                    <div class="d-flex">
                        <div class="avatar">
                            <img src="../assets/img/logoproduct.svg" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="flex-1 pt-1 ml-2">
                            <h5 class="fw-bold mb-1">CSS</h5>
                            <small class="text-muted">Cascading Style Sheets</small>
                        </div>
                        <div class="d-flex ml-auto align-items-center">
                            <h3 class="text-info fw-bold">+$17</h3>
                        </div>
                    </div>
                    <div class="separator-dashed"></div>
                    <div class="d-flex">
                        <div class="avatar">
                            <img src="../assets/img/logoproduct2.svg" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="flex-1 pt-1 ml-2">
                            <h5 class="fw-bold mb-1">J.CO Donuts</h5>
                            <small class="text-muted">The Best Donuts</small>
                        </div>
                        <div class="d-flex ml-auto align-items-center">
                            <h3 class="text-info fw-bold">+$300</h3>
                        </div>
                    </div>
                    <div class="separator-dashed"></div>
                    <div class="d-flex">
                        <div class="avatar">
                            <img src="../assets/img/logoproduct3.svg" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="flex-1 pt-1 ml-2">
                            <h5 class="fw-bold mb-1">Ready Pro</h5>
                            <small class="text-muted">Bootstrap 4 Admin Dashboard</small>
                        </div>
                        <div class="d-flex ml-auto align-items-center">
                            <h3 class="text-info fw-bold">+$350</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-primary bg-primary-gradient bubble-shadow">
                <div class="card-body">
                    <h4 class="mt-3 b-b1 pb-2 mb-4 fw-bold">Active user right now</h4>
                    <h1 class="mb-4 fw-bold">17</h1>
                    <h4 class="mt-3 b-b1 pb-2 mb-5 fw-bold">Page view per minutes</h4>
                    <div id="activeUsersChart"></div>
                    <h4 class="mt-5 pb-3 mb-0 fw-bold">Top active pages</h4>
                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-between pb-1 pt-1"><small>/product/readypro/index.html</small>
                            <span>7</span>
                        </li>
                        <li class="d-flex justify-content-between pb-1 pt-1"><small>/product/azzara/demo.html</small>
                            <span>10</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
