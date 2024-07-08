<div class="main">
    <h4 class="bangdieukhien text-center">BIỂU 1: DIỆN TÍCH CÁC LOẠI RỪNG VÀ ĐẤT LÂM NGHIỆP PHÂN THEO MỤC
        ĐÍCH SỬ
        DỤNG</h4>
    <div class="form-check table-responsive">
        <table class="table table-bordered table-sm">
            <thead>
            <tr class="active">
                <th scope="col" rowspan="2" class="text-center">TT</th>
                <th scope="col" rowspan="2" class="text-center">Phân loại rừng</th>
                <th scope="col" rowspan="2" class="text-center">Mã</th>
                <th scope="col" rowspan="2" class="text-center">Tổng <br/>diện tích</th>
                <th scope="col" rowspan="2" class="text-center">Diện tích <br/>trong quy hoạch</th>
                <th scope="col" colspan="5" class="text-center">Đặc dụng</th>
                <th scope="col" colspan="5" class="text-center">Phòng hộ</th>
                <th scope="col" rowspan="2" class="text-center">Sản xuất</th>
                <th scope="col" rowspan="2" class="text-center">Rừng ngoài đất quy hoạch <br/>dành cho lâm
                    nghiệp
                </th>
            </tr>
            <tr class="active">
                <th scope="col" class="text-center">Cộng</th>
                <th scope="col" class="text-center">Vườn <br/>quốc gia</th>
                <th scope="col" class="text-center">Khu bảo tồn <br/>thiên nhiên</th>
                <th scope="col" class="text-center">Khu rừng <br/>nghiên cứu</th>
                <th scope="col" class="text-center">Khu bảo vệ <br/>cảnh quan</th>
                <th scope="col" class="text-center">Cộng</th>
                <th scope="col" class="text-center">Đầu <br/>nguồn</th>
                <th scope="col" class="text-center">Chắn <br/>gió cát</th>
                <th scope="col" class="text-center">Chắn <br/>sóng</th>
                <th scope="col" class="text-center">Bảo vệ <br/>môi trường</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row" class="text-center"></th>
                <td class="text-center"><strong class="text-danger">TỔNG</strong></td>
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
                <td class="td_left"><strong>DIỆN TÍCH CÓ RỪNG</strong></td>
                <td>1100</td>
                @foreach($tong_dtcorung as $dtcr)
                    @if($dtcr == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($dtcr, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr class="warning">
                <th scope="row" class="text-center">I</th>
                <td class="td_left">Rừng tự nhiên</td>
                <td>1110</td>
                @foreach($rtn as $r)
                    @if($r == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($r, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center">1</th>
                <td class="td_left">Trên núi đất</td>
                <td>1111</td>
                @foreach($data_rtn[0] as $nuidat)
                    @if($nuidat == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($nuidat, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center">2</th>
                <td class="td_left">Trên núi đá</td>
                <td>1112</td>
                @foreach($data_rtn[1] as $nuida)
                    @if($nuida == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($nuida, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center">3</th>
                <td class="td_left">Trên đất ngập nước</td>
                <td>1113</td>
                @foreach($data_rtn[2] as $ngapnuoc)
                    @if($ngapnuoc == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($ngapnuoc, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center"></th>
                <td class="td_left">Ngập mặn</td>
                <td>1114</td>
                @foreach($data_rtn[3] as $ngapman)
                    @if($ngapman == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($ngapman, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center"></th>
                <td class="td_left">Trên đất phèn</td>
                <td>1115</td>
                @foreach($data_rtn[4] as $datphen)
                    @if($datphen == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($datphen, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center"></th>
                <td class="td_left">Ngập nước ngọt</td>
                <td>1116</td>
                @foreach($data_rtn[5] as $nuocngot)
                    @if($nuocngot == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($nuocngot, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center">4</th>
                <td class="td_left">Trên cát</td>
                <td>1117</td>
                @foreach($data_rtn[6] as $trencat)
                    @if($trencat == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($trencat, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr class="warning">
                <th scope="row" class="text-center">II</th>
                <td class="td_left">Rừng trồng</td>
                <td>1120</td>
                @foreach($rungtrong as $rtr)
                    @if($rtr == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($rtr, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center">1</th>
                <td class="td_left">Trên núi đất</td>
                <td>1121</td>
                @foreach($data_rtr[0] as $tnd)
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
                <td>1122</td>
                @foreach($data_rtr[1] as $tnda)
                    @if($tnda == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($tnda, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center">3</th>
                <td class="td_left">Trên đất ngập nước</td>
                <td>1123</td>
                @foreach($data_rtr[2] as $nn)
                    @if($nn == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($nn, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center"></th>
                <td class="td_left">Ngập mặn</td>
                <td>1124</td>
                @foreach($data_rtr[3] as $nm)
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
                <td>1125</td>
                @foreach($data_rtr[4] as $dp)
                    @if($dp == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($dp, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center"></th>
                <td class="td_left">Ngập nước ngọt</td>
                <td>1126</td>
                @foreach($data_rtr[5] as $nngot)
                    @if($nngot == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($nngot, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center">4</th>
                <td class="td_left">Trên cát</td>
                <td>1127</td>
                @foreach($data_rtr[6] as $tc)
                    @if($tc == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($tc, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr class="info">
                <th scope="row" class="text-center">B</th>
                <td class="td_left"><strong>DIỆN TÍCH CHƯA THÀNH RỪNG</strong></td>
                <td>2000</td>
                @foreach($tong_chuathanhrung as $tctr)
                    @if($tctr == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($tctr, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr class="warning">
                <th scope="row" class="text-center">I</th>
                <td class="td_left">Diện tích trồng chưa thành rừng</td>
                <td>2010</td>
                @foreach($sum_dtchuathanhrung as $sctr)
                    @if($sctr == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($sctr, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center">1</th>
                <td class="td_left">Trên núi đất</td>
                <td>2011</td>
                @foreach($data_chuathanhrung[0] as $ndat1)
                    @if($ndat1 == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($ndat1, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center">2</th>
                <td class="td_left">Trên núi đá</td>
                <td>2012</td>
                @foreach($data_chuathanhrung[1] as $nd1)
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
                <td>2013</td>
                @foreach($data_chuathanhrung[2] as $nc1)
                    @if($nc1 == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($nc1, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center"></th>
                <td class="td_left">Ngập mặn</td>
                <td>2014</td>
                @foreach($data_chuathanhrung[3] as $nm1)
                    @if($nm1 == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($nm1, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center"></th>
                <td class="td_left">Ngập phèn</td>
                <td>2015</td>
                @foreach($data_chuathanhrung[4] as $np1)
                    @if($np1 == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($np1, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center"></th>
                <td class="td_left">Ngập nước ngọt</td>
                <td>2016</td>
                @foreach($data_chuathanhrung[5] as $nn1)
                    @if($nn1 == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($nn1, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center">4</th>
                <td class="td_left">Trên cát</td>
                <td>2017</td>
                @foreach($data_chuathanhrung[6] as $tc1)
                    @if($tc1 == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($tc1, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr class="warning">
                <th scope="row" class="text-center">II</th>
                <td class="td_left">Diện tích khoanh nuôi tái sinh</td>
                <td>2020</td>
                @foreach($sum_dtchuataisinh as $knts)
                    @if($knts == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($knts, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center">1</th>
                <td class="td_left">Trên núi đất</td>
                <td>2021</td>
                @foreach($data_taisinh[0] as $ndat2)
                    @if($ndat2 == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($ndat2, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center">2</th>
                <td class="td_left">Trên núi đá</td>
                <td>2022</td>
                @foreach($data_taisinh[1] as $nd2)
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
                <td>2023</td>
                @foreach($data_taisinh[2] as $nn2)
                    @if($nn2 == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($nn2, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center"></th>
                <td class="td_left">Ngập mặn</td>
                <td>2024</td>
                @foreach($data_taisinh[3] as $nm2)
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
                <td>2025</td>
                @foreach($data_taisinh[4] as $np2)
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
                <td>2026</td>
                @foreach($data_taisinh[5] as $nn2)
                    @if($nn2 == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($nn2, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center">4</th>
                <td class="td_left">Trên cát</td>
                <td>2027</td>
                @foreach($data_taisinh[6] as $tc2)
                    @if($tc2 == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($tc2, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr class="warning">
                <th scope="row" class="text-center">III</th>
                <td class="td_left">Diện tích khác</td>
                <td>2030</td>
                @foreach($sum_dtichkhac as $dtk)
                    @if($dtk == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($dtk, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center">1</th>
                <td class="td_left">Trên núi đất</td>
                <td>2031</td>
                @foreach($data_dtichkhac[0] as $ndat3)
                    @if($ndat3 == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($ndat3, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center">2</th>
                <td class="td_left">Trên núi đá</td>
                <td>2032</td>
                @foreach($data_dtichkhac[1] as $nd3)
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
                <td>2033</td>
                @foreach($data_dtichkhac[2] as $nn3)
                    @if($nn3 == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($nn3, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center"></th>
                <td class="td_left">Ngập mặn</td>
                <td>2034</td>
                @foreach($data_dtichkhac[3] as $nm3)
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
                <td>2035</td>
                @foreach($data_dtichkhac[4] as $np3)
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
                <td>2036</td>
                @foreach($data_dtichkhac[5] as $nn3)
                    @if($nn3 == 0)
                        <td> -</td>
                    @else
                        <td>{{number_format($nn3, 2, ',', '.')}}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th scope="row" class="text-center">4</th>
                <td class="td_left">Trên cát</td>
                <td>2037</td>
                @foreach($data_dtichkhac[6] as $tc3)
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
</div>