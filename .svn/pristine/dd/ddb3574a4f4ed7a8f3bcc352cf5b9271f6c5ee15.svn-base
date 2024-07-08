<h4 class="bangdieukhien text-center">BIỂU 6: DIỆN TÍCH RỪNG TRỒNG PHÂN THEO LOÀI CÂY CẤP TUỔI</h4>
<div class="form-check table-responsive">
    <table class="table table-bordered table-sm">
        <thead>
        <tr class="active">
            <th scope="col" rowspan="2" class="text-center">TT</th>
            <th scope="col" rowspan="2" class="text-center">Loài cây</th>
            <th scope="col" rowspan="2" class="text-center">Tổng diện tích <br/>rừng trồng</th>
            <th scope="col" colspan="6" class="text-center">Diện tích đã thành rừng phân theo cấp tuổi</th>
            <th scope="col" rowspan="2" class="text-center">Diện tích <br/>chưa thành rừng</th>
        </tr>
        <tr class="active">
            <th scope="col" class="text-center">Tổng</th>
            <th scope="col" class="text-center">Cấp tuổi 1</th>
            <th scope="col" class="text-center">Cấp tuổi 2</th>
            <th scope="col" class="text-center">Cấp tuổi 3</th>
            <th scope="col" class="text-center">Cấp tuổi 4</th>
            <th scope="col" class="text-center">Cấp tuổi 5</th>
        </tr>
        </thead>
        <tbody>
        <tr class="warning">
            <th scope="row" class="text-center"></th>
            <td class="text-center"><strong class="text-danger">TỔNG</strong></td>
            @foreach($tong as $t)
                @if($t == 0)
                    <td> -</td>
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
                            <td> -</td>
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