@extends('web.layout.index')
@section('content')
<style>
    .grid figure {
        height: 280px !important;
    }
</style>
<div class="main">
    <div class="banner">
        <div class="container">
            <section class="slider">
                <div class="flexslider">
                    <ul class="slides">
                        <li>
                            <div class="banner_text">
                                <h3>CẢNH BÁO CHÁY RỪNG</h3>
                                <div class="w3ls-line"></div>
                                <p>XUANMAIJSC.VN</p>
                                <div class="w3-button">
                                    <a href="CanhBaoChayRung" class="btn btn-1 btn-1b">Xem thêm</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="banner_text">
                                <h3>GIÁM SÁT BIẾN ĐỘNG</h3>
                                <div class="w3ls-line"></div>
                                <p>XUANMAIJSC.VN</p>
                                <div class="w3-button">
                                    <a href="GiamSatRung" class="btn btn-1 btn-1b">Xem thêm</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="banner_text">
                                <h3>THỐNG KÊ BÁO CÁO</h3>
                                <div class="w3ls-line"></div>
                                <p>XUANMAIJSC.VN</p>
                                <div class="w3-button">
                                    <a href="ThongKeBaoCao" class="btn btn-1 btn-1b">Xem thêm</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>
        </div>
    </div>

    <div class="container">
        <!-- gallery -->
        <div class="services-heading">
            <h3>HÌNH ẢNH HOẠT ĐỘNG DỰ ÁN</h3>
            <div class="agileits-line"></div>
        </div>
        <div class="gallery">
            <div class="container">
                <div class="gallery-grids">
                    <div class="col-md-4 gallery-grid">
                        <div class="grid">
                            <figure class="effect-roxy">
                                <a class="example-image-link" href="web/images/hanam/1.jpg" data-lightbox="example-set"
                                    data-title="">
                                    <img src="web/images/hanam/1.jpg" alt="" />
                                    <figcaption>

                                    </figcaption>
                                </a>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-4 gallery-grid">
                        <div class="grid">
                            <figure class="effect-roxy">
                                <a class="example-image-link" href="web/images/hanam/2.jpg" data-lightbox="example-set"
                                    data-title="">
                                    <img src="web/images/hanam/2.jpg" alt="" />
                                    <figcaption>
                                    </figcaption>
                                </a>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-4 gallery-grid">
                        <div class="grid">
                            <figure class="effect-roxy">
                                <a class="example-image-link" href="web/images/hanam/3.jpg" data-lightbox="example-set"
                                    data-title="">
                                    <img src="web/images/hanam/3.jpg" alt="" />
                                    <figcaption>

                                    </figcaption>
                                </a>
                            </figure>
                        </div>
                    </div>

                    <div class="col-md-4 gallery-grid">
                        <div class="grid">
                            <figure class="effect-roxy">
                                <a class="example-image-link" href="web/images/hanam/4.jpg" data-lightbox="example-set"
                                    data-title="">
                                    <img src="web/images/hanam/4.jpg" alt="" />
                                    <figcaption>

                                    </figcaption>
                                </a>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-4 gallery-grid">
                        <div class="grid">
                            <figure class="effect-roxy">
                                <a class="example-image-link" href="web/images/hanam/5.jpg" data-lightbox="example-set"
                                    data-title="">
                                    <img src="web/images/hanam/5.jpg" alt="" />
                                    <figcaption>

                                    </figcaption>
                                </a>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-4 gallery-grid">
                        <div class="grid">
                            <figure class="effect-roxy">
                                <a class="example-image-link" href="web/images/hanam/6.jpg" data-lightbox="example-set"
                                    data-title="">
                                    <img src="web/images/hanam/6.jpg" alt="" />
                                    <figcaption>

                                    </figcaption>
                                </a>
                            </figure>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- //gallery -->
    </div>
</div>
@endsection