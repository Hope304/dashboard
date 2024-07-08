@extends('admin.layout.index')

@section('content')
<div class="page">
    <div class="main-content">
        <div class="container-fluid">
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
				<h2 class="page-title fw-semibold fs-18 mb-0">Dashboard</h2>
            </div>
            <div class="row">
              <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">DIỆN TÍCH CÁC LOẠI RỪNG VÀ ĐẤT LÂM NGHIỆP PHÂN THEO MỤC ĐÍCH SỬ DỤNG</div>
                    </div>
                    <div class="card-body">
                        <div id="column-basic" style="min-height: 335px;">
                        
                        </div>
                        
                    </div>
                </div>
            </div>
                
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">Column Chart With Datalabels</div>
                        </div>
                        <div class="card-body">
                            <div id="column-datalabels" style="min-height: 335px;">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">Stacked Column Chart</div>
                        </div>
                        <div class="card-body">
                            <div id="column-stacked" style="min-height: 335px;">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">100% Stacked Column Chart</div>
                        </div>
                        <div class="card-body">
                            <div id="column-stacked-full" style="min-height: 335px;">

                            </div>
                        </div>
                    </div>
                </div>
				
				<div class="col-xl-6"> 
					<div class="card custom-card"> 
						<div class="card-header"> 
							<div class="card-title">Column Chart With Markers</div> 
						</div> 
						<div class="card-body">
							<div id="column-markers" style="min-height: 335px;">
							</div>
						</div> 
					</div> 
				</div> 
				
				<div class="col-xl-6"> 
					<div class="card custom-card"> 
						<div class="card-header"> 
							<div class="card-title">Column Chart With Rotated Labels</div> 
						</div> 
						<div class="card-body">
							<div id="column-rotated-labels" style="min-height: 335px;">
							</div>
						</div> 
					</div> 
				</div> 
				
				<div class="col-xl-6"> 
					<div class="card custom-card"> 
						<div class="card-header"> 
							<div class="card-title">Column Chart With Negative Values</div> 
						</div> 
						<div class="card-body">
							<div id="column-negative" style="min-height: 335px;">
							</div>
						</div> 
					</div> 
				</div> 
				
				<div class="col-xl-6"> 
					<div class="card custom-card"> 
						<div class="card-header"> 
							<div class="card-title">Range Column Chart</div> 
						</div> 
						<div class="card-body">
							<div id="column-range" style="min-height: 335px;">
							</div>
						</div> 
					</div> 
				</div> 
				
				<div class="col-xl-6"> 
					<div class="card custom-card"> 
						<div class="card-header"> 
							<div class="card-title">Dynamic Loaded Chart</div> 
						</div> 
						<div class="card-body">
							<div id="chart-year" style="min-height: 335px;">
							</div>
							<div id="chart-quarter" style="min-height: 335px;">
							</div>
							

						</div> 
					</div> 
				</div> 
				
				<div class="col-xl-6"> 
					<div class="card custom-card"> 
						<div class="card-header"> 
							<div class="card-title">Distributed Columns Chart</div> 
						</div> 
						<div class="card-body">
							<div id="columns-distributed" style="min-height: 335px;">
							</div>
						</div> 
					</div> 
				</div> 
			</div> 
		</div>
    </div>
</div>
@endsection

@section('script')
<script src="admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="admin/assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="admin/assets/libs/chart.js/chart.min.js"></script>
<script src="admin/assets/js/main.js"></script>
<script src="admin/assets/js/apexcharts-column.js"></script>

<script>
  var url = '/matinh/35';
  var bieu = 'bieu1';
  var base = 'admin/dashboard/';
  xhr = $.ajax({
                type: 'GET',
                url: base + bieu + url ,
                success: function (data) {
                  // console.log(data);
                  $('#data').html(data);
                  DrawChart(data);
                }
            });
  function DrawChart(data){

    var options = {
        series: [{
            name: 'Rừng tự nhiên',
            data: data.rtn
        }, {
            name: 'Rừng trồng',
            data: data.rungtrong
        }, {
            name: 'Diện tích trồng chưa thành rừng',
            data: data.sum_dtchuathanhrung
        }, {
            name: 'Diện tích khoanh nuôi tái sinh',
            data: data.sum_dtchuataisinh
        }, {
            name: 'Diện tích khác',
            data: data.sum_dtichkhac
        }],
        chart: {
            type: 'bar',
            // stacked: true,
            height: 450
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '90%',
                endingShape: 'rounded'
            },
        },
        grid: {
            borderColor: '#f2f5f7',
        },
        colors: ["#36BA98", "#E9C46A", "#F4A261", "#f34343","#E76F51"],
        dataLabels: {
            enabled: false
        },
        // colors: ["#38cab3", "#38cab3", "#ffbd5a"],
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: ['Tổng diện tích','Diện tích trong quy hoạch','Đặc dụng cộng','Vườn quốc gia','Khu bảo tồn thiên nhiên','Khu rừng nghiên cứu','Khu bảo vệ cảnh quan','Phòng hộ cộng','Đầu nguồn','Chắn gió cát','Chắn sóng','Bảo vệ môi trường','Sản xuất','Rừng ngoài đất quy hoạch'],
            labels: {
                show: true,
                rotate: -45,
                style: {
                    colors: "#8c9097",
                    fontSize: '11px',
                    fontWeight: 600,
                    cssClass: 'apexcharts-xaxis-label',
                },
            }
        },
        yaxis: {
            title: {
                text: '',
                style: {
                    color: "#8c9097",
                }
            },
            labels: {
                show: true,
                formatter: function(val) {
                return val.toFixed(2); // Định dạng số với 2 chữ số sau dấu thập phân
            },
                style: {
                    colors: "#8c9097",
                    fontSize: '11px',
                    fontWeight: 600,
                    cssClass: 'apexcharts-xaxis-label',
                },
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return  val.toFixed(2) ;
                }
            }
        },
        
        
    };
    var chart = new ApexCharts(document.querySelector("#column-basic"), options);
    chart.render();
  }
</script>
@endsection
