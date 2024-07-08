@extends('web.layout.index')
@section('content')
    <div class="banner about-banner">
        <div class="container">
            <h2>LIÊN HỆ VỚI CHÚNG TÔI</h2>
            <div class="agileits-line"> </div>
        </div>
    </div>
    <div class="contact-top">
        <div class="container">
            <div class="contact-grids">
                <div class="text-center" style="min-width: 350px; margin:0 10px;">
                    @if (count($errors)>0)
                        <div id="close_err" class="alert alert-danger alert-dismissible" style="line-height: 50px !important;">
                            <a id="click_close_err" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            @foreach ($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif
                    @if (session('thongbao'))
                        <div id="close_success" class="alert alert-success alert-dismissible"
                             style="line-height: 50px !important;">
                            <a id="click_close_success" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{session('thongbao')}}
                        </div>
                    @endif
                </div>
                <div class="col-md-7 contact-form">
                    <form action="LienHe" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <input type="text" name="Name" placeholder="Họ và tên" required="">
                        <input type="email" name="Email" placeholder="Thư điện tử" class="email" required="">
                        <textarea placeholder="Tin nhắn" name="Message" required=""></textarea>
                        <input type="submit" value="GỬI">
                    </form>
                </div>

                <div class="col-md-4 contact-right">
                    <div class="contact-text">
                        <h4>HỖ TRỢ KỸ THUẬT </h4>
                        <p>
                            <span class="glyphicon glyphicon-calendar"></span> Công ty CPTM công nghệ Xuân Mai Green (XMG)
                        </p>
                        <p><span class="glyphicon glyphicon-home"></span> Phòng Nghiên cứu và Phát triển (R&D)</p>
                        <p><span class="glyphicon glyphicon-phone-alt"></span> Điện thoại : 024.6651.5880</p>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1208.529667604808!2d105.55663108915144!3d20.887569144923923!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313445c955321305%3A0x3b9abd2ee2757bd4!2sXMG%20Happy%20Office!5e0!3m2!1svi!2s!4v1700144611385!5m2!1svi!2s" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        <div class="address agileits">
            <div class="w3ls-title">
                <h3>LIÊN HỆ VỚI CHÚNG TÔI</h3>
            </div>
            <p>Công ty CPTM công nghệ Xuân Mai Green (XMG)</p>
            <p>
                <span class="glyphicon glyphicon-home"></span> Địa chỉ: Số nhà 86, Tổ 3, Tân Mai, TT Xuân Mai, Huyện Chương Mỹ, Hà Nội.
            </p>
            <p>
                <span class="glyphicon glyphicon-phone-alt"></span> Điện thoại : 024.6651.5880
            </p>
            <p>
                <span class="glyphicon glyphicon-envelope"></span> Thư điện tử : xuanmaigreen@gmail.com 
            </p>
            <p>
                <span class="glyphicon glyphicon-globe"></span> Website: https://xuanmaijsc.vn/
            </p>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#click_close_err').click(function () {
            $('#close_err').css('display', 'none');
        });

        $('#click_close_success').click(function () {
            $('#close_success').css('display', 'none');
        });
    </script>
@endsection
