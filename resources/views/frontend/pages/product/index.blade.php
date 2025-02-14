@extends('layouts.app_master_frontend')
@section('css')
    <style>
        <?php $style = file_get_contents('css/product_insights.min.css');
        echo $style; ?> .filter-tab .active a {
            color: red;
        }
    </style>
@stop
@section('content')
    <div class="container">
        <div class="product-list">
            <div class="left">
                @include('frontend.pages.product.include._inc_sidebar')
            </div>
            <div class="right">
                <div class="breadcrumb">
                    <ul>
                        <li>
                            <a itemprop="url" href="/" title="Home"><span itemprop="title" style="color:rgb(192, 44, 44); font-size:15px">Trang chủ</span></a>
                        </li>
                    </ul>
                </div>
                <div class="filter-tab">
                    <ul>
                        @for($i = 1; $i <= 6; $i++)
                            <li class="{{ Request::get('price') == $i ? "active" : "" }}">
                                <a href="{{ request()->fullUrlWithQuery(['price' =>  $i]) }}">
                                    {{  $i == 6 ? "Lớn hơn 1 Triệu" : "Giá < " . number_format($i * 100000,0,',','.')  ."đ" }}
                                </a>
                            </li>
                        @endfor
                    </ul>
                </div>
                {{-- {{  dd($products) }} --}}
                <div class="order-tab">
                    <span class="total-prod">Tổng số: {{ $products->total() }} sản phẩm Tính năng</span>
                    <div class="sort">
                        <div class="item">
                            <span class="title js-show-sort">Sắp xếp <i class="fa fa-caret-down"></i></span>
                            <ul>
                                <li><a class="{{ Request::get('sort') == 'desc' ? 'active' : '' }}"
                                        href="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}">Giá tăng dần</a></li>
                                <li><a class="{{ Request::get('sort') == 'asc' ? 'active' : '' }}"
                                        href="{{ request()->fullUrlWithQuery(['sort' => 'asc']) }}">Giá giảm dần</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="group">
                    @foreach ($products as $product)
                        @include('frontend.components.product_item', ['product' => $product])
                    @endforeach
                </div>
                <div style="display: block;">
                    {!! $products->appends($query ?? [])->links() !!}
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        var CSS = "{{ asset('css/product_search.min.css') }}";
    </script>
    <script type="text/javascript">
        <?php $js = file_get_contents('js/product_search.js');
        echo $js; ?>
    </script>
@stop
