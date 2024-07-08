<!DOCTYPE html>
<html lang="vi">
<head>
    <base href="{{ asset('')}}">
    <title>Hệ thống giám sát rừng Hà Nam</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="admin/css/main.css">
    <!-- Font-icon css-->
    <script src='admin/js/awesome.js'></script>
    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	<link rel="shortcut icon" type="image/png" href="admin/images/logo.jpg"/>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body class="app sidebar-mini rtl">
<main class="app-content">
    @include('admin.layout.header')
    @yield('content')
</main>
<!-- js-->
<script src="admin/js/jquery-3.2.1.min.js"></script>
<script src="admin/js/popper.min.js"></script>
<script src="admin/js/bootstrap.min.js"></script>
<script src="admin/js/main.js"></script>
<script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>
<script src="admin/DataTables/media/js/jquery.dataTables.min.js"></script>
<script src="admin/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('#dataTables').DataTable({
            responsive: true,
            lengthMenu: [[10, 25, 50, 100, 150, -1], [10, 25, 50, 100, 150, "ALL"]],
            iDisplayLength: 25,
            order: [],
        });
    });
</script>
@yield('script')
</body>
</html>
