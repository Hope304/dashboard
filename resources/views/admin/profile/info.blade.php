@extends('admin.layout.index')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-eye"></i> Thông tin cá nhân</h1>
        </div>
        <a href="admin/profile/edit/{{$tk->id}}" class="btn btn-info" style="margin-left: 5px">
            <i class="fa fa-user"></i> <span>Sửa thông tin</span>
        </a>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
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
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{$tk->id}}</td>
                    </tr>
                    <tr>
                        <th>Tên</th>
                        <td>{{$tk->name}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{$tk->email}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
@endsection
