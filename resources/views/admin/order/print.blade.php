<html>

<head>
    <title>QB_Store_{{$order->code}}</title>


<style>
    @font-face {
        font-family: 'Poppins';
        font-style: normal;
        font-weight: 400;
        src: url('{{ public_path('fonts/Poppins-Regular.ttf') }}') format('truetype');
    }
    @font-face {
        font-family: 'Poppins';
        font-style: normal;
        font-weight: 400;
        src: url('{{ public_path('fonts/Popins-Light.ttf') }}') format('truetype');
    }
    @font-face {
        font-family: 'Poppins';
        font-style: normal;
        font-weight: 400;
        src: url('{{ public_path('fonts/Poppins-SemiBold.ttf') }}') format('truetype');
    }
    @font-face {
        font-family: 'Poppins';
        font-style: normal;
        font-weight: 400;
        src: url('{{ public_path('fonts/Poppins-ExtraBold.ttf') }}') format('truetype');
    }
    @font-face {
        font-family: 'Poppins';
        font-style: normal;
        font-weight: 400;
        src: url('{{ public_path('fonts/Poppins-Medium.ttf') }}') format('truetype');
    }

        *, body {
            font-family: 'Poppins', sans-serif;
        }


        .mt {
            margin-top: 20px !important;
        }

        .text-center {
            text-align: center !important;
        }

        .container-fluid {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, 0.03);
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .align-middle {
            vertical-align: middle !important;
        }

        .mb-0,
        .my-0 {
            margin-bottom: 0 !important;
        }


        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        .table-sm th,
        .table-sm td {
            padding: 0.3rem;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .table-borderless th,
        .table-borderless td,
        .table-borderless thead th,
        .table-borderless tbody+tbody {
            border: 0;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .table-hover tbody tr:hover {
            color: #212529;
            background-color: rgba(0, 0, 0, 0.075);
        }

        .table-primary,
        .table-primary>th,
        .table-primary>td {
            background-color: #b8daff;
        }

        .table-primary th,
        .table-primary td,
        .table-primary thead th,
        .table-primary tbody+tbody {
            border-color: #7abaff;
        }

        .table-hover .table-primary:hover {
            background-color: #9fcdff;
        }

        .table-hover .table-primary:hover>td,
        .table-hover .table-primary:hover>th {
            background-color: #9fcdff;
        }

        .table-secondary,
        .table-secondary>th,
        .table-secondary>td {
            background-color: #d6d8db;
        }

        .table-secondary th,
        .table-secondary td,
        .table-secondary thead th,
        .table-secondary tbody+tbody {
            border-color: #b3b7bb;
        }

        .table-hover .table-secondary:hover {
            background-color: #c8cbcf;
        }

        .table-hover .table-secondary:hover>td,
        .table-hover .table-secondary:hover>th {
            background-color: #c8cbcf;
        }

        .table-success,
        .table-success>th,
        .table-success>td {
            background-color: #c3e6cb;
        }

        .table-success th,
        .table-success td,
        .table-success thead th,
        .table-success tbody+tbody {
            border-color: #8fd19e;
        }

        .table-hover .table-success:hover {
            background-color: #b1dfbb;
        }

        .table-hover .table-success:hover>td,
        .table-hover .table-success:hover>th {
            background-color: #b1dfbb;
        }

        .table-info,
        .table-info>th,
        .table-info>td {
            background-color: #bee5eb;
        }

        .table-info th,
        .table-info td,
        .table-info thead th,
        .table-info tbody+tbody {
            border-color: #86cfda;
        }

        .table-hover .table-info:hover {
            background-color: #abdde5;
        }

        .table-hover .table-info:hover>td,
        .table-hover .table-info:hover>th {
            background-color: #abdde5;
        }

        .table-warning,
        .table-warning>th,
        .table-warning>td {
            background-color: #ffeeba;
        }

        .table-warning th,
        .table-warning td,
        .table-warning thead th,
        .table-warning tbody+tbody {
            border-color: #ffdf7e;
        }

        .table-hover .table-warning:hover {
            background-color: #ffe8a1;
        }

        .table-hover .table-warning:hover>td,
        .table-hover .table-warning:hover>th {
            background-color: #ffe8a1;
        }

        .table-danger,
        .table-danger>th,
        .table-danger>td {
            background-color: #f5c6cb;
        }

        .table-danger th,
        .table-danger td,
        .table-danger thead th,
        .table-danger tbody+tbody {
            border-color: #ed969e;
        }

        .table-hover .table-danger:hover {
            background-color: #f1b0b7;
        }

        .table-hover .table-danger:hover>td,
        .table-hover .table-danger:hover>th {
            background-color: #f1b0b7;
        }

        .table-light,
        .table-light>th,
        .table-light>td {
            background-color: #fdfdfe;
        }

        .table-light th,
        .table-light td,
        .table-light thead th,
        .table-light tbody+tbody {
            border-color: #fbfcfc;
        }

        .table-hover .table-light:hover {
            background-color: #ececf6;
        }

        .table-hover .table-light:hover>td,
        .table-hover .table-light:hover>th {
            background-color: #ececf6;
        }

        .table-dark,
        .table-dark>th,
        .table-dark>td {
            background-color: #c6c8ca;
        }

        .table-dark th,
        .table-dark td,
        .table-dark thead th,
        .table-dark tbody+tbody {
            border-color: #95999c;
        }

        .table-hover .table-dark:hover {
            background-color: #b9bbbe;
        }

        .table-hover .table-dark:hover>td,
        .table-hover .table-dark:hover>th {
            background-color: #b9bbbe;
        }

        .table-active,
        .table-active>th,
        .table-active>td {
            background-color: rgba(0, 0, 0, 0.075);
        }

        .table-hover .table-active:hover {
            background-color: rgba(0, 0, 0, 0.075);
        }

        .table-hover .table-active:hover>td,
        .table-hover .table-active:hover>th {
            background-color: rgba(0, 0, 0, 0.075);
        }

        .table .thead-dark th {
            color: #fff;
            background-color: #343a40;
            border-color: #454d55;
        }

        .table .thead-light th {
            color: #495057;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }

        .table-dark {
            color: #fff;
            background-color: #343a40;
        }

        .table-dark th,
        .table-dark td,
        .table-dark thead th {
            border-color: #454d55;
        }

        .table-dark.table-bordered {
            border: 0;
        }

        .table-dark.table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .table-dark.table-hover tbody tr:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.075);
        }

        @media (max-width: 575.98px) {
            .table-responsive-sm {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table-responsive-sm>.table-bordered {
                border: 0;
            }
        }

        @media (max-width: 767.98px) {
            .table-responsive-md {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table-responsive-md>.table-bordered {
                border: 0;
            }
        }

        @media (max-width: 991.98px) {
            .table-responsive-lg {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table-responsive-lg>.table-bordered {
                border: 0;
            }
        }

        @media (max-width: 1199.98px) {
            .table-responsive-xl {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table-responsive-xl>.table-bordered {
                border: 0;
            }
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table-responsive>.table-bordered {
            border: 0;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6 {
            margin-bottom: 0.5rem;
            font-weight: 500;
            line-height: 1.2;
        }

        h1,
        .h1 {
            font-size: 2.5rem;
        }

        h2,
        .h2 {
            font-size: 2rem;
        }


        .float-left {
            float: left !important;
        }

        .float-right {
            float: right !important;
        }
</style>



</head>

<?php 

                    function removeVietnameseAccents($str) {
                       $accents_arr = [
                            'a' => ['à', 'á', 'ả', 'ã', 'ạ', 'â', 'ầ', 'ấ', 'ẩ', 'ẫ', 'ậ', 'ă', 'ằ', 'ắ', 'ẳ', 'ẵ', 'ặ'],
                            'e' => ['è', 'é', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ề', 'ế', 'ể', 'ễ', 'ệ'],
                            'i' => ['ì', 'í', 'ỉ', 'ĩ', 'ị'],
                            'o' => ['ò', 'ó', 'ỏ', 'õ', 'ọ', 'ô', 'ồ', 'ố', 'ổ', 'ỗ', 'ộ', 'ơ', 'ờ', 'ớ', 'ở', 'ỡ', 'ợ'],
                            'u' => ['ù', 'ú', 'ủ', 'ũ', 'ụ', 'ư', 'ừ', 'ứ', 'ử', 'ữ', 'ự'],
                            'y' => ['ỳ', 'ý', 'ỷ', 'ỹ', 'ỵ'],
                            'd' => ['đ'],
                            'A' => ['À', 'Á', 'Ả', 'Ã', 'Ạ', 'Â', 'Ầ', 'Ấ', 'Ẩ', 'Ẫ', 'Ậ', 'Ă', 'Ằ', 'Ắ', 'Ẳ', 'Ẵ', 'Ặ'],
                            'E' => ['È', 'É', 'Ẻ', 'Ẽ', 'Ẹ', 'Ê', 'Ề', 'Ế', 'Ể', 'Ễ', 'Ệ'],
                            'I' => ['Ì', 'Í', 'Ỉ', 'Ĩ', 'Ị'],
                            'O' => ['Ò', 'Ó', 'Ỏ', 'Õ', 'Ọ', 'Ô', 'Ồ', 'Ố', 'Ổ', 'Ỗ', 'Ộ', 'Ơ', 'Ờ', 'Ớ', 'Ở', 'Ỡ', 'Ợ'],
                            'U' => ['Ù', 'Ú', 'Ủ', 'Ũ', 'Ụ', 'Ư', 'Ừ', 'Ứ', 'Ử', 'Ữ', 'Ự'],
                            'Y' => ['Ỳ', 'Ý', 'Ỷ', 'Ỹ', 'Ỵ'],
                            'D' => ['Đ']
                        ];

                        foreach ($accents_arr as $nonAccent => $accents) {
                            $str = str_replace($accents, $nonAccent, $str);
                        }

                        return $str;
                    }
?>

<body>
<h2 class="text-center mt">QB Store</h2>
    <p class="text-center">Website E-Commerce</p>
    <div class="container-fuild">

        <div class="card-header mt-3">INFORMATION RECIPIENT</div>
        <div class="table-responsive" style="padding-bottom: 10px;">
            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Phone Number</th>
                        <th class="text-center">Paymen</th>
                        <th class="text-center">Note</th>
                        <th class="text-center">Address</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @php $shipping = $order->shipping
                        ; @endphp
                        <td class="text-center text-muted">{{removeVietnameseAccents($shipping->name)}}</td>
                        <td class="text-center text-muted">{{$shipping->email}}</td>
                        <td class="text-center text-muted">{{ Str::limit($shipping->phone, 4)}}</td>
                        <td class="text-center text-muted">
                            @if($shipping->method == 0)
                            Cash
                            @elseif($shipping->method == 1)
                            VN Pay
                            @elseif($shipping->method == 2)
                            Momo
                            @endif
                        </td>
                        <td class="text-center text-muted">{{$shipping->note}}</td>
                        <td class="text-center text-muted">{{removeVietnameseAccents($shipping->address)}}</td>

                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-header mt-3">PRODUCT ORDERDED</div>
        <div class="table-responsive" style="padding-bottom: 10px;">
            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">Name Product</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Total Price</th>
                        <th class="text-center">Time</th>
                    </tr>
                </thead>
                <tbody>
                    @php $products = $order->orderDetails; $i = 0; @endphp
                    @foreach($products as $product)
                    @php $i++; @endphp
                    <tr>
                        <td class="text-center text-muted">{{$i}}</td>
                        <td class="text-center text-muted">{{$product->product_name}}</td>
                        <td class="text-center text-muted">{{ number_format($product->product_price, 0, ',', '.') . ' VND' }}</td>
                        <td class="text-center text-muted">{{$product->product_quantity}}</td>
                        <td class="text-center text-muted">{{ number_format($product->total_price, 0, ',', '.') . ' VND' }}</td>
                        <td class="text-center text-muted">{{$product->created_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-header mt-3">PAYMENT</div>
        <div class="table-responsiv $e" style="padding-bottom: 10px;">
            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">Product Price</th>
                        @if($order->coupon_code != "NO")
                        <th class="text-center">Discout</th>
                        @endif
                        <th class="text-center">Freight Cost</th>
                        <th class="text-center">Bill</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $coupon = 0;
                    $total = $order->total_order;
                    @endphp

                    @if($order->feeship_id != "NO")
                    @php $feeship = $order->feeship->feeship; @endphp
                    @else
                    @php $feeship = 25000; @endphp
                    @endif

                    @if($order->coupon_code != "NO")
                    @php $coupon = $total * ($order->coupon->percent/100); @endphp
                    @endif

                    <tr>
                        <td class="text-center text-muted">{{ number_format($total, 0, ',', '.') . ' VND' }}</td>
                        @if($order->coupon_code != "NO")
                        <td class="text-center text-muted">{{ number_format($coupon, 0, ',', '.') . ' VND' }}</td>
                        @endif
                        <td class="text-center text-muted">{{ number_format($feeship, 0, ',', '.') . ' VND' }}</td>
                        <td class="text-center text-muted" style="color: #B5292F; " >{{ number_format($total + $feeship - $coupon, 0, ',', '.') . ' VND' }}</td>
                    </tr>
                </tbody>
        </div>
        <div class="d-flex justify-content-around">
            <div class="float-left" style="width: 50%;">
                <p class="text-center">Customer (signs)</p>
                <p class="text-center"></p>
            </div>
            <div class="float-right" style="width: 50%;">
                <p class="text-center">Person issua an invoice</p>
                <p class="text-center">{{(new \DateTime())->format("Y-m-d H:i:s")}}</p>
                {{-- <p class="text-center">{{$user->name}}</p> --}}
            </div>
        </div>

    </div>


</body>

</html>
