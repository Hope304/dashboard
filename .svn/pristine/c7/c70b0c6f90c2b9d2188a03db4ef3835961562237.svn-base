@extends('web.layout.index')
@section('content')
    <div style="min-height: 62vh">
        <div class="container-fluid" style="margin-bottom: 20px;">
            <h5></h5>
            <ul class=" nav nav-pills categorypicker-major">
                <li class="ng-scope" id="date_op">
                    <select class="form-control">
                        <option value="2023-12-31">31/12/2023</option>
                    </select>
                </li>

                <li class="ng-scope">
                    <select class="form-control" id="province">
                        <option value="35">35 - Tỉnh HÀ NAM</option>
                    </select>
                </li>

                <li class="ng-scope">
                    <select class="form-control" id="district">
                        <option disabled selected value="">[Chọn Huyện/Thành phố]</option>
                    </select>
                </li>

                <li class="ng-scope">
                    <select class="form-control" id="commune">
                        <option disabled selected value="">[Chọn Xã/Phường]</option>
                    </select>
                </li>
            </ul>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-1">
                    <h4 style="text-align:center" class="bangdieukhien">BÁO CÁO</h4>
                    <ul class="nav nav-pills nav-stacked">
                        <li class="alert" id="bieu1"><a><i
                                        class="fa fa-list-alt"></i> Biểu 1</a></li>
                        <li class="alert" id="bieu2"><a><i
                                        class="fa fa-list-alt"></i> Biểu 2</a></li>
                        <li class="alert" id="bieu3"><a><i
                                        class="fa fa-list-alt"></i> Biểu 3</a></li>
                        <li class="alert" id="bieu4"><a><i
                                        class="fa fa-list-alt"></i> Biểu 4</a></li>
                        <li class="alert" id="bieu5"><a><i
                                        class="fa fa-list-alt"></i> Biểu 5</a></li>
                        <li class="alert" id="bieu6"><a><i
                                        class="fa fa-list-alt"></i> Biểu 6</a></li>
                        <li class="alert" id="bieu7"><a><i
                                        class="fa fa-list-alt"></i> Biểu 7</a></li>
                    </ul>
                </div>
                <div class="col-sm-11 table_data">
                    <div class="loading" style="display: block"></div>
                    <div id="data"></div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        var url = '/matinh/35';
        var bieu = 'bieu1';
        var base = 'ThongKeBaoCao/';
        var xhr = null;
        $('#bieu1').addClass('active');
        $(document).ready(function () {
            xhr = $.ajax({
                type: 'GET',
                url: base + bieu + url,
                success: function (data) {
                    $('#data').html(data);
                    $('.loading').css('display', 'none');
                }
            });

            $.ajax({
                type: 'GET',
                url: 'district/35',
                success: function (data) {
                    $('#district').html(data);
                }
            });
        });

        $('#district').change(function () {
            xhr.abort();
            $('#data').html('');
            $('.loading').css('display', 'block');
            mahuyen = $('#district').val();
            url = '/mahuyen/' + mahuyen;
            $.ajax({
                type: 'GET',
                url: 'commune/' + mahuyen,
                success: function (data) {
                    $('#commune').html(data);
                }
            });


            xhr = $.ajax({
                type: 'GET',
                url: base + bieu + url,
                success: function (data) {
                    $('#data').html(data);
                    $('.loading').css('display', 'none');
                }
            });
        })

        $('#commune').change(function () {
            xhr.abort();
            $('#data').html('');
            $('.loading').css('display', 'block');
            maxa = $('#commune').val();
            url = '/maxa/' + maxa;
            xhr = $.ajax({
                type: 'GET',
                url: base + bieu + url,
                success: function (data) {
                    $('#data').html(data);
                    $('.loading').css('display', 'none');
                }
            });
        })

        $('#bieu1').click(function () {
            xhr.abort();
            bieu = 'bieu1';
            $('#data').html('');
            $('.loading').css('display', 'block');
            $('#bieu1').addClass('active');
            $('#bieu2').removeClass('active');
            $('#bieu3').removeClass('active');
            $('#bieu4').removeClass('active');
            $('#bieu5').removeClass('active');
            $('#bieu6').removeClass('active');
            $('#bieu7').removeClass('active');
            xhr = $.ajax({
                type: 'GET',
                url: base + bieu + url,
                success: function (data) {
                    $('#data').html(data);
                    $('.loading').css('display', 'none');
                }
            });
        })

        $('#bieu2').click(function () {
            xhr.abort();
            bieu = 'bieu2';
            $('#data').html('');
            $('.loading').css('display', 'block');
            $('#bieu2').addClass('active');
            $('#bieu1').removeClass('active');
            $('#bieu3').removeClass('active');
            $('#bieu4').removeClass('active');
            $('#bieu5').removeClass('active');
            $('#bieu6').removeClass('active');
            $('#bieu7').removeClass('active');
            xhr = $.ajax({
                type: 'GET',
                url: base + bieu + url,
                success: function (data) {
                    $('#data').html(data);
                    $('.loading').css('display', 'none');
                }
            });
        })

        $('#bieu3').click(function () {
            xhr.abort();
            bieu = 'bieu3';
            $('#data').html('');
            $('.loading').css('display', 'block');
            $('#bieu3').addClass('active');
            $('#bieu2').removeClass('active');
            $('#bieu1').removeClass('active');
            $('#bieu4').removeClass('active');
            $('#bieu5').removeClass('active');
            $('#bieu6').removeClass('active');
            $('#bieu7').removeClass('active');
            xhr = $.ajax({
                type: 'GET',
                url: base + bieu + url,
                success: function (data) {
                    $('#data').html(data);
                    $('.loading').css('display', 'none');
                }
            });
        })

        $('#bieu4').click(function () {
            xhr.abort();
            bieu = 'bieu4';
            $('#data').html('');
            $('.loading').css('display', 'block');
            $('#bieu4').addClass('active');
            $('#bieu2').removeClass('active');
            $('#bieu3').removeClass('active');
            $('#bieu1').removeClass('active');
            $('#bieu5').removeClass('active');
            $('#bieu6').removeClass('active');
            $('#bieu7').removeClass('active');
            xhr = $.ajax({
                type: 'GET',
                url: base + bieu + url,
                success: function (data) {
                    $('#data').html(data);
                    $('.loading').css('display', 'none');
                }
            });
        })

        $('#bieu5').click(function () {
            xhr.abort();
            bieu = 'bieu5';
            $('#data').html('');
            $('.loading').css('display', 'block');
            $('#bieu5').addClass('active');
            $('#bieu2').removeClass('active');
            $('#bieu3').removeClass('active');
            $('#bieu4').removeClass('active');
            $('#bieu1').removeClass('active');
            $('#bieu6').removeClass('active');
            $('#bieu7').removeClass('active');
            xhr = $.ajax({
                type: 'GET',
                url: base + bieu + url,
                success: function (data) {
                    $('#data').html(data);
                    $('.loading').css('display', 'none');
                }
            });
        })

        $('#bieu6').click(function () {
            xhr.abort();
            bieu = 'bieu6';
            $('#data').html('');
            $('.loading').css('display', 'block');
            $('#bieu6').addClass('active');
            $('#bieu2').removeClass('active');
            $('#bieu3').removeClass('active');
            $('#bieu4').removeClass('active');
            $('#bieu5').removeClass('active');
            $('#bieu1').removeClass('active');
            $('#bieu7').removeClass('active');
            xhr = $.ajax({
                type: 'GET',
                url: base + bieu + url,
                success: function (data) {
                    $('#data').html(data);
                    $('.loading').css('display', 'none');
                }
            });
        })

        $('#bieu7').click(function () {
            xhr.abort();
            bieu = 'bieu7';
            $('#data').html('');
            $('.loading').css('display', 'block');
            $('#bieu7').addClass('active');
            $('#bieu2').removeClass('active');
            $('#bieu3').removeClass('active');
            $('#bieu4').removeClass('active');
            $('#bieu5').removeClass('active');
            $('#bieu6').removeClass('active');
            $('#bieu1').removeClass('active');
            xhr = $.ajax({
                type: 'GET',
                url: base + bieu + url,
                success: function (data) {
                    $('#data').html(data);
                    $('.loading').css('display', 'none');
                }
            });
        })

    </script>
@endsection