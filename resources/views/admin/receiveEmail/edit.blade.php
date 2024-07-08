@extends('admin.layout.index')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-edit"></i> Sửa thông tin đăng ký dịch vụ</h1>
        </div>
        <a href="admin/receiveEmail/list" class="btn btn-info" style="margin-left: 5px">
            <i class="fa fa-list"></i> <span>Danh Sách</span>
        </a>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            @if (count($errors)>0)
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    @foreach ($errors->all() as $err)
                        {{$err}}<br>
                    @endforeach
                </div>
            @endif
            @if (session('thongbao'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{session('thongbao')}}
                </div>
            @endif
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <form action="admin/receiveEmail/edit/{{$data->id}}" method="post" class="custom-form">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <div class="form-group">
                    <label>Họ tên:</label>
                    <input type="text" class="form-control" value="{{$data->name}}" name="name">
                </div>
                <div class="form-group">
                    <label>Đơn vị:</label>
                    <input type="text" class="form-control" value="{{$data->unit}}" name="unit">
                </div>
                <div class="form-group">
                    <label>Chức vụ:</label>
                    <input type="text" class="form-control" value="{{$data->position}}" name="position">
                </div>
                <div class="form-group">
                    <label>Điện thoại:</label>
                    <input type="text" class="form-control" value="{{$data->phone}}" name="phone">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" class="form-control" value="{{$data->email}}" name="email">
                </div>
                <div class="form-group">
                    <label>Huyện:</label>
                    <select class="form-control" name="district" id="district">
                        @foreach($district as $dt)
                            <option value="{{$dt->mahuyen}}" @if($data->commune->district->mahuyen == $dt->mahuyen) selected @endif>{{$dt->huyen}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Xã:</label>
                    <select class="form-control" name="commune" id="commune">

                    </select>
                </div>

                <label>Đăng ký dịch vụ:</label><br>
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" @if($data->firelevel == 1) checked @endif name="regFirelevel" class="form-check-inline"> Nhận mail cấp cháy hàng ngày
                    </div>
                    <div class="form-check">
                        <input type="checkbox" @if($data->verification == 1) checked @endif name="regVerify" class="form-check-inline"> Nhận mail khi có người xác minh
                    </div>
                    <div class="form-check">
                        <input type="checkbox" @if($data->hotspot == 1) checked @endif name="regHostpot" class="form-check-inline"> Nhận email khi có hotspot mới từ nasa
                    </div>
                </div>
                <div class="form-group" style="text-align: center">
                    <button type="submit" class="btn btn-primary">Sửa thông tin</button>
                </div>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>
@endsection
@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $mahuyen = $('#district').val();
            $maxa = {{$data->maxa}};
            $.ajax({
                type: 'GET',
                url: 'ajax/getCommune/',
                data: {mahuyen: $mahuyen, maxa: $maxa},
                success: function (data) {
                    $('#commune').html(data);
                }
            });
        });

        $('#district').on('change', function () {
            $mahuyen = $('#district').val();
            $.ajax({
                type: 'GET',
                url: 'ajax/getCommune/',
                data: {mahuyen: $mahuyen},
                success: function (data) {
                    $('#commune').html(data);
                }
            });
        });
    </script>
@endsection

