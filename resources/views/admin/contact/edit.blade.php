@extends('admin.layout.index')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-edit"></i> Sửa thông tin</h1>
        </div>
        <a href="admin/contact/list" class="btn btn-info" style="margin-left: 5px">
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
            <form action="admin/contact/edit/{{$tk->id}}" method="post" class="custom-form">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
				@if(Auth::user()->role == 1)
                    <div class="form-group">
                        <label>Huyện:</label>
                        <select class="form-control" name="mahuyen" id="district">
                            @foreach($district as $dt)
                                <option value="{{$dt->mahuyen}}"
                                        @if($tk->mahuyen == $dt->mahuyen) selected @endif>{{$dt->huyen}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                @if(Auth::user()->role == 2)
                    <div class="form-group">
                        <label>Huyện:</label>
                        <select class="form-control" name="mahuyen" required id="district">
                            <option value="415" @if($tk->mahuyen == 415) selected @endif>Huyện Quế Phong
                            </option>
                            <option value="416" @if($tk->mahuyen == 416) selected @endif>Huyện Quỳ Châu
                            </option>
                        </select>
                    </div>
                @endif
                <div class="form-group">
                    <label>Họ tên:</label>
                    <input type="text" value="{{$tk->name}}" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label>Chức vụ:</label>
                    <input type="text" value="{{$tk->position}}" class="form-control" name="position">
                </div>
                <div class="form-group">
                    <label>Phòng ban:</label>
                    <input type="text" value="{{$tk->department}}" class="form-control" name="department">
                </div>
                <div class="form-group">
                    <label>Điện thoại:</label>
                    <input type="text" value="{{$tk->phone}}" class="form-control" name="phone">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" value="{{$tk->email}}" class="form-control" name="email">
                </div>
                <div class="form-group" style="text-align: center">
                    <button type="submit" class="btn btn-primary">Sửa</button>
                </div>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>
@endsection

