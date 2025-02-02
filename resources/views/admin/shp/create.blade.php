@extends('admin.layout.index')

@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-plus"></i> Thêm SHP file</h1>
    </div>
    <a href="admin/shp" class="btn btn-info" style="margin-left: 5px">
        <i class="fa fa-list"></i> <span>Danh Sách</span>
    </a>
</div>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        @if ($message = Session::get('err'))
        <div class="alert alert-danger mb-3">
            <p>{{ $message }}</p>
        </div>
        @endif
    </div>
    <div class="col-md-3"></div>
</div>
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <div class="text-right mb-3">
            <button type="submit" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter">
                Hướng dẫn
            </button>
        </div>

        <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Hướng dẫn</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul>
                            <li>File đầu vào phải đủ các định dạng (.dbf .prj .shp .shx)</li>
                            <li>Đúng hệ tọa độ WGS84 (EPSG:4326)</li>
                            <li>Các trường thuộc tính phải có bao gồm: [
                                1. tt,
                                2. matinh,
                                3. mahuyen,
                                4. maxa,
                                5. xa,
                                6. tk,
                                7. khoanh,
                                8. lo,
                                9. thuad,
                                10. tobando,
                                11. ddanh,
                                12. dtich,
                                13. dientichch,
                                14. nggocr,
                                15. ldlr,
                                16. maldlr,
                                17. sldlr,
                                18. namtr,
                                19. captuoi,
                                20. ktan,
                                21. nggocrt,
                                22. thanhrung,
                                23. mgo,
                                24. mtn,
                                25. mgolo,
                                26. mtnlo,
                                27. lapdia,
                                28. malr3,
                                29. mdsd,
                                30. mamdsd,
                                31. dtuong,
                                32. churung,
                                33. machur,
                                34. trchap,
                                35. quyensd,
                                36. thoihansd,
                                37. khoan,
                                38. nqh,
                                39. nguoink,
                                40. nguoitrch,
                                41. mangnk,
                                42. mangtrch,
                                43. ngsinh,
                                44. kd,
                                45. vd,
                                46. capkd,
                                47. capvd,
                                48. locu,
                                49. vitrithua,
                                50. tinh,
                                51. huyen
                                ]
                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

        <form action="admin/shp/store" method="post" class="custom-form" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Loại shapefile</label>
                <div class="col-sm-10">
                    <select name="type" class="form-control form-control-inverse js-example-basic-single" required>
                        <option value="">[Chọn loại shapefile]</option>
                        <option value="churung">Chủ Rừng</option>
                        <option value="tinh">Tỉnh</option>
                        <option value="huyen">Huyện</option>
                        <option value="xa">Xã</option>

                    </select>
                </div>
                <div class="image-container mx-auto mt-2"></div>
                <span class="text-danger">@error('file')
                    {{ $message }}
                    @enderror</span>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Chọn shapefile</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control input-image-show" name="file[]" multiple required>
                </div>
                <div class="image-container mx-auto mt-2"></div>
                <span class="text-danger">@error('file')
                    {{ $message }}
                    @enderror</span>
            </div>

            <div class="form-group d-flex d-flex justify-content-between ">
                <button class="btn btn-success waves-effect waves-light" type="submit">Thêm mới</button>
            </div>
        </form>
    </div>
    <div class="col-sm-3"></div>
</div>
@endsection