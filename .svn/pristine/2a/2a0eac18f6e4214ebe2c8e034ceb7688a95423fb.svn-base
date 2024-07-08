<h4 class="bangdieukhien text-center">BIỂU 4: TRỮ LƯỢNG RỪNG VÀ ĐẤT LÂM NGHIỆP PHÂN THEO CHỦ QUẢN LÝ</h4>
<div class="form-check table-responsive">
    <table class="table table-bordered table-sm">
        <thead>
        <tr class="active">
            <th scope="col" class="text-center">TT</th>
            <th scope="col" class="text-center">Phân loại rừng</th>
            <th scope="col" class="text-center">Mã</th>
            <th scope="col" class="text-center">Đơn vị <br/>tính</th>
            <th scope="col" class="text-center">Tổng <br/>trữ lượng</th>
            <th scope="col" class="text-center">BQL rừng <br/>đặc dụng</th>
            <th scope="col" class="text-center">BQL rừng <br/>phòng hộ</th>
            <th scope="col" class="text-center">Doanh nghiệp <br/>nhà nước</th>
            <th scope="col" class="text-center">Doanh nghiệp <br/>ngoài quốc doanh</th>
            <th scope="col" class="text-center">Doanh nghiệp <br/>100% vốn nước ngoài</th>
            <th scope="col" class="text-center">Hộ gia đình <br/>cá nhân</th>
            <th scope="col" class="text-center">Cộng đồng</th>
            <th scope="col" class="text-center">Đơn vị <br/>vũ trang</th>
            <th scope="col" class="text-center">Các tổ <br/>chức khác</th>
            <th scope="col" class="text-center">UBND xã</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row" class="text-center"></th>
            <td class="text-center"><strong class="text-danger">TỔNG</strong></td>
            <td></td>
            <td></td>
            @foreach($total as $t)
                @if($t == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($t, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr class="info">
            <th scope="row" class="text-center">A</th>
            <td class="td_left"><strong>TRỮ LƯỢNG GỖ</strong></td>
            <td>1100</td>
            <td>m3</td>
            @foreach($tong_go as $tonggo)
                @if($tonggo == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($tonggo, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr class="warning">
            <th scope="row" class="text-center">I</th>
            <td class="td_left">Rừng tự nhiên</td>
            <td>1110</td>
            <td>m3</td>
            @foreach($rtn_go as $a)
                @if($a == 0)
                    <td> -</td>
                @else
                    <td>{{$a, 2, ',', '.'}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center">1</th>
            <td class="td_left">Trên núi đất</td>
            <td>1111</td>
            <td>m3</td>
            @foreach($data_rtn_go[0] as $tnd)
                @if($tnd == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($tnd, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center">2</th>
            <td class="td_left">Trên núi đá</td>
            <td>1112</td>
            <td>m3</td>
            @foreach($data_rtn_go[1] as $nd)
                @if($nd == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($nd, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center">3</th>
            <td class="td_left">Trên đất ngập nước</td>
            <td>1113</td>
            <td>m3</td>
            @foreach($data_rtn_go[2] as $tdnn)
                @if($tdnn == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($tdnn, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center"></th>
            <td class="td_left">Ngập mặn</td>
            <td>1114</td>
            <td>m3</td>
            @foreach($data_rtn_go[3] as $nm)
                @if($nm == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($nm, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center"></th>
            <td class="td_left">Trên đất phèn</td>
            <td>1115</td>
            <td>m3</td>
            @foreach($data_rtn_go[4] as $tdp)
                @if($tdp == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($tdp, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center"></th>
            <td class="td_left">Ngập nước ngọt</td>
            <td>1116</td>
            <td>m3</td>
            @foreach($data_rtn_go[5] as $nnn)
                @if($nnn == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($nnn, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center">4</th>
            <td class="td_left">Trên cát</td>
            <td>1117</td>
            <td>m3</td>
            @foreach($data_rtn_go[6] as $tc)
                @if($tc == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($tc, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr class="warning">
            <th scope="row" class="text-center">II</th>
            <td class="td_left">Rừng trồng</td>
            <td>1120</td>
            <td>m3</td>
            @foreach($rtr_go as $rtrgo)
                @if($rtrgo == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($rtrgo, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center">1</th>
            <td class="td_left">Trên núi đất</td>
            <td>1121</td>
            <td>m3</td>
            @foreach($data_rtr_go[0] as $tnd1)
                @if($tnd1 == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($tnd1, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center">2</th>
            <td class="td_left">Trên núi đá</td>
            <td>1122</td>
            <td>m3</td>
            @foreach($data_rtr_go[1] as $nd1)
                @if($nd1 == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($nd1, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center">3</th>
            <td class="td_left">Trên đất ngập nước</td>
            <td>1123</td>
            <td>m3</td>
            @foreach($data_rtr_go[2] as $tdnn1)
                @if($tdnn1 == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($tdnn1, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center"></th>
            <td class="td_left">Ngập mặn</td>
            <td>1124</td>
            <td>m3</td>
            @foreach($data_rtr_go[3] as $nm1)
                @if($nm1 == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($nm1, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center"></th>
            <td class="td_left">Trên đất phèn</td>
            <td>1125</td>
            <td>m3</td>
            @foreach($data_rtr_go[4] as $tdp1)
                @if($tdp1 == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($tdp1, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center"></th>
            <td class="td_left">Ngập nước ngọt</td>
            <td>1126</td>
            <td>m3</td>
            @foreach($data_rtr_go[5] as $nnn1)
                @if($nnn1 == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($nnn1, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center">4</th>
            <td class="td_left">Trên cát</td>
            <td>1127</td>
            <td>m3</td>
            @foreach($data_rtr_go[6] as $tc1)
                @if($tc1 == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($tc1, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr class="info">
            <th scope="row" class="text-center">B</th>
            <td class="td_left"><strong>TRỮ LƯỢNG TRE NỨA, CAU DỪA</strong></td>
            <td>1500</td>
            <td>1000 cây</td>
            @foreach($tong_trenua as $sumtrenua)
                @if($sumtrenua == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($sumtrenua, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr class="warning">
            <th scope="row" class="text-center">I</th>
            <td class="td_left">Rừng tự nhiên</td>
            <td>1510</td>
            <td>1000 cây</td>
            @foreach($rtn_trenua as $rtntrenua)
                @if($rtntrenua == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($rtntrenua, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center">1</th>
            <td class="td_left">Trên núi đất</td>
            <td>1511</td>
            <td>1000 cây</td>
            @foreach($data_rtn_trenua[0] as $tnd2)
                @if($tnd2 == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($tnd2, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center">2</th>
            <td class="td_left">Trên núi đá</td>
            <td>1512</td>
            <td>1000 cây</td>
            @foreach($data_rtn_trenua[1] as $nd2)
                @if($nd2 == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($nd2, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center">3</th>
            <td class="td_left">Trên đất ngập nước</td>
            <td>1513</td>
            <td>1000 cây</td>
            @foreach($data_rtn_trenua[2] as $tdnn2)
                @if($tdnn2 == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($tdnn2, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center"></th>
            <td class="td_left">Ngập mặn</td>
            <td>1514</td>
            <td>1000 cây</td>
            @foreach($data_rtn_trenua[3] as $nm2)
                @if($nm2 == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($nm2, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center"></th>
            <td class="td_left">Ngập phèn</td>
            <td>1515</td>
            <td>1000 cây</td>
            @foreach($data_rtn_trenua[4] as $np2)
                @if($np2 == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($np2, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center"></th>
            <td class="td_left">Ngập nước ngọt</td>
            <td>1516</td>
            <td>1000 cây</td>
            @foreach($data_rtn_trenua[5] as $nnn2)
                @if($nnn2 == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($nnn2, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center">4</th>
            <td class="td_left">Trên cát</td>
            <td>1517</td>
            <td>1000 cây</td>
            @foreach($data_rtn_trenua[6] as $tc2)
                @if($tc2 == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($tc2, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr class="warning">
            <th scope="row" class="text-center">II</th>
            <td class="td_left">Rừng trồng</td>
            <td>1520</td>
            <td>1000 cây</td>
            @foreach($rtr_trenua as $rtrtrenua)
                @if($rtrtrenua == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($rtrtrenua, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center">1</th>
            <td class="td_left">Trên núi đất</td>
            <td>1521</td>
            <td>1000 cây</td>
            @foreach($data_rtr_trenua[0] as $tnd3)
                @if($tnd3 == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($tnd3, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center">2</th>
            <td class="td_left">Trên núi đá</td>
            <td>1522</td>
            <td>1000 cây</td>
            @foreach($data_rtr_trenua[1] as $nd3)
                @if($nd3 == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($nd3, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center">3</th>
            <td class="td_left">Trên đất ngập nước</td>
            <td>1523</td>
            <td>1000 cây</td>
            @foreach($data_rtr_trenua[2] as $tdnc3)
                @if($tdnc3 == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($tdnc3, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center"></th>
            <td class="td_left">Ngập mặn</td>
            <td>1524</td>
            <td>1000 cây</td>
            @foreach($data_rtr_trenua[3] as $nm3)
                @if($nm3 == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($nm3, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center"></th>
            <td class="td_left">Ngập phèn</td>
            <td>1525</td>
            <td>1000 cây</td>
            @foreach($data_rtr_trenua[4] as $np3)
                @if($np3 == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($np3, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center"></th>
            <td class="td_left">Ngập nước ngọt</td>
            <td>1526</td>
            <td>1000 cây</td>
            @foreach($data_rtr_trenua[5] as $nnn3)
                @if($nnn3 == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($nnn3, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <th scope="row" class="text-center">4</th>
            <td class="td_left">Trên cát</td>
            <td>1527</td>
            <td>1000 cây</td>
            @foreach($data_rtr_trenua[6] as $tc3)
                @if($tc3 == 0)
                    <td> -</td>
                @else
                    <td>{{number_format($tc3, 2, ',', '.')}}</td>
                @endif
            @endforeach
        </tr>
        </tbody>
    </table>
</div>
