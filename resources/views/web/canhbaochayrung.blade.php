@extends('web.layout.layout_map')
@section('head')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuRWIozMKFbaB82wW1NqRvBGcF8_q_fSg"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet-src.js"></script>
<script src="https://unpkg.com/leaflet.gridlayer.googlemutant@latest/dist/Leaflet.GoogleMutant.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.5.0/ui-bootstrap-tpls.min.js"></script>
@endsection
@section('content')
<style>
    .leaflet-bottom.leaflet-right {
        display: none;
    }

    .leaflet-bottom.leaflet-left {
        display: none;
    }
</style>
<div id="Application" class="ng-scope">
    <div class="container-fluid">
        <h5></h5>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                @if (session('thongbao'))
                <div id="close_success" class="alert alert-success alert-dismissible"
                    style="height: 40px; line-height: 40px">
                    <a class="close" id="click_close_success">&times;</a>
                    {{session('thongbao')}}
                </div>
                @endif
            </div>
            <div class="col-sm-3"></div>
        </div>

        <ul class="nav nav-pills categorypicker-major">
            <li class="ng-scope" id="date_op">
                <select class="form-control" id="date_chon">
                    <option disabled>[Thời gian]</option>
                    <option selected> 31-12-2023</option>
                </select>
            </li>

            <li class="ng-scope">
                <select class="form-control" id="province">
                    <option disabled value="">[Chọn Huyện/Thành phố]</option>
                    <option selected value="35">35 - Tỉnh HÀ NAM</option>
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

            <li class="ng-scope">
                <button class="form-control" id="btnClear"><i class="fa fa-refresh"></i></button>
            </li>

        </ul>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="bangdieukhien">LỚP BẢN ĐỒ TÀI NGUYÊN RỪNG</h4>
                <div style="margin-left: 18px;">
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="bandoDBR">
                        <label class="form-check-label" style="font-weight: normal;">Hiện trạng rừng</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="bandoCapChay">
                        <label class="form-check-label" style="font-weight: normal;"> Cấp cháy</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="diemChay" checked>
                        <label class="form-check-label" style="font-weight: normal;">Điểm nguy cơ cháy rừng</label>
                    </div>

                </div>
                <ul class="nav nav-tabs nav-justified">
                    <li id="tttrangthairung" class="active">
                        <a data-toggle="tab" href="#conditionals">Thông tin trạng thái rừng</a>
                    </li>
                    <li id="tracuudiemchay">
                        <a data-toggle="tab" href="#verification">Thông tin điểm cháy</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="conditionals" class="tab-pane fade in active">
                        <h4 class="bangdieukhien">THÔNG TIN TRẠNG THÁI RỪNG</h4>
                        <div class="form-check table-responsive" style="height : 60vh ; overflow-y: scroll">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" class="col-6 col-lg-4">Thuộc tính</th>
                                        <th scope="col" class="col-12 col-sm-6 col-lg-8">Thông tin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Xã - Huyện</th>
                                        <td id="xaHuyen"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Tiểu khu/Khoảnh/Lô</th>
                                        <td id="tkKhoanhLo"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Chủ rừng</th>
                                        <td id="chuRung"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Trạng thái rừng</th>
                                        <td id="trangThaiRung"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Loài cây/Cấp tuổi/Năm trồng</th>
                                        <td id="loaiCayNamtrg"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Diện tích</th>
                                        <td id="dtich"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Trữ lượng</th>
                                        <td id="truLuong"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Số cây tre/nứa</th>
                                        <td id="mtn"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Ba loại rừng</th>
                                        <td id="malr3"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Lập địa</th>
                                        <td id="lapDia"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Mục đích sử dụng</th>
                                        <td id="mamdsd"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nhiệt độ</th>
                                        <td id="nhietDo"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Độ ẩm</th>
                                        <td id="doAm"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Lượng mưa</th>
                                        <td id="mua"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Chỉ số P</th>
                                        <td id="chisoP"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="verification" class="tab-pane fade">
                        <h4 class="bangdieukhien">LỊCH SỬ ĐIỂM CHÁY</h4>
                        <div style="margin-left: 18px;">
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" id="24h" checked>
                                <label class="form-check-label" style="font-weight: normal;">24h qua</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" id="history">
                                <label class="form-check-label" style="font-weight: normal;">Lịch sử theo thời
                                    gian</label>
                            </div>
                            <div class="row hidden" id="selectDate">
                                <div class="col-md-6">
                                    <label>Từ ngày</label><br>
                                    <input class="form-control" type="date" name="startDate" id="startDate"
                                        onchange="loadData();" value="" />
                                </div>
                                <div class="col-md-6">
                                    <label>Đến ngày</label><br>
                                    <input class="form-control" type="date" name="endDate" id="endDate"
                                        onchange="loadData();" value="" />
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-check table-responsive" id="infoFirePoint"
                            style="max-height: 550px; overflow: scroll;">
                        </div>
                    </div>
                </div>
            </div>

            <div id="formVerify" class="modal" style="display: @if (count($errors)>0) block @else none @endif;">
                <div class="modal-dialog">
                    <div class="modal-content" style="min-height: 600px;">
                        <div class="modal-header">
                            <button type="button" id="closeModal" class="close">&times;</button>
                            <h3 class="modal-title">Xác minh</h3>
                        </div>
                        <div class="modal-body" style="max-height: 600px; overflow-y: scroll">
                            <form id="submitVerify" action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                <div class="form-group">
                                    <label style="padding-right: 5px"><input type="radio" name="fire" value="2"
                                            id="isFireCheck" class="form-check"> Cháy rừng</label>
                                    <label><input type="radio" name="fire" value="4" class="form-check"
                                            id="isNotFireCheck"> Có cháy nhưng không phải cháy rừng</label>
                                    <label style="padding-right: 5px"><input type="radio" name="fire" value="3"
                                            class="form-check" checked id="isFireNotFireForest"> Không phải cháy
                                        rừng</label>

                                </div>
                                <div id="formValHandle" class="alert alert-danger" style="display: none;"></div>
                                <div id="verificationFire" ng-model="notFire">
                                    <fieldset>
                                        <div class="form-group">
                                            <label>Mô tả hiện trạng:</label>
                                            <textarea name="mota" class="form-control" required></textarea>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group" id="huongphoi" style="display: none;">
                                            <label>Hướng Phơi:</label>
                                            <input type="text" class="form-control" name="huongphoi">
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group" id="dientich" style="display: none;">
                                            <label>Ước lượng diện tích đám cháy (m²):</label>
                                            <input type="number" class="form-control" name="dtdamchay" placeholder="Nhập Số">
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group" id="khoangcach" style="display: none;">
                                            <label>Khoảng cách từ vị trí đứng đến vị trí báo (km):</label>
                                            <input type="number" class="form-control" step="any" name="khoangcach" placeholder="Nhập Số">
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group">
                                            <label>Upload file ảnh:</label>
                                            <input type="file" name="hinhanh" accept=".jpg, .jpeg, .png, .JPG, .JPEG, .PNG"/>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div id="status" class="form-group" style="display: none;">
                                            <div class="form-group">
                                                <label>Tình trạng:</label>
                                                <br>
                                                <label style="padding-right: 5px"><input type="radio" name="handle"
                                                        class="form-check" value="1"> Đã dập tắt</label>
                                                <label><input type="radio" name="handle" class="form-check" value="0"
                                                        checked> Chưa dập tắt</label>
                                            </div>
                                            <div id="handleTime">
                                                <div class="form-group">
                                                    <label>Thời gian dập tắt (giờ):</label>
                                                    <input type="time" class="form-control" step="any"
                                                        name="time_handle">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                <div id="infoPerson">
                                    <fieldset>
                                        <legend style="margin-top: 20px; margin-bottom: 0!important;">Thông tin người
                                            xác nhận:</legend>
                                        <div class="form-group"></div>
                                        <label>Họ tên:</label>
                                        <input type="text" class="form-control" required name="username">
                                        <div class="clearfix"></div>
                                        <div class="form-group">
                                            <label>Số điện thoại:</label>
                                            <input type="text" class="form-control" required name="userphone">
                                        </div>
                                    </fieldset>
                                </div>
                                <br>
                                <div class="form-group" style="text-align: center;">
                                    <input type="submit" class="btn-primary" value="Gửi xác nhận">
                                    <input type="button" class="btn-danger" id="cancelVerify" value="Hủy xác nhận">
                                </div>
                                @if (count($errors)>0)
                                <div id="close_err" class="alert alert-danger alert-dismissible">
                                    <a class="close" id="click_close_err">&times;</a>
                                    @foreach ($errors->all() as $err)
                                    {{$err}}<br>
                                    @endforeach
                                </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <h4 class="bangdieukhien">BẢN ĐỒ HIỆN TRẠNG RỪNG</h4>
                <img style="height: 12vh; bottom: 0; position: absolute; z-index: 2; margin-bottom: 20px ; margin-left: 10px; visibility: hidden"
                    src="web/images/fireWarningIcon/alarm.png" id="fireWarningImg">
                <div id="map" tabindex="0" style="height: 78vh; top: 0; position: relative; z-index: 1">
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('script')
<script src="web/js/map.js"></script>
<script>
    $('#confirm-verify').on('show.bs.modal', function (e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
</script>
@endsection