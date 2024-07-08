@extends('admin.layout.index')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-download"></i> Tải về dữ liệu</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="tab-content" id="myTabContent">
                <br>
                <div class="tab-pane fade show active">
                    <form class="custom-form">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>&nbsp; Chọn loại dữ liệu tải về:</label>
                            <select class="form-control" id="typeData" name="typeData" onchange="loadView();">
                                <option value="1">Dữ liệu thời tiết</option>
                                <option value="2">Dữ liệu điểm cháy</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>&nbsp;Thời gian bắt đầu:</label>
                            <input type="date" name="timeStart" id="timeStart" class="form-control" onchange="loadView();"/>
                        </div>
                        <div class="form-group">
                            <label>&nbsp;Thời gian kết thúc:</label>
                            <input type="date" name="timeEnd" id="timeEnd" class="form-control" onchange="loadView();"/>
                        </div>
                        <div clss="form-group" style="text-align: center">
                            <button type="button" id="export" class="btn btn-primary "><i
                                    class="fa fa-download"></i>Tải về
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div id="error_show" class="page-error border border-light bg-light">
                <h2 style="color: red">Không tìm thấy dữ liệu xem trước</h2>
            </div>
            <iframe id="frame" style="border: 0; padding: 0; margin: 0; height:90vh; width:50vw"
                    src=''
                    frameborder='0'></iframe>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url_download = "";

        function loadView() {
            var typeData = $('#typeData').val();
            var timeStart = $('#timeStart').val();
            var timeEnd = $('#timeEnd').val();
            if (timeEnd >= timeStart) {
                if (typeData == 1) {
                    $.ajax({
                        type: 'GET',
                        url: 'admin/Weather/export',
                        data: {timeStart: timeStart, timeEnd: timeEnd},
                        success: function (data) {
                            if (data == '0') {
                                $('#error_show').show();
                            } else {
                                url_download = data;
                                $('#frame').attr('src', "https://docs.google.com/viewer?url=http://giamsatrunghanam.xuanmaijsc.vn/" + data + "&embedded=true");
                                $('#error_show').hide();
                            }
                        }
                    });
                } else {
                    $.ajax({
                        type: 'GET',
                        url: 'admin/Hotspot/export',
                        data: {timeStart: timeStart, timeEnd: timeEnd},
                        success: function (data) {
                            if (data == '0') {
                                $('#error_show').show();
                            } else {
                                url_download = data;
                                $('#frame').attr('src', "https://docs.google.com/viewer?url=http://giamsatrunghanam.xuanmaijsc.vn/" + data + "&embedded=true");
                                $('#error_show').hide();
                            }
                        }
                    });
                }
            }
        }

        $('#export').click(function (e) {
            var timeStart = $('#timeStart').val();
            var timeEnd = $('#timeEnd').val();
            if (timeEnd >= timeStart) {
                e.preventDefault();
                window.location.href = url_download;
            }
        })
    </script>
@endsection
