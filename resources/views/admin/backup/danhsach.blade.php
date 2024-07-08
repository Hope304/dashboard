@extends('admin.layout.index')

@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-list-alt"></i> Danh sách backup</h1>
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
                <th>Thời gian tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1 @endphp
            @foreach($data as $item)
            <tr>
                <td style="text-align: center">{{$item->created_at}}</td>
                <td style="text-align: center">
                    <a href="#!" data-toggle="modal" data-href="/admin/backup/restore/{{$item->id}}"
                        data-target="#restore-item-model" class="btn btn-warning btn-sm"><i class="fa fa-sync"></i> Khôi
                        Phục</a>
                    <a href="#!" data-toggle="modal" data-id="{{ $item->id }}" data-target="#delete-item-model"
                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xoá</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="restore-item-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                <p>Xác nhận khôi phục backup này ?</p>
            </div>
            <div class="modal-footer">
                <a id="btn-restore-item" class="btn btn-warning btn-restore">Sử dụng</a>
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
            deleteForm.action = "/admin/backup/destroy/" + id;
            deleteForm.submit();
        }

        $('#restore-item-model').on('show.bs.modal', function (e) {
        $(this).find('.btn-restore').attr('href', $(e.relatedTarget).data('href'));
    });
    });
</script>
@endsection