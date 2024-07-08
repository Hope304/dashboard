@extends('admin.layout.index')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-cog"></i> Điều chỉnh cấp cháy</h1>
        </div>
        <a href="admin/home" class="btn btn-info" style="margin-left: 5px">
            <i class="fa fa-star"></i> <span>Cấp nguy cơ cháy</span>
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
            @if (session('baoloi'))
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{session('baoloi')}}
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
            <form action="admin/dieuchinhcapchay" method="post" class="custom-form" id="post_form">
                @csrf
                <div class="form-group">
                    <label>Chọn huyện:</label>
                    <select name="mahuyen" id="mahuyen" class="form-control">
                        <option value="">[Chọn huyện]</option>
                        @foreach ($data as $item)
                            <option value="{{ $item->mahuyen }}">{{ App\District::where('mahuyen', $item->mahuyen)->first()->huyen }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Cấp cháy:</label>
                    <input type="number" class="form-control" name="capchay" id="capchay" placeholder="Nhập cấp cháy 1-5" min="1" max="5">
                </div>
                <div class="form-group" style="text-align: center">
                    <button type="button" class="btn btn-primary btn_submit">Thực hiện</button>
                </div>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function(){
            $('.btn_submit').click(function(){
                var mahuyen = $('#mahuyen').val();
                var capchay = $('#capchay').val();
                if(capchay == null || mahuyen == null || capchay =='' || mahuyen==''){
                    alert('Vui lòng chọn huyện và nhập cấp cháy!');
                    return;
                }

                if(capchay < 1 || capchay > 5){
                    alert('Cấp cháy không hợp lệ');
                    return;
                }

                $('#post_form').submit();
            })
        })
    </script>
@endsection
