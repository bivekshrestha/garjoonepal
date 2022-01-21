<section class="pt-40 pb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card px-2 py-3 p-md-4 text-white cta_card border-0">
                    <div class="row">
                        <div class="col-3 col-md-3 text-center">
                            <img
                                src="{{ asset('static/img/reg.png') }}"
                                alt=""
                                height="60px"
                                width="100px"
                                class="img-fluid"
                            >
                        </div>
                        <div class="col-9 col-md-9">
                            <h6 class="font-weight-bold mb-3">Garjoo's better when you're a member</h6>
                            <p>See more relevant listings, find what you're looking for quicker and more!</p>
                            @guest
                                <a
                                    href="{{ route('registration') }}"
                                    class="btn bg-white text-center px-3 font-weight-bold mybtn"
                                >Sign Up Now!</a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
