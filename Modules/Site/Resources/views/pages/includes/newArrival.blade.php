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
                                    <h3 class="title">New Arrivals</h3>
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
                    @foreach($products as $product)
                        <x-product-card
                            :product="$product"
                        ></x-product-card>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
