
@extends('auth')

@section('pageStyle')

    <link rel="stylesheet" href="css/c3.min.css" />

@stop

@section('pageContent')
    
    <div class="container-fluid">

        <div class="row">
            <!-- Column -->
            <div class="col-sm-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Earnings</h4>
                        <h5 class="card-subtitle">Total Earnings of this Year</h5>
                        <h2 class="font-medium">₹0</h2>
                    </div>
                    <div class="earningsbox m-t-5" style="height:78px; width:100%;"></div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-sm-12 col-lg-8">
                <div class="card">
                    <div class="card-body border-bottom">
                        <h4 class="card-title">Overview</h4>
                        <h5 class="card-subtitle">Total Earnings of the Month</h5>
                    </div>
                    <div class="card-body">
                        <div class="row m-t-10">
                            <!-- col -->
                            <div class="col-md-6 col-sm-12 col-lg-4">
                                <div class="d-flex align-items-center">
                                    <div class="m-r-10"><span class="text-orange display-5"><i class="mdi mdi-wallet"></i></span></div>
                                    <div><span class="text-muted">Total Earning</span>
                                        <h3 class="font-medium m-b-0">₹0</h3></div>
                                </div>
                            </div>
                            <!-- col -->
                            <!-- col -->
                            <div class="col-md-6 col-sm-12 col-lg-4">
                                <div class="d-flex align-items-center">
                                    <div class="m-r-10"><span class="text-primary display-5"><i class="mdi mdi-basket"></i></span></div>
                                    <div><span class="text-muted">Product sold</span>
                                        <h3 class="font-medium m-b-0">0</h3></div>
                                </div>
                            </div>
                            <!-- col -->
                            <!-- col -->
                            <div class="col-md-6 col-sm-12 col-lg-4">
                                <div class="d-flex align-items-center">
                                    <div class="m-r-10"><span class="display-5"><i class="mdi mdi-account-box"></i></span></div>
                                    <div><span class="text-muted">Customers Ordered</span>
                                        <h3 class="font-medium m-b-0">0</h3></div>
                                </div>
                            </div>
                            <!-- col -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-sm-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <!-- title -->
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Products of the Month</h4>
                                <h5 class="card-subtitle">Overview of Latest Month</h5>
                            </div>
                            <!-- <div class="ml-auto d-flex align-items-center">
                                <div class="dl">
                                    <select class="custom-select">
                                        <option value="0" selected>March</option>
                                        <option value="1">April</option>
                                        <option value="2">May</option>
                                        <option value="3">June</option>
                                    </select>
                                </div>
                            </div> -->
                        </div>
                        <!-- title -->
                        <div class="table-responsive scrollable m-t-10" style="height:400px;">
                            <table class="table v-middle">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">Products</th>
                                        <th class="border-top-0">Customers</th>
                                        <th class="border-top-0">Status</th>
                                        <th class="border-top-0">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="m-r-10"><img src="../../assets/images/product/chair.png" alt="user" class="circle" width="45" /></div>
                                                <div class="">
                                                    <h5 class="m-b-0 font-16 font-medium">Orange Shoes</h5></div>
                                            </div>
                                        </td>
                                        <td>Rotating Chair</td>
                                        <td><i class="fa fa-circle text-orange" data-toggle="tooltip" data-placement="top" title="In Progress"></i></td>
                                        <td>35</td>
                                        <td class="font-medium">$96K</td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="card">
                    <div class="card-body border-bottom">
                        <h4 class="card-title">Order Stats</h4>
                        <h5 class="card-subtitle">Overview of orders</h5>
                        <div class="status m-t-30" style="height:280px; width:100%"></div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-circle text-primary"></i>
                                <h3 class="m-b-0 font-medium">1</h3>
                                <span>New Orders</span>
                            </div>
                            <div class="col-4">
                                <i class="fa fa-circle text-info"></i>
                                <h3 class="m-b-0 font-medium">0</h3>
                                <span>Accepted</span>
                            </div>
                            <div class="col-4">
                                <i class="fas fa-circle text-orange"></i>
                                <h3 class="m-b-0 font-medium">0</h3>
                                <span>Delivered</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="row">
                        <div class="col-sm-12 col-lg-4">
                            <div class="card-body">
                                <h4 class="card-title">Reviews</h4>
                                <h5 class="card-subtitle">Overview of Review</h5>
                                <h2 class="font-medium m-t-40 m-b-0">0</h2>
                                <span class="text-muted">This month we got 0 New Reviews</span>
                                <div class="image-box m-t-30 m-b-30">
                                    <!-- <a href="#" class="m-r-10" data-toggle="tooltip" data-placement="top" title="Simmons"><img src="../../assets/images/users/1.jpg" class="rounded-circle" width="45" alt="user"></a> -->
                                </div>
                                <!-- <a href="javascript:void(0)" class="btn btn-lg btn-info waves-effect waves-light">Checkout All Reviews</a> -->
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-8 border-left">
                            <div class="card-body">
                                <ul class="list-style-none">
                                    <li class="m-t-30">
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-emoticon-happy display-5 text-muted"></i>
                                            <div class="m-l-10">
                                                <h5 class="m-b-0">Positive Reviews</h5>
                                                <span class="text-muted">0 Reviews</span></div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </li>
                                    <li class="m-t-40">
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-emoticon-sad display-5 text-muted"></i>
                                            <div class="m-l-10">
                                                <h5 class="m-b-0">Negative Reviews</h5>
                                                <span class="text-muted">0 Reviews</span></div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-orange" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </li>
                                    <li class="m-t-40 m-b-40">
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-emoticon-neutral display-5 text-muted"></i>
                                            <div class="m-l-10">
                                                <h5 class="m-b-0">Neutral Reviews</h5>
                                                <span class="text-muted">0 Reviews</span></div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('pageScript')

    <script src="{{ asset('js/d3.min.js') }}"></script>
    <script src="{{ asset('js/c3.min.js') }}"></script>
    <script> 

        $(window).on("load", function() {
            "use strict";

            var chart = c3.generate({
                bindto: '.earningsbox',
                data: {
                    columns: [
                        ['Site A', 5, 6, 3, 7, 9, 10, 14, 12, 11, 9, 8, 7, 10, 6, 12, 10, 8]
                    ],
                    type: 'area-spline'
                },
                axis: {
                    y: {
                        show: false,
                        tick: {
                            count: 0,
                            outer: false
                        }
                    },
                    x: {
                        show: false
                    }
                },
                padding: {
                    top: 0,
                    right: -8,
                    bottom: -28,
                    left: -8
                },
                point: {
                    r: 0
                },
                legend: {
                    hide: true
                },
                color: {
                    pattern: ['#40c4ff', '#dadada', '#ff821c', '#7e74fb']
                }
            });


            var chart = c3.generate({
                bindto: '.rate',
                data: {
                    columns: [
                        ['Conversation', 85],
                        ['other', 15],
                    ],
                    type : 'donut'
                },
                donut: {
                    label: {show: false},
                    title:"Weekly",
                    width:10,
                },
                padding: {top:10,bottom:-20},
                legend: {hide: true},
                color: {pattern: ['#2961ff', '#dadada', '#ff821c', '#7e74fb']}
            });

            var chart = c3.generate({
                bindto: '.status',
                data: {
                    columns: [
                        ['Success', 1],
                        ['Pending', 0],
                        ['Failed', 0]
                    ],
                    type : 'donut'
                },
                donut: {
                    label: {show: false},
                    title:"Orders",
                    width:35,
                },
                legend: {hide: true},
                color: {pattern: ['#40c4ff', '#2961ff', '#ff821c', '#7e74fb']}
            });

            $(".sidebartoggler").on("click", () => chart.resize());
        });
    </script>

@stop
