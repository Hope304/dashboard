<h4 class="bangdieukhien text-center">BIỂU 5: TỔNG HỢP DIỆN TÍCH RỪNG PHÂN THEO ĐƠN VỊ HÀNH CHÍNH</h4>
    <div class="form-check table-responsive">
        <table class="table table-bordered table-sm">
            <thead>
            <tr class="active">
                <th scope="col" rowspan="3" class="text-center">TT</th>
                <th scope="col" rowspan="3" class="text-center">Đơn vị hành chính</th>
                <th scope="col" rowspan="3" class="text-center">Tổng diện tích <br/>có rừng</th>
                <th scope="col" colspan="6" class="text-center">Diện tích trong quy hoạch 3 loại rừng</th>
                <th scope="col" rowspan="3" class="text-center">Diện tích <br/>ngoài 3 loại rừng</th>
            </tr>
            <tr class="active">
                <th scope="col" rowspan="2" class="text-center">Tổng diện tích <br/>trong QH3LR</th>
                <th scope="col" colspan="2" class="text-center">Chia theo nguồn gốc</th>
                <th scope="col" colspan="3" class="text-center">Chia theo mục đích sử dụng</th>
            </tr>
            <tr class="active">
                <th scope="col" class="text-center">Rừng tự nhiên</th>
                <th scope="col" class="text-center">Rừng trồng</th>
                <th scope="col" class="text-center">Đặc dụng</th>
                <th scope="col" class="text-center">Phòng hộ</th>
                <th scope="col" class="text-center">Sản xuất</th>
            </tr>
            </thead>
            <tbody>
            <tr class="warning">
                <th scope="row" class="text-center"></th>
                <td class="text-center"><strong class="text-danger">[Tổng]</strong></td>
                @foreach($tong as $t)
                    @if($t == 0)
                        <td> - </td>
                    @else
                    <td>{{number_format($t, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            </tr>
            @php $i = 1 @endphp
            @foreach($data as $dt)
                <tr>
                    <th scope="row" class="text-center">{{$i++}}</th>
                    @for($j = 0; $j<count($dt); $j++)
                        @if($j ==0)
                            <td>{{$dt[$j]}}</td>
                        @else
                            @if($dt[$j] == 0)
                                <td> - </td>
                            @else
                                <td>{{number_format($dt[$j], 2, ',', '.')}}</td>
                            @endif
                        @endif
                    @endfor
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>