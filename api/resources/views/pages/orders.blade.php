
@extends('auth')

@section('pageStyle')

    <style>

        .badge-container{
            position: absolute;
            right: 10px;
            top: 0;
        }
        .gray{
            background: #ddd;
        }
        .primary{
            background: var(--blue);
            color: var(--white);
        }
        .success{
            background: var(--green);
            color: var(--white);
        }
        .danger{
            background: var(--red);
            color: var(--white);
        }
        .warning{
            background: var(--yelloq);
            color: var(--white);
        }
        .purple{
            background: var(--purple);
            color: var(--white);
        }
        .product-name{
            font-size: 13px;
            font-weight: 600;
        }
        .customer-name, .customer-name a{
            font-weight: 600;
            font-size: 16px;
            color: #000;
        }
        .address{
            margin-top: 8px;
            font-size: 13px;
            font-weight: 300;
            line-height: 20px;
        }
        .detail-btn{
            position: absolute;
            right: 10px;
            bottom: 0;
        }

    </style>

@stop

@section('pageContent')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                @if(count($orders) > 0)

                    @foreach($orders as $order)

                        <div class="card rounded">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2 text-center">
                                        <img src="{!! asset('images/products/'.$order['images'][0]) !!}" alt="product image" width="60%">
                                    </div>
                                    <div class="col-md-10 position-relative">
                                        <div class="product-name">{{ $order['productName'] }} | {{ $order['varietyName'] }} </div>
                                        <div class="customer-name">{{ $order['name'] }} (<a href="tel:+91{{ $order['mobileNo'] }}"> +91-{{ $order['mobileNo'] }} </a>)</div>
                                        <div class="address">{{ $order['address1'] }} <br> {{ $order['address2']}} <br> {{ $order['city'] }} - {{ $order['pincode'] }} <br> {{ $order['state'] }}</div>
                                        <div class="badge-container">
                                            <div class="badge purple">Quantity - {{ $order['quantity'] }}</div>
                                            <div class="ml-2 badge gray">{{ $order['type'] }}</div>
                                            <div class="ml-2 badge
                                                @if($order['statusId'] == 1)
                                                    primary
                                                @elseif($order['statusId'] == 2)
                                                    danger
                                                @elseif($order['statusId'] == 6)
                                                    success
                                                @else
                                                    warning
                                                @endif"
                                            >{{ $order['status'] }}</div>
                                        </div>
                                        <a href="{!! url('order/'.$order['orderNo']) !!}" class="btn btn-sm btn-info detail-btn rounded">Detail <i class="mdi mdi-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                @else

                    <div class="card rounded">
                        <div class="card-body text-center">
                            No orders available.
                        </div>
                    </div>

                @endif

            </div>
        </div>
    </div>
    
@stop
