@extends('site::layouts.master')

@section('css')
    <style>
        #map {
            height: 400px;
            width: auto;
        }
    </style>
@endsection

@push('styles')
@endpush

@section('meta')
    <x-meta-tag></x-meta-tag>
@endsection

@section('content')
    <!-- Product single page Starts here -->
    <section>
        <div class="product_single pt-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="productsingle_left bg-white p-2">
                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="left-container">
                                        <div class="row d-block justify-content-center">
                                            <div class="garjoo_product_gallery">
                                                <div class="garjoo_product_preview order-sm-2">
                                                    @foreach($product->images as $image)
                                                        <div
                                                            class="garjoo_product_preview-item @if($loop->iteration == 1) active @endif"
                                                            id="{{ 'product_image_' . $image->id }}">
                                                            <img
                                                                class="garjoo_image_zoom img-fluid"
                                                                src="{{ asset($image->path ) }}"
                                                                data-zoom="{{ asset($image->path ) }}"
                                                                alt="{{ $product->title }}"
                                                            >
                                                            <div class="garjoo_product_image_zoom"></div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="garjoo_image_thumblist order-sm-1">
                                                    @foreach($product->images as $image)
                                                        <a class="garjoo_image_thumblist-item active"
                                                           href="{{ '#product_image_' . $image->id }}">
                                                            <img src="{{ asset($image->path ) }}"
                                                                 alt="src="{{ $product->title }}"">
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="prod_details">
                                        <div class="p_title single_title">
                                            <h3>{{ $product->title }}</h3>
                                            <div class="total_rate">
                                                @if($product->discount)
                                                    <span
                                                        class="in-stock  mb-0 pb-0 rounded-3 bg-theme text-white">Save {{ $product->discount->rate }}%</span>
                                                    <h3 class="price fw-bold mt-0 pt-0">
                                                        $ {{ $product->price - $product->price*$product->discount->rate/100 }}
                                                        <span>{{ $product->price }}</span>
                                                    </h3>
                                                @else
                                                    <h3 class="price fw-bold mt-0 pt-0">
                                                        $ {{ $product->price }}
                                                    </h3>
                                                @endif
                                            </div>
                                            <hr>
                                            <div class="all_address">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="">
                                                            <h6 class="mb-0 fw-bold">Address</h6>
                                                        </div>
                                                        <div class="">
                                                            <p class="pb-0 mb-0">
                                                                @checkNull($product->map_address)
                                                            </p>
                                                        </div>
                                                    </div>
                                                    {{--                                                    <div class="col-md-6">--}}
                                                    {{--                                                        <div class="">--}}
                                                    {{--                                                            <h6 class="mb-0 fw-bold">Secondary Address</h6>--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                        <div class="">--}}
                                                    {{--                                                            <p class="pb-0 mb-0">New Address1</p>--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                    </div>--}}
                                                </div>
                                            </div>
                                            @unlessowner($product->user_id)
                                            <div class="title_btn mt-3">
                                                <a
                                                    href="#"
                                                    class="btn-search btn btn-hover-primary p-2 rounded-0 border-0"
                                                >
                                                    <i class="fas fa-dollar-sign"></i> Buy now
                                                </a>
                                                <x-add-to-cart
                                                    :productId="$product->id"
                                                    :cartId="$cartId"
                                                ></x-add-to-cart>
                                                <x-add-to-wishlist
                                                    :productId="$product->id"
                                                    :wishlistId="$wishlistId"
                                                ></x-add-to-wishlist>
                                            </div>
                                            @endowner
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="productsingle_left bg-white p-2 mt-3">
                            <div id="map"></div>
                        </div>
                        <div class="productsingle_left bg-white p-2 mt-3">
                            <div class="detailstab">
                                <nav>
                                    <div class="nav nav-tabs border-0" id="nav-tab" role="tablist">
                                        {{--                                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"--}}
                                        {{--                                                data-bs-target="#nav-home" type="button" role="tab"--}}
                                        {{--                                                aria-controls="nav-home" aria-selected="true">Description--}}
                                        {{--                                        </button>--}}
                                        <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-profile" type="button" role="tab"
                                                aria-controls="nav-profile" aria-selected="false">Reviews
                                        </button>
                                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-contact" type="button" role="tab"
                                                aria-controls="nav-contact" aria-selected="false">Questions
                                        </button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    {{--                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"--}}
                                    {{--                                         aria-labelledby="nav-home-tab">--}}
                                    {{--                                        <div class="main_desc">--}}
                                    {{--                                            <div class="desc_head">--}}
                                    {{--                                                <div class="main_title">--}}
                                    {{--                                                    <h4>Overview</h4>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <table--}}
                                    {{--                                                class="table table-success table-striped mt-3 w-100 table-bordered overview"--}}
                                    {{--                                                role="presentation">--}}
                                    {{--                                                <tbody>--}}
                                    {{--                                                <tr>--}}
                                    {{--                                                    <th>--}}
                                    {{--                                                        Items--}}
                                    {{--                                                    </th>--}}
                                    {{--                                                    <td>--}}
                                    {{--                                                        <strong> Wholesale Customize 2019 New Glass Gravy Boat Glass--}}
                                    {{--                                                            Gravy Bowl Container 250ML</strong>--}}
                                    {{--                                                    </td>--}}
                                    {{--                                                </tr>--}}
                                    {{--                                                <tr>--}}
                                    {{--                                                    <th>--}}
                                    {{--                                                        Standing screen display size--}}
                                    {{--                                                    </th>--}}
                                    {{--                                                    <td>--}}
                                    {{--                                                        15.6 Inches--}}
                                    {{--                                                    </td>--}}
                                    {{--                                                </tr>--}}
                                    {{--                                                <tr>--}}
                                    {{--                                                    <th>--}}
                                    {{--                                                        Max Screen Resolution--}}
                                    {{--                                                    </th>--}}
                                    {{--                                                    <td>--}}
                                    {{--                                                        1920 x 1080--}}
                                    {{--                                                    </td>--}}
                                    {{--                                                </tr>--}}
                                    {{--                                                <tr>--}}
                                    {{--                                                    <th>--}}
                                    {{--                                                        Memory Speed--}}
                                    {{--                                                    </th>--}}
                                    {{--                                                    <td>--}}
                                    {{--                                                        3.5 GHz--}}
                                    {{--                                                    </td>--}}
                                    {{--                                                </tr>--}}
                                    {{--                                                <tr>--}}
                                    {{--                                                    <th>--}}
                                    {{--                                                        Graphics Coprocessor--}}
                                    {{--                                                    </th>--}}
                                    {{--                                                    <td>--}}
                                    {{--                                                        AMD Radeon Vega 3--}}
                                    {{--                                                    </td>--}}
                                    {{--                                                </tr>--}}
                                    {{--                                                <tr>--}}
                                    {{--                                                    <th>--}}
                                    {{--                                                        Chipset Brand--}}
                                    {{--                                                    </th>--}}
                                    {{--                                                    <td>--}}
                                    {{--                                                        AMD--}}
                                    {{--                                                    </td>--}}
                                    {{--                                                </tr>--}}
                                    {{--                                                <tr>--}}
                                    {{--                                                    <th>--}}
                                    {{--                                                        Card Description--}}
                                    {{--                                                    </th>--}}
                                    {{--                                                    <td>--}}
                                    {{--                                                        Integrated--}}
                                    {{--                                                    </td>--}}
                                    {{--                                                </tr>--}}
                                    {{--                                                <tr>--}}
                                    {{--                                                    <th>--}}
                                    {{--                                                        Wireless Type--}}
                                    {{--                                                    </th>--}}
                                    {{--                                                    <td class="product_size">--}}
                                    {{--                                                        802.11ac--}}
                                    {{--                                                    </td>--}}
                                    {{--                                                </tr>--}}
                                    {{--                                                <tr>--}}
                                    {{--                                                    <th>--}}
                                    {{--                                                        Number of USB 2.0 Ports--}}
                                    {{--                                                    </th>--}}
                                    {{--                                                    <td>--}}
                                    {{--                                                        2--}}
                                    {{--                                                    </td>--}}
                                    {{--                                                </tr>--}}
                                    {{--                                                <tr>--}}
                                    {{--                                                    <th>--}}
                                    {{--                                                        Number of USB 3.0 Ports--}}
                                    {{--                                                    </th>--}}
                                    {{--                                                    <td>--}}
                                    {{--                                                        1--}}
                                    {{--                                                    </td>--}}
                                    {{--                                                </tr>--}}
                                    {{--                                                <tr>--}}
                                    {{--                                                    <th>--}}
                                    {{--                                                        Average Battery Life (in hours)--}}
                                    {{--                                                    </th>--}}
                                    {{--                                                    <td>--}}
                                    {{--                                                        7.5 Hours--}}
                                    {{--                                                    </td>--}}
                                    {{--                                                </tr>--}}
                                    {{--                                                </tbody>--}}
                                    {{--                                            </table>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    <div
                                        class="tab-pane fade show active pt-4 px-4"
                                        id="nav-profile"
                                        role="tabpanel"
                                        aria-labelledby="nav-profile-tab"
                                    >
                                        @unlessowner($product->user_id)
                                        @include('review::create')
                                        @endowner
                                        @if ($reviews->count() > 0)
                                            <div class="my-3">
                                                <h6>All Reviews</h6>
                                                @foreach($reviews as $review)
                                                    <div class="my-2">
                                                        <div class="d-flex align-items-center">
                                                            <span class="fw-bold">{{ $review->user->first_name }}</span>
                                                            @include('review::delete')
                                                        </div>
                                                        <p>
                                                            @for($i=1;$i<=5;$i++)
                                                                <i class="@if($i <= $review->rating) fa @else far @endif fa-star"></i>
                                                            @endfor
                                                            <br>
                                                            {{ $review->message }}
                                                        </p>

                                                        @include('review::edit')
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                         aria-labelledby="nav-contact-tab">...
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="productsingle_right">
                            <div class="crt-sumry  p-3 border bg-white">
                                <h5>For product pricing, customization, or other inquiries:</h5>
                                <div class="lead-time">
                                    <div>
                                        <span>Shipping time 7-15 days
                                            <i class="fa fa-info"></i>
                                        </span>
                                    </div>
                                    <p class="innerpara">Enjoy Free shipping promotion with minimum 2 times</p>
                                </div>
                                <div class="lead-time">
                                    <p class="innerpara fw-bold border-0 mb-0 pb-0">Cash on Delivery</p>
                                    <p class="innerpara fw-bold border-0 mt-0 mb-0">7 Days Returns warranty</p>
                                </div>
                            </div>
                            <div class="user_list border mt-3 p-3 bg-white">
                                <div class="card_logo">
                                    <img src="img/logo.png" alt="" class="img-fluid mx-auto d-block w-50">
                                </div>
                                <div class="supplier_text text-center mt-3 border-bottom border-dark">
                                    <p>
                                        <strong>{{ $product->store->name }}</strong>
                                    </p>
                                </div>
                                <div class="supplier-details mt-3"></div>
                                <!-- supplier-details -->
                                <div class="supplier_info d-flex justify-content-between">
                                    <p class="text-center">
                                        <strong class="d-block">Products</strong>1
                                    </p>
                                    <p class="text-center">
                                        <strong class="d-block ">Views</strong> 3
                                    </p>
                                    <p class=" text-center">
                                        <strong class="d-block ">On Garjoo</strong> 3 Weeks ago
                                    </p>
                                </div>
                                <button
                                    class="btn-search btn btn-hover-primary p-2 rounded-0 bg-theme border-0  d-flex align-items-center m-auto">
                                    <i class="fas fa-store me-2"></i>
                                    Visit Store
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product single page Ends here -->
    <!-- Related Product section starts -->
    <section class="pt-40">
        <div class="newarrivals myproducts">
            <div class="container">
                <div class="arrivalbox shadow  bg-white p-3">
                    <!-- main heading -->
                    <div class="col-12">
                        <div class="title-section">
                            <div class="row ">
                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- title section Start -->
                                    <div class="title1">
                                        <h3 class="title">Related Products</h3>
                                    </div>
                                    <!-- title section End -->
                                    <div class="title_btn">
                                        <button class="btn-search btn btn-hover-primary p-2 rounded-0" type="submit">
                                            View All
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product slider starts -->
                    <!-- partners section -->
                    <div class="owl-carousel owl-theme new_arrival">
                        <div class="item">
                            <div class="brands_item d-flex flex-column justify-content-center">
                                <div class="item-inner">
                                    <div class="product_det">
                                        <div class="product_card clearfix">
                                            <div class="icon_tag">
                                                <span class="icon_offer prd_new">New</span>
                                                <span class="icon_offer prd_sale">Sale</span>
                                            </div>
                                            <a class="product_image product_more" title="" href="">
                                                <span class="product_image">
                                                    <img src="img/products/product1.jpeg" alt="">
                                                </span>
                                            </a>
                                        </div>
                                        <div class="item-info">
                                            <div class="product_details">
                                                <div class="product_head">
                                                    <a title="" href="">
                                                        Enclave Shoes
                                                    </a>
                                                </div>
                                                <div class="product_price">
                                                    <div class="product_price_main">
                                                        <span class="product_regular">
                                                            <span class="price">
                                                                <span class="price1">$ 540.00</span>
                                                        <span class="price2">$ 600.00</span>
                                                        </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product_btn">
                                            <div class="addtocart">
                                                <a href="addtocart.html" class="btn_cart" title="Add to Cart">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    <span>Add to Cart</span>
                                                </a>
                                            </div>
                                            <div class="actions">
                                                <ul class="other_links">
                                                    <li>
                                                        <a class="icon_wishlist" href="#" title="Add to Wishlist">
                                                            <i class="fa fa-heart"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="icon_compare" href="#" title="Add to Compare">
                                                            <i class="fa fa-random"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="icon_view" href="#" title=" Quick View">
                                                            <i class="fa fa-star"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="brands_item d-flex flex-column justify-content-center">
                                <div class="item-inner">
                                    <div class="product_det">
                                        <div class="product_card clearfix">
                                            <div class="icon_tag">
                                                <span class="icon_offer prd_new">New</span>
                                                <span class="icon_offer prd_sale">Sale</span>
                                            </div>
                                            <a class="product_image product_more" title="" href="">
                                                <span class="product_image">
                                                    <img src="img/products/product2.jpeg" alt="">
                                                </span>
                                            </a>
                                        </div>
                                        <div class="item-info">
                                            <div class="product_details">
                                                <div class="product_head">
                                                    <a title="" href="">
                                                        Enclave Shoes
                                                    </a>
                                                </div>
                                                <div class="product_price">
                                                    <div class="product_price_main">
                                                        <span class="product_regular">
                                                            <span class="price">
                                                                <span class="price1">$ 540.00</span>
                                                        <span class="price2">$ 600.00</span>
                                                        </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product_btn">
                                            <div class="addtocart">
                                                <button class="btn_cart" title="Add to Cart">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    <span>Add to Cart</span>
                                                </button>
                                            </div>
                                            <div class="actions">
                                                <ul class="other_links">
                                                    <li>
                                                        <a class="icon_wishlist" href="#" title="Add to Wishlist">
                                                            <i class="fa fa-heart"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="icon_compare" href="#" title="Add to Compare">
                                                            <i class="fa fa-random"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="icon_view" href="#" title=" Quick View">
                                                            <i class="fa fa-star"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="brands_item d-flex flex-column justify-content-center">
                                <div class="item-inner">
                                    <div class="product_det">
                                        <div class="product_card clearfix">
                                            <div class="icon_tag">
                                                <span class="icon_offer prd_new">New</span>
                                                <span class="icon_offer prd_sale">Sale</span>
                                            </div>
                                            <a class="product_image product_more" title="" href="">
                                                <span class="product_image">
                                                    <img src="img/products/product3.jpeg" alt="">
                                                </span>
                                            </a>
                                        </div>
                                        <div class="item-info">
                                            <div class="product_details">
                                                <div class="product_head">
                                                    <a title="" href="">
                                                        Enclave Shoes
                                                    </a>
                                                </div>
                                                <div class="product_price">
                                                    <div class="product_price_main">
                                                        <span class="product_regular">
                                                            <span class="price">
                                                                <span class="price1">$ 540.00</span>
                                                        <span class="price2">$ 600.00</span>
                                                        </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product_btn">
                                            <div class="addtocart">
                                                <button class="btn_cart" title="Add to Cart">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    <span>Add to Cart</span>
                                                </button>
                                            </div>
                                            <div class="actions">
                                                <ul class="other_links">
                                                    <li>
                                                        <a class="icon_wishlist" href="#" title="Add to Wishlist">
                                                            <i class="fa fa-heart"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="icon_compare" href="#" title="Add to Compare">
                                                            <i class="fa fa-random"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="icon_view" href="#" title=" Quick View">
                                                            <i class="fa fa-star"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="brands_item d-flex flex-column justify-content-center">
                                <div class="item-inner">
                                    <div class="product_det">
                                        <div class="product_card clearfix">
                                            <div class="icon_tag">
                                                <span class="icon_offer prd_new">New</span>
                                                <span class="icon_offer prd_sale">Sale</span>
                                            </div>
                                            <a class="product_image product_more" title="" href="">
                                                <span class="product_image">
                                                    <img src="img/products/product4.jpeg" alt="">
                                                </span>
                                            </a>
                                        </div>
                                        <div class="item-info">
                                            <div class="product_details">
                                                <div class="product_head">
                                                    <a title="" href="">
                                                        Enclave Shoes
                                                    </a>
                                                </div>
                                                <div class="product_price">
                                                    <div class="product_price_main">
                                                        <span class="product_regular">
                                                            <span class="price">
                                                                <span class="price1">$ 540.00</span>
                                                        <span class="price2">$ 600.00</span>
                                                        </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product_btn">
                                            <div class="addtocart">
                                                <button class="btn_cart" title="Add to Cart">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    <span>Add to Cart</span>
                                                </button>
                                            </div>
                                            <div class="actions">
                                                <ul class="other_links">
                                                    <li>
                                                        <a class="icon_wishlist" href="#" title="Add to Wishlist">
                                                            <i class="fa fa-heart"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="icon_compare" href="#" title="Add to Compare">
                                                            <i class="fa fa-random"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="icon_view" href="#" title=" Quick View">
                                                            <i class="fa fa-star"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="brands_item d-flex flex-column justify-content-center">
                                <div class="item-inner">
                                    <div class="product_det">
                                        <div class="product_card clearfix">
                                            <div class="icon_tag">
                                                <span class="icon_offer prd_new">New</span>
                                                <span class="icon_offer prd_sale">Sale</span>
                                            </div>
                                            <a class="product_image product_more" title="" href="">
                                                <span class="product_image">
                                                    <img src="img/products/product3.jpeg" alt="">
                                                </span>
                                            </a>
                                        </div>
                                        <div class="item-info">
                                            <div class="product_details">
                                                <div class="product_head">
                                                    <a title="" href="">
                                                        Enclave Shoes
                                                    </a>
                                                </div>
                                                <div class="product_price">
                                                    <div class="product_price_main">
                                                        <span class="product_regular">
                                                            <span class="price">
                                                                <span class="price1">$ 540.00</span>
                                                        <span class="price2">$ 600.00</span>
                                                        </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product_btn">
                                            <div class="addtocart">
                                                <button class="btn_cart" title="Add to Cart">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    <span>Add to Cart</span>
                                                </button>
                                            </div>
                                            <div class="actions">
                                                <ul class="other_links">
                                                    <li>
                                                        <a class="icon_wishlist" href="#" title="Add to Wishlist">
                                                            <i class="fa fa-heart"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="icon_compare" href="#" title="Add to Compare">
                                                            <i class="fa fa-random"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="icon_view" href="#" title=" Quick View">
                                                            <i class="fa fa-star"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="brands_item d-flex flex-column justify-content-center">
                                <div class="item-inner">
                                    <div class="product_det">
                                        <div class="product_card clearfix">
                                            <div class="icon_tag">
                                                <span class="icon_offer prd_new">New</span>
                                                <span class="icon_offer prd_sale">Sale</span>
                                            </div>
                                            <a class="product_image product_more" title="" href="">
                                                <span class="product_image">
                                                    <img src="img/products/product4.jpeg" alt="">
                                                </span>
                                            </a>
                                        </div>
                                        <div class="item-info">
                                            <div class="product_details">
                                                <div class="product_head">
                                                    <a title="" href="">
                                                        Enclave Shoes
                                                    </a>
                                                </div>
                                                <div class="product_price">
                                                    <div class="product_price_main">
                                                        <span class="product_regular">
                                                            <span class="price">
                                                                <span class="price1">$ 540.00</span>
                                                        <span class="price2">$ 600.00</span>
                                                        </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product_btn">
                                            <div class="addtocart">
                                                <button class="btn_cart" title="Add to Cart">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    <span>Add to Cart</span>
                                                </button>
                                            </div>
                                            <div class="actions">
                                                <ul class="other_links">
                                                    <li>
                                                        <a class="icon_wishlist" href="#" title="Add to Wishlist">
                                                            <i class="fa fa-heart"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="icon_compare" href="#" title="Add to Compare">
                                                            <i class="fa fa-random"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="icon_view" href="#" title=" Quick View">
                                                            <i class="fa fa-star"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        function changeImage(element) {
            let main_product_image = document.getElementById('main_product_image');
            main_product_image.src = element.src;
        }
    </script>

    <script>
        $(document).ready(function () {
            let center = {!! json_encode($product->map_lng_lat) !!};

            let map = new mapboxgl.Map({
                container: 'map', // container ID
                style: 'mapbox://styles/mapbox/streets-v11', // style URL
                center: center, // starting position [lng, lat]
                zoom: 18 // starting zoom
            });

            let marker1 = new mapboxgl.Marker()
                .setLngLat(center)
                .addTo(map);
        })

    </script>
@endsection

@push('script')
@endpush
