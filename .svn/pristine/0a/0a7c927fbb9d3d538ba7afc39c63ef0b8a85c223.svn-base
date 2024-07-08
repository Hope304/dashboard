@extends('admin.layout.index')

@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-list-alt"></i> Quản lý SHP file</h1>
    </div>
    <a href="admin/shp/create" class="btn btn-success">
        <i class="fa fa-plus"></i> <span>Thêm</span>
    </a>
</div>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        @if ($message = Session::get('success'))
        <div class="alert alert-success m-2">
            <p>{{ $message }}</p>
        </div>
        @endif
        @if ($message = Session::get('err'))
        <div class="alert alert-danger m-2">
            <p>{{ $message }}</p>
        </div>
        @endif
    </div>
    <div class="col-md-3"></div>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-hover" id="dataTables">
        <thead>
            <tr class="bg-primary" style="color: #fff">
                <th>Tệp tin</th>
                <th>Loại Shapefile</th>
                <th>Thời gian tạo</th>
                <th>Trạng thái</th>
                <th style="text-align: center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{$item->ten}}</td>
                <td class="text-center">
                    @php
                    if ($item->churung != null) {
                    echo 'Chủ rừng';
                    }else if($item->huyen != null){
                    echo 'Huyện';
                    }else if($item->xa != null){
                    echo 'Xã';
                    }else{
                        echo 'Tỉnh';
                    }
                    @endphp
                </td>
                <td class="text-center">{{Date('d-m-Y H:i:s', strtotime($item->ngaytao))}}</td>
                <td class="text-center">
                    @php
                    if ($item->status == 1) {
                    echo '<i style="margin:0;">Chờ phê duyệt</i>';
                    }else if($item->status == 2){
                    echo 'Đã kiểm duyệt';
                    }else if($item->status == 3){
                    echo 'Đang sử dụng';
                    }else if($item->status == 0){
                    echo '<i style="margin:0; color:red;">Bị từ chối</i>';
                    }
                    @endphp
                </td>
                <td style="text-align: center">
                    @php
                    $user_info = App\User::findOrFail(Auth::user()->id);
                    @endphp
                    <a target="_blank" class="btn btn-sm btn-outline-info" type="submit"
                        href="/admin/shp/bando/{{$item->id}}"><i class="fa fa-eye" aria-hidden="true"></i> Bản đồ</a>

                    @if ($user_info->role == 'admin' && $item->status == 1)
                    <a href="#!" data-toggle="modal" data-href="/admin/shp/approve/{{$item->id}}"
                        data-target="#approve-item-model" class="btn btn-outline-success btn-sm"><i
                            class="fa fa-check"></i> Phê duyệt</a>
                    @endif

                    @if ($user_info->role == 'admin' && $item->status == 1)
                    <a href="#!" data-toggle="modal" data-href="/admin/shp/refuse/{{$item->id}}"
                        data-target="#refuseModal" class="btn btn-outline-danger btn-sm"><i class="fa fa-ban"
                            aria-hidden="true"></i> Từ chối</a>
                    @endif

                    @if ($user_info->role == 'admin' && ($item->status == 2 || $item->status == 3))
                    <a href="#!" data-toggle="modal" data-href="/admin/shp/use/{{$item->id}}"
                        data-target="#use-item-model" class="btn btn-warning btn-sm @if($item->status == 3) btn-outline-warning @endif"><i class="fa fa-check"></i> Sử
                        dụng</a>
                    @endif

                    @if ($user_info->role == 'admin' || $user_info->role == $item->churung || $user_info->role ==
                    $item->huyen)
                    <a href="/admin/shp/download/{{$item->id}}" title="Tải về" class="btn btn-info btn-sm">
                        <i class="fa fa-download"></i> <span class="hidden-xs hidden-sm">Tải về</span>
                    </a>
                    @endif

                    <a href="#!" data-toggle="modal" data-id="{{ $item->id }}" data-target="#delete-item-model"
                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xoá</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="approve-item-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Thông báo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Xác nhận phê duyệt shapefile này ?</p>
            </div>
            <div class="modal-footer">
                <a id="btn-approve-item" class="btn btn-warning btn-approve">Duyệt</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="refuseModal" tabindex="-1" role="dialog" aria-labelledby="refuseModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="refuseModalLabel">Từ chối SHP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="refuse_form" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Lý do từ chối:</label>
                        <textarea class="form-control" id="message-text" name="lydo" required></textarea>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-danger">Từ chối</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="use-item-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Thông báo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Xác nhận sử dụng shapefile này ?</p>
            </div>
            <div class="modal-footer">
                <a id="btn-use-item" class="btn btn-warning btn-use">Sử dụng</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete-item-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Thông báo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Xác nhận xóa hay không?</p>
            </div>
            <div class="modal-footer">
                <button id="btn-delete-item" type="button" class="btn btn-danger">Xoá bỏ</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>

<form name="delete-item-form" method="POST">
    @csrf
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var id;
        var deleteForm = document.forms['delete-item-form'];

        //lấy id để xóa
        $('#delete-item-model').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            id = button.data('id');
        })

        //xóa id
        var btn_delete_item = document.getElementById('btn-delete-item')
        btn_delete_item.onclick = function () {
            deleteForm.action = "/admin/shp/destroy/" + id;
            deleteForm.submit();
        }

        $('#use-item-model').on('show.bs.modal', function (e) {
            $(this).find('.btn-use').attr('href', $(e.relatedTarget).data('href'));
        })

        $('#approve-item-model').on('show.bs.modal', function (e) {
            $(this).find('.btn-approve').attr('href', $(e.relatedTarget).data('href'));
        })

        $('#refuseModal').on('show.bs.modal', function (e) {
            $(this).find('#refuse_form').attr('action', $(e.relatedTarget).data('href'));
        })
    });
</script>
@endsection