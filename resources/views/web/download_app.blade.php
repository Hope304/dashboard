@extends('web.layout.index')
@section('content')
    <div class="banner about-banner">
        <div class="container">
            <h2>TẢI VỀ ỨNG DỤNG MOBILE</h2>
            <div class="agileits-line"></div>
        </div>
    </div>
    <div class="container">
        <div class="agileinfo-blog-grids">
            <div class="about-w3ls-row">
                <div class="col-md-4 about-left">
                    <div class="appmobile"></div>
                </div>
                <div class="col-md-8 about-right">
                    <h2 class="heading text-center mb-sm-5 mb-4">ỨNG DỤNG GIÁM SÁT, CẢNH BÁO CHÁY RỪNG <br/>TỈNH NINH
                        BÌNH</h2>
                    <div class="panel-body panel_text">
                        <p style="text-align:justify;">
                            Giới thiệu ứng dụng di động NinhBinhFFW là ứng dụng phát triển trên nền tảng di động với các
                            tính năng chính:
                        </p>
                        <p style="text-align:justify;">
                            - Phát hiện các điểm cháy từ ảnh vệ tinh MODIS theo thời gian gần thực <br/>
                            - Xem bản đồ cảnh báo nguy cơ cháy rừng dựa vào điều kiện thời tiết, cấp nguy cơ cháy
                            rừng.<br>
                            - Cung cấp các công cụ xác minh thông tin điểm cảnh báo cháy, liên hệ khi phát hiện cháy
                            rừng hoặc mất rừng.<br>
                        </p>
                    </div>
                    <!-- history -->
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title asd">
                                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> PHIÊN BẢN ANDROID
                                    (CH PLAY)
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body panel_text">
                                    <a href="https://play.google.com/store/apps/details?id=com.ffwninhbinh"
                                       class="btn btn-success btn-xs"
                                       style="width: 260px; text-align:center; border: solid 1px green !important;"
                                       target="_blank">
                                        <i class="fa fa-download"></i> Cài đặt
                                    </a>
                                </div>
                            </div>
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title asd">
                                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> PHIÊN BẢN IOS (App
                                    Store)
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body panel_text">
                                    <a href="https://apps.apple.com/vn/app/ninhbinhffw/id1557493377?l=vi"
                                       class="btn btn-success btn-xs"
                                       style="width: 260px; text-align:center; border: solid 1px green !important;"
                                       target="_blank">
                                        <i class="fa fa-download"></i> Cài đặt
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@endsection