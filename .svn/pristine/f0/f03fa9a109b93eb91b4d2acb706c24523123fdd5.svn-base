@extends('admin.layout.index')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-edit"></i> Sửa thông tin</h1>
        </div>
        <a href="admin/profile/{{$tk->id}}" class="btn btn-info" style="margin-left: 5px">
            <i class="fa fa-user"></i> <span>Xem thông tin</span>
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
            <form action="admin/profile/edit/{{$tk->id}}" method="post" class="custom-form">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <div class="form-group">
                    <label>Họ Tên:</label>
                    <input type="text" class="form-control" value="{{$tk->name}}" name="name">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" class="form-control" value="{{$tk->email}}" name="email">
                </div>
                <div class="form-group" style="text-align: center">
                    <button type="submit" class="btn btn-primary">Sửa thông tin</button>
                </div>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>
@endsection
