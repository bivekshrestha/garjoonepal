<div class="item">
    <div class="brands_item d-flex flex-column justify-content-center">
        <div class="item-inner">
            <div class="product_det">
                <div class="product_card clearfix">
                    <div class="icon_tag">
                        @if(today()->subWeek()->lte($product->created_at))
                            <span class="icon_offer prd_new">New</span>
                        @endif
                        @if($product->discount)
                            <span class="icon_offer prd_sale">Sale</span>
                        @endif
                    </div>
                    <a
                        class="product_image product_more"
                        title="{{ $product->title }}"
                        href="{{ route('product.show', $product->slug) }}"
                    >
                        <span class="product_image">
                            @if($product->thumbnail)
                                <img
                                    src="{{ asset($product->thumbnail->path) }}"
                                    alt="{{ $product->title }}"
                                >
                            @endif
                        </span>
                    </a>
                </div>
                <div class="item-info">
                    <div class="product_details">
                        <div class="product_head">
                            <a
                                title="{{ $product->title }}"
                                href="{{ route('product.show', $product->slug) }}"
                            >
                                {{ $product->title }}
                            </a>
                        </div>
                        <div class="product_price">
                            <div class="product_price_main">
                                <span class="product_regular">
                                 <span class="price">
                                    <span
                                        class="@if($product->discount) price2 @else price1 @endif">$ {{ $product->price }}</span>
                                    @if($product->discount)
                                         <span
                                             class="price1">$ {{ $product->price - $product->price*$product->discount->rate/100 }}</span>
                                     @endif
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_btn">
                    <div class="addtocart">
                        @unlessowner($product->user_id)
                        <x-add-to-cart
                            :productId="$product->id"
                            :cartId="$product->cart ? $product->cart->id : null"
                        ></x-add-to-cart>
                        @endowner
                    </div>
                    <div class="actions">
                        <ul class="other_links">
                            <li>
                                @unlessowner($product->user_id)
                                <x-add-to-wishlist
                                    :productId="$product->id"
                                    :wishlistId="$product->wishlist ? $product->wishlist->id : null"
                                ></x-add-to-wishlist>
                                @endowner
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
