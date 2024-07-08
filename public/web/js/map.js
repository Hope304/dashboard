var map = L.map("map").setView([20.585867, 105.923996], 11);
var roads = L.gridLayer
    .googleMutant({
        type: "satellite",
    })
    .addTo(map);

//Nhom lop loai ban do
map.overlaysRG = L.layerGroup([]).addTo(map);
map.overlaysDBR = L.layerGroup([]).addTo(map);
map.overlaysFireMap = L.layerGroup([]).addTo(map);
map.overlaysPoint = L.layerGroup([]).addTo(map);

//Tham so lop ban do ranh gioi hanh chinh
var layerCurrent = null;
var WMS_RANHGIOI_URL =
    "https://bando.ifee.edu.vn:8453/geoserver/ws_ranhgioi/wms";
var WS_RANHGIOI = "ws_ranhgioi";
var WMS_OPACITY_DEFAULT = 1;
var WMS_DBR = "http://bando.ifee.edu.vn:8080/geoserver/geopfes/wms";

//Tham so lop ban do WMS
var currentLayer = null;
var currentFillter = null;
var currentWmsUrl = null;
var currentMapType = null;
var currentLevel = "matinh";
var currentCode = 35;
var listFirePoint = null;

$(document).ready(function () {
    var matinh = "35";
    //LayDanhSachHuyen
    $.ajax({
        method: "GET",
        url: "district/" + matinh,
    }).done(function (data) {
        $("#district").html(data);
    });
    //Load RGHC Tinh
    nameLayer = "ws_ranhgioi:rg_vn_tinh";
    sqlFilter = "MATINH=" + matinh;

    fnShowMapRG(nameLayer, sqlFilter);
    //set tham so cho lop ban do wms
    if (currentMapType) {
        currentProvinceSelect = matinh;
        map.overlaysDBR.clearLayers();
        checkedWMSLayer(currentMapType, "matinh", matinh);
    }
    CheckFirePoint();
});

$("#24h").change(function () {
    if ($("#24h").is(":checked")) {
        $("#history").prop("checked", false);
        $("#selectDate").addClass("hidden");
        $.ajax({
            method: "GET",
            url: "ajax/getHotspot24h",
        }).done(function (data) {
            console.log(data);
            renFirePoint(data);
        });
    } else {
        $("#24h").prop("checked", false);
        $("#history").prop("checked", true);
        $("#selectDate").removeClass("hidden");
        $("#infoFirePoint").html("");
        loadData();
    }
});

$("#history").change(function () {
    if ($("#history").is(":checked")) {
        $("#24h").prop("checked", false);
        $("#selectDate").removeClass("hidden");
        $("#infoFirePoint").html("");
        loadData();
    } else {
        $("#history").prop("checked", false);
        $("#24h").prop("checked", true);
        $("#selectDate").addClass("hidden");
        $.ajax({
            method: "GET",
            url: "ajax/getHotspot24h",
        }).done(function (data) {
            console.log(data);
            renFirePoint(data);
        });
    }
});

function loadData() {
    var start = $("#startDate").val();
    var end = $("#endDate").val();
    $.ajax({
        method: "GET",
        url: "ajax/getHistoryHotspot",
        data: { startDate: start, endDate: end },
    }).done(function (data) {
        console.log(data);
        renFirePoint(data);
    });
}

function CheckFirePoint() {
    if ($("#diemChay").is(":checked")) {
        if ($("#24h").is(":checked")) {
            $("#selectDate").addClass("hidden");
            $.ajax({
                method: "GET",
                url: "ajax/getHotspot24h",
            }).done(function (data) {
                console.log(data);
                renFirePoint(data);
            });
        } else {
            $("#selectDate").removeClass("hidden");
            $("#infoFirePoint").html("");
            loadData();
        }
    }
}

$("#diemChay").change(function () {
    CheckFirePoint();
});

function renFirePoint(listPoint) {
    $("#infoFirePoint").html("");
    map.overlaysPoint.clearLayers();
    if (listPoint) {
        dataLocation = listPoint;
        listHtml = "";
        for (var i = 0; i < dataLocation.length; i++) {
            var a = dataLocation[i];
            var icon = L.icon({
                iconUrl: "web/images/HotSpotIcon/" + getFireIcon(a.ttxacminh),
                iconSize: [35, 35], // size of the icon
                iconAnchor: [15, 15], // point of the icon which will correspond to marker's location
                popupAnchor: [0, -12], // point from which the popup should open relative to the iconAnchor
            });
            var marker = L.marker(new L.LatLng(a.latitude, a.longitude), {
                icon: icon,
            });
            var customOptions = {
                minWidth: "400",
                maxHeight: "400",
                className: "custom",
            };
            var ttxacminh = "";
            if (a.kiemduyet == 1) {
                kiemduyet =
                    "<tr><th scope='row'>Tình trạng kiểm duyệt</th><td> Đã kiểm duyệt </td></tr>";
            } else {
                kiemduyet =
                    "<tr><th scope='row'>Tình trạng kiểm duyệt</th><td> Chưa kiểm duyệt </td></tr>" +
                    "<tr><th colspan='2' class='text-center'><button onclick='showVerifyForm(" +
                    a.id +
                    ")' class='btn-primary' id='verifyFirePoint'>Xác minh</button> </th></tr>";
            }
            customPopup =
                "<table class='table table-sm table-hover table-responsive-sm'><h4 class='text-center'>Điểm cháy số " +
                (i + 1) +
                "</h4><thead class='thead-light'><tr><th scope='col'>Thuộc tính</th><th scope='col'>Thông tin</th></tr></thead><tbody>" +
                "<tr><th scope='row'>Huyện</th><td>" +
                a.huyen +
                "</td></tr>" +
                "<tr><th scope='row'>Xã</th><td>" +
                a.xa +
                "</td></tr>" +
                "<tr><th scope='row'>Latitude/VN-2000</th><td>" +
                a.latitude +
                "</td></tr>" +
                "<tr><th scope='row'>Longitude/VN-2000</th><td>" +
                a.longitude +
                "</td></tr>" +
                "<tr><th scope='row'>Tiểu khu/ Khoảnh/ Lô</th><td>" +
                a.tk +
                "/ " +
                a.khoanh +
                "/ " +
                a.lo +
                "</td></tr>" +
                "<tr><th scope='row'>Độ sáng</th><td>" +
                a.brightness +
                "</td></tr>" +
                "<tr><th scope='row'>Thời gian phát hiện</th><td>" +
                a.acq_time +
                " " +
                a.acq_date +
                "</td></tr>" +
                kiemduyet;
            ("</tbody></table><br>");
            marker.bindPopup(customPopup, customOptions);
            marker.addTo(map.overlaysPoint);
            listHtml += customPopup;
        }
        $("#infoFirePoint").html(listHtml);
    }
}

function showVerifyForm(id) {
    $("#submitVerify").attr("action", "ajax/verifyHotspot/" + id);
    $("#formVerify").css("display", "block");
    value_check = $('input[name="fire"]:checked').val();
    if (value_check == 3) {
        $("#huongphoi").css("display", "none");
        $("#dientich").css("display", "none");
        $("#khoangcach").css("display", "none");
        $("#status").css("display", "none");
    }
}

$('input[name="fire"]').change(function () {
    value_check = $('input[name="fire"]:checked').val();
    if (value_check == 3) {
        $("#huongphoi").css("display", "none");
        $("#dientich").css("display", "none");
        $("#khoangcach").css("display", "none");
        $("#status").css("display", "none");
    } else {
        $("#huongphoi").css("display", "block");
        $("#dientich").css("display", "block");
        $("#khoangcach").css("display", "block");
        $("#status").css("display", "block");
        val_handle = $('input[name="handle"]:checked').val();
        if (val_handle == 0) {
            $("#handleTime").css("display", "none");
        }
    }
});

$('input[name="handle"]').change(function () {
    val_handle = $('input[name="handle"]:checked').val();
    if (val_handle == 0) {
        $("#handleTime").css("display", "none");
    } else {
        $("#handleTime").css("display", "block");
    }
});

$("#cancelVerify").click(function () {
    $("#formVerify").css("display", "none");
});

$("#closeModal").click(function () {
    $("#formVerify").css("display", "none");
});

$("#click_close_err").click(function () {
    $("#close_err").css("display", "none");
});

$("#click_close_success").click(function () {
    $("#close_success").css("display", "none");
});

function getFireIcon(fireLevel) {
    nameImg = "";
    switch (fireLevel) {
        case 1:
            nameImg = "unverified.png";
            break;
        case 2:
            nameImg = "fired.png";
            break;
        case 3:
            nameImg = "notfired.png";
            break;
        case 4:
            nameImg = "notforestfired.png";
            break;
        default:
            nameImg = "unverified.png";
    }
    return nameImg;
}

/*
    Hien thi WMS
*/
function fnShowMapRG(layerName, strFilter) {
    if (layerName == undefined) {
        alert("Lớp bản đồ này không tìm thấy. Vui lòng liên hệ quản trị viên");
    } else {
        console.log("show map:", strFilter);
        layerCurrent = layerName;
        map.overlaysRG.clearLayers();
        var wmsL = getLayerWMS(
            WMS_RANHGIOI_URL,
            layerName,
            strFilter,
            "gcf_ranhgioi"
        );
        map.overlaysRG.addLayer(wmsL);
        // Zoom fitBounds
        var jsonURL = getFeatureJsonUrl(
            WMS_RANHGIOI_URL,
            layerCurrent,
            strFilter,
            10000
        );
        $.getJSON(jsonURL, function (data_json) {
            var selectStyle = {
                color: "#ffff86",
                opacity: 1,
                fillColor: "#fff7bc",
                fillOpacity: 0.1,
                //dashArray: '3',
                weight: 2,
            };
            var geoMaps = L.geoJson(data_json, { style: selectStyle });
            map.overlaysRG.addLayer(geoMaps);

            // Zoom to Feature
            var latlngs = [];
            for (var i in data_json.features[0].geometry.coordinates) {
                var coord = data_json.features[0].geometry.coordinates[i];
                for (var j in coord) {
                    var points = coord[j];
                    for (var k in points) {
                        latlngs.push(L.GeoJSON.coordsToLatLng(points[k]));
                    }
                }
            }
            map.fitBounds(latlngs);
        });
    }
}

function checkedWMSLayer(mapType, regionLevel, regionCode) {
    listWMS = [
        {
            Type: 0,
            root_url: "https://bando.ifee.edu.vn:8453/geoserver/GSR_HaNam/wms?",
            name_layer: "GSR_HaNam:hanam_dbr",
            style: "DBR_HaNam",
        },
        {
            Type: 1,
            root_url: "https://bando.ifee.edu.vn:8453/geoserver/GSR_HaNam/wms?",
            name_layer: "GSR_HaNam:hanam_dbr",
            style: "capchay_hanam",
        },
    ];
    if(mapType!=null){
        dataWMS = listWMS[mapType];

        var wmsL = getLayerWMS(
            dataWMS.root_url,
            dataWMS.name_layer,
            `${regionLevel}=${regionCode}`,
            dataWMS.style
        );
        map.overlaysDBR.addLayer(wmsL);
        currentLayer = dataWMS.name_layer;
        currentFillter = `${regionLevel}=${regionCode}`;
        currentWmsUrl = dataWMS.root_url;
    }
}

function getFeatureJsonUrl(_wmsURL, _layerName, _strFilter, _maxFeature) {
    params = {
        service: "WFS",
        request: "GetFeature",
        typeName: _layerName,
        maxFeatures: _maxFeature,
        outputFormat: "application/json",
        srsName: "EPSG:4326",
        cql_filter: _strFilter,
    };
    var parameters = L.Util.extend(params);
    return _wmsURL + L.Util.getParamString(parameters);
}

function getLayerWMS(_wmsURL, _layerName, _strFilter, _strStyle) {
    if (_strFilter != null) {
        return L.tileLayer.wms(_wmsURL, {
            layers: _layerName,
            cql_filter: _strFilter,
            styles: _strStyle,
            opacity: WMS_OPACITY_DEFAULT,
            transparent: true,
            srs: "EPSG:4326",
            format: "image/png",
            style: _strStyle,
        });
    } else {
        // Áp dụng cho ranh giới: quốc gia, khu vực
        return L.tileLayer.wms(_wmsURL, {
            layers: _layerName,
            styles: _strStyle,
            opacity: WMS_OPACITY_DEFAULT,
            transparent: true,
            format: "image/png",
        });
    }
}

function getFeatureInfoUrl(_latlng, _layerName, _wmsURL, _cqlFillter) {
    var point = map.latLngToContainerPoint(_latlng, map.getZoom()),
        size = map.getSize(),
        params = {
            request: "GetFeatureInfo",
            service: "WMS",
            srs: "EPSG:4326",
            //styles: 'grass',
            transparent: true,
            version: "1.1.1",
            format: "image/png",
            bbox: map.getBounds().toBBoxString(),
            height: size.y,
            width: size.x,
            cql_filter: _cqlFillter,
            layers: _layerName,
            query_layers: _layerName,
            info_format: "application/json",
        };
    params[params.version === "1.3.0" ? "i" : "x"] = Math.round(point.x);
    params[params.version === "1.3.0" ? "j" : "y"] = Math.round(point.y);

    var test = _wmsURL + L.Util.getParamString(params, _wmsURL, true);
    return _wmsURL + L.Util.getParamString(params, _wmsURL, true);
}

function cleanViewTNR(modeClean) {
    switch (modeClean) {
        case 100:
            $("#bandoDBR").attr("checked", false);
            $("#bandoCapChay").attr("checked", false);
            $("#district").html("");
            $("#commune").html("");
        case 101:
            $("#district").html("");
            $("#commune").html("");
            break;
        case 102:
            $("#commune").html("");
            break;
        default:
    }

    $("#xaHuyen").html("");
    $("#tkKhoanhLo").html("");
    $("#chuRung").html("");
    $("#trangThaiRung").html("");
    $("#loaiCayNamtrg").html("");
    $("#dtich").html("");
    $("#truLuong").html("");
    $("#mtn").html("");
    $("#malr3").html("");
    $("#lapDia").html("");
    $("#mamdsd").html("");
    $("#nhietDo").html("");
    $("#doAm").html("");
    $("#mua").html("");
    $("#chisoP").html("");

    map.overlaysDBR.clearLayers();
}

$("#district").change(function () {
    var mahuyen = $(this).val();
    console.log("mahuyen:" + mahuyen);

    $.ajax({
        method: "GET",
        url: "commune/" + mahuyen,
    }).done(function (data) {
        $("#commune").html(data);
    });

    //Load RGHC Huyen
    nameLayer = "ws_ranhgioi:rg_vn_huyen";
    sqlFilter = "MAHUYEN=" + mahuyen;

    fnShowMapRG(nameLayer, sqlFilter);

    currentLevel = "mahuyen";
    currentCode = mahuyen;
    //set tham so cho lop ban do wms
    //if (currentMapType) {
    map.overlaysDBR.clearLayers();
    checkedWMSLayer(currentMapType, "mahuyen", mahuyen);
    //};
});

$("#commune").change(function () {
    var maxa = $(this).val();
    console.log("maxa:" + maxa);
    cleanViewTNR();
    //Load RGHC Xa
    nameLayer = "ws_ranhgioi:rg_vn_xa";
    sqlFilter = "MAXA=" + maxa;
    fnShowMapRG(nameLayer, sqlFilter);
    currentLevel = "maxa";
    currentCode = maxa;
    //set tham so cho lop ban do wms
    //if (currentMapType) {
    map.overlaysDBR.clearLayers();
    checkedWMSLayer(currentMapType, "maxa", maxa);
    //};
});

$("#bandoDBR").change(function (event) {
    cleanViewTNR();
    if (event.currentTarget.checked) {
        $("#bandoCapChay").prop("checked", false);
        $("#fireWarningImg").css("visibility", "hidden");
        currentMapType = 0;
        checkedWMSLayer(currentMapType, currentLevel, currentCode);
    } else {
        cleanViewTNR();
        map.overlaysDBR.clearLayers();
    }
});

$("#bandoCapChay").change(function (event) {
    cleanViewTNR();
    if (event.currentTarget.checked) {
        $("#bandoDBR").prop("checked", false);
        $("#fireWarningImg").css("visibility", "visible");
        currentMapType = 1;
        checkedWMSLayer(currentMapType, currentLevel, currentCode);
    } else {
        cleanViewTNR();
        $("#fireWarningImg").css("visibility", "hidden");
        map.overlaysDBR.clearLayers();
    }
});

$("#btnClear").click(function () {
    $('#bandoDBR').prop('checked', false);
    $('#bandoCapChay').prop('checked', false);
    currentMapType=null;

    var matinh = "35";
    //LayDanhSachHuyen
    $.ajax({
        method: "GET",
        url: "district/" + matinh,
    }).done(function (data) {
        $("#district").html(data);
    });
    //Load RGHC Tinh
    nameLayer = "ws_ranhgioi:rg_vn_tinh";
    sqlFilter = "MATINH=" + matinh;

    $("#commune").html(
        "<option disabled selected value=''>[Chọn Xã/Phường]</option>"
    );

    fnShowMapRG(nameLayer, sqlFilter);
    //set tham so cho lop ban do wms
    map.overlaysDBR.clearLayers();
    if (currentMapType) {
        currentProvinceSelect = matinh;
        checkedWMSLayer(currentMapType, "matinh", matinh);
    }
});

/*
    Lấy thông tin lớp bản đồ
*/
map.on("click", function (e) {
    if ($("#bandoDBR").is(":checked") || $("#bandoCapChay").is(":checked")) {
        infoURL = getFeatureInfoUrl(
            e.latlng,
            currentLayer,
            currentWmsUrl,
            currentFillter
        );
        $.getJSON(infoURL, function (data) {
            if (data) {
                var info = data.features[0].properties;
                $("#xaHuyen").html(`${info.xa}/${info.huyen}`);
                $("#tkKhoanhLo").html(`${info.tk}/${info.khoanh}/${info.lo}`);
                $("#chuRung").html(info.churung);
                $("#trangThaiRung").html(getLDLR(info.ldlr));
                $("#loaiCayNamtrg").html(
                    `${info.sldlr}/${info.namtr}/${info.captuoi}`
                );
                $("#dtich").html(`${info.dtich} ha`);
                $("#truLuong").html(info.mgolo + " m3");
                $("#mtn").html(info.mtn + +" 1000 cây");
                $("#malr3").html(get3LR(info.malr3));
                $("#lapDia").html(getLapDia(info.lapdia));
                $("#mamdsd").html(getMDST(info.mamdsd));
                $("#fireWarningImg").attr(
                    "src",
                    "web/images/fireWarningIcon/level" + info.capchay + ".png"
                );
                $.ajax({
                    method: "GET",
                    url: "ajax/getWeather/" + info.maxa,
                }).done(function (data) {
                    console.log(data);

                    if (data.lenght > 0) {
                        var weather = data[data.length - 1];
                        console.log(weather);
                        $("#nhietDo").html(weather.nhietdo + " °C");
                        $("#doAm").html(weather.doam + " %");
                        $("#mua").html(weather.luongmua + " mm");
                        $("#chisoP").html(weather.csp);
                    }
                });
            } else {
                cleanViewTNR();
            }
        });
    }
});

//Lay thong tin ban do
function getLDLR(maLRLR) {
    var ldlrString = "";
    for (var i = 0; i < LDLR_MA_TRANG_THAI.length; i++) {
        if (maLRLR.toLowerCase() == LDLR_MA_TRANG_THAI[i]) {
            ldlrString = LDLR_TEN_TRANG_THAI[i];
            return ldlrString;
        }
    }
    return ldlrString;
}

function get3LR(maLR3) {
    var string3LR = "";
    switch (maLR3) {
        case 1:
            string3LR = "Rừng phòng hộ";
            break;
        case 2:
            string3LR = "Rừng đặc dụng";
            break;
        case 3:
            string3LR = "Rừng sản xuất";
            break;
    }
    return string3LR;
}

function getLapDia(maLapDia) {
    var stringLapDia = "";
    switch (maLapDia) {
        case 1:
            stringLapDia = "Núi đất";
            break;
        case 2:
            stringLapDia = "Núi đá";
            break;
        case 3:
            stringLapDia = "Đất ngập mặn";
            break;
        case 4:
            stringLapDia = "Đất ngập phèn";
            break;
        case 5:
            stringLapDia = "Đất ngập ngọt";
            break;
        case 6:
            stringLapDia = "Bãi cát";
            break;
    }
    return stringLapDia;
}

function getMDST(maMDSD) {
    var mdsdString = MDSD_MA_MUC_DICH[maMDSD - 1];
    return mdsdString;
}

//Bảng tra mã loại đất loại rừng
var LDLR_TEN_TRANG_THAI = [
    "1 - Rừng gỗ tự nhiên núi đất LRTX giàu nguyên sinh",
    "2 - Rừng gỗ tự nhiên núi đất LRTX TB nguyên sinh",
    "3 - Rừng gỗ tự nhiên núi đất LRRL giàu nguyên sinh",
    "4 - Rừng gỗ tự nhiên núi đất LRRL TB nguyên sinh",
    "5 - Rừng gỗ tự nhiên núi đất LK giàu nguyên sinh",
    "6 - Rừng gỗ tự nhiên núi đất LK TB nguyên sinh",
    "7 - Rừng gỗ tự nhiên núi đất LRLK giàu nguyên sinh",
    "8 - Rừng gỗ tự nhiên núi đất LRLK TB nguyên sinh",
    "9 - Rừng gỗ tự nhiên núi đá LRTX giàu nguyên sinh",
    "10 - Rừng gỗ tự nhiên núi đá LRTX TB nguyên sinh",
    "11 - Rừng gỗ tự nhiên ngập mặn nguyên sinh",
    "12 - Rừng gỗ tự nhiên ngập phèn nguyên sinh",
    "13 - Rừng gỗ tự nhiên ngập ngọt nguyên sinh",
    "14 - Rừng gỗ tự nhiên núi đất LRTX giàu",
    "15 - Rừng gỗ tự nhiên núi đất LRTX TB",
    "16 - Rừng gỗ tự nhiên núi đất LRTX nghèo",
    "17 - Rừng gỗ tự nhiên núi đất LRTX nghèo kiệt",
    "18 - Rừng gỗ tự nhiên núi đất LRTX phục hồi",
    "19 - Rừng gỗ tự nhiên núi đất LRRL giàu",
    "20 - Rừng gỗ tự nhiên núi đất LRRL TB",
    "21 - Rừng gỗ tự nhiên núi đất LRRL nghèo",
    "22 - Rừng gỗ tự nhiên núi đất LRRL nghèo kiệt",
    "23 - Rừng gỗ tự nhiên núi đất LRRL phục hồi",
    "24 - Rừng gỗ tự nhiên núi đất LK giàu",
    "25 - Rừng gỗ tự nhiên núi đất LK TB",
    "26 - Rừng gỗ tự nhiên núi đất LK nghèo",
    "27 - Rừng gỗ tự nhiên núi đất LK nghèo kiệt",
    "28 - Rừng gỗ tự nhiên núi đất LK phục hồi",
    "29 - Rừng gỗ tự nhiên núi đất LRLK giàu",
    "30 - Rừng gỗ tự nhiên núi đất LRLK TB",
    "31 - Rừng gỗ tự nhiên núi đất LRLK nghèo",
    "32 - Rừng gỗ tự nhiên núi đất LRLK nghèo kiệt",
    "33 - Rừng gỗ tự nhiên núi đất LRLK phục hồi",
    "34 - Rừng gỗ tự nhiên núi đá LRTX giàu",
    "35 - Rừng gỗ tự nhiên núi đá LRTX TB",
    "36 - Rừng gỗ tự nhiên núi đá LRTX nghèo",
    "37 - Rừng gỗ tự nhiên núi đá LRTX nghèo kiệt",
    "38 - Rừng gỗ tự nhiên núi đá LRTX phục hồi",
    "39 - Rừng gỗ tự nhiên ngập mặn giàu",
    "40 - Rừng gỗ tự nhiên ngập mặn trung bình",
    "41 - Rừng gỗ tự nhiên ngập mặn nghèo",
    "42 - Rừng gỗ tự nhiên ngập mặn phục hồi",
    "43 - Rừng gỗ tự nhiên ngập phèn giàu",
    "44 - Rừng gỗ tự nhiên ngập phèn trung bình",
    "45 - Rừng gỗ tự nhiên ngập phèn nghèo",
    "46 - Rừng gỗ tự nhiên ngập phèn phục hồi",
    "47 - Rừng gỗ tự nhiên ngập ngọt",
    "48 - Rừng tre/luồng tự nhiên núi đất",
    "49 - Rừng nứa tự nhiên núi đất",
    "50 - Rừng vầu tự nhiên núi đất",
    "51 - Rừng lồ ô tự nhiên núi đất",
    "52 - Rừng tre nứa khác tự nhiên núi đất",
    "53 - Rừng tre nứa tự nhiên núi đá",
    "54 - Rừng hỗn giao G-TN tự nhiên núi đất ",
    "55 - Rừng hỗn giao TN-G tự nhiên núi đất ",
    "56 - Rừng hỗn giao tự nhiên núi đá",
    "57 - Rừng cau dừa tự nhiên núi đất",
    "58 - Rừng cau dừa tự nhiên núi đá",
    "59 - Rừng cau dừa tự nhiên ngập nước ngọt",
    "60 - Rừng gỗ trồng núi đất",
    "61 - Rừng gỗ trồng núi đá",
    "62 - Rừng gỗ trồng ngập mặn",
    "63 - Rừng gỗ trồng ngập phèn",
    "64 - Rừng gỗ trồng đất cát",
    "65 - Rừng tre nứa trồng núi đất",
    "66 - Rừng tre nứa trồng núi đá",
    "67 - Rừng cau dừa trồng cạn",
    "68 - Rừng cau dừa trồng ngập nước",
    "69 - Rừng cau dừa trồng đất cát",
    "70 - Rừng trồng khác núi đất",
    "71 - Rừng trồng khác núi đá",
    "72 - Đất đã trồng trên núi đất",
    "73 - Đất đã trồng trên núi đá",
    "74 - Đất đã trồng trên đất ngập mặn",
    "75 - Đất đã trồng trên đất ngập phèn",
    "76 - Đất đã trồng trên đất ngập ngọt",
    "77 - Đất đã trồng trên bãi cát",
    "78 - Đất có cây gỗ tái sinh núi đất",
    "79 - Đất có cây gỗ tái sinh núi đá",
    "80 - Đất có cây gỗ tái sinh ngập mặn",
    "81 - Đất có cây tái sinh ngập nước phèn",
    "82 - Đất trống núi đất",
    "83 - Đất trống núi đá",
    "84 - Đất trống ngập mặn",
    "85 - Đất trống ngập nước phèn",
    "86 - Bãi cát",
    "87 - Bãi cát có cây rải rác",
    "88 - Đất nông nghiệp núi đất",
    "89 - Đất nông nghiệp núi đá",
    "90 - Đất nông nghiệp ngập mặn",
    "91 - Đất nông nghiệp ngập nước ngọt",
    "92 - Mặt nước ",
    "93 - Đất khác",
];

var LDLR_MA_TRANG_THAI = [
    "txg1",
    "txb1",
    "rlg1",
    "rlb1",
    "lkg1",
    "lkb1",
    "rkg1",
    "rkb1",
    "txdg1",
    "txdb1",
    "rnm1",
    "rnp1",
    "rnp1",
    "txg",
    "txb",
    "txn",
    "txk",
    "txp",
    "rlg",
    "rlb",
    "rln",
    "rlk",
    "rlp",
    "lkg",
    "lkb",
    "lkn",
    "lkk",
    "lkp",
    "rkg",
    "rkb",
    "rkn",
    "rkk",
    "rkp",
    "txdg",
    "txdb",
    "txdn",
    "txdk",
    "txdp",
    "rnmg",
    "rnmb",
    "rnmn",
    "rnmp",
    "rnpg",
    "rnpb",
    "rnpn",
    "rnpp",
    "rnn",
    "tlu",
    "nua",
    "vau",
    "loo",
    "tnk",
    "tnd",
    "hg1",
    "hg2",
    "hgd",
    "cd",
    "cdd",
    "cdn",
    "rtg",
    "rtgd",
    "rtm",
    "rtp",
    "rtc",
    "rttn",
    "rttnd",
    "rtcd",
    "rtcdn",
    "rtcdc",
    "rtk",
    "rtkd",
    "dtr",
    "dtrd",
    "dtrm",
    "dtrp",
    "dtrn",
    "dtrc",
    "dt2",
    "dt2d",
    "dt2m",
    "dt2p",
    "dt1",
    "dt1d",
    "dt1m",
    "dt1p",
    "bc1",
    "bc2",
    "nn",
    "nnd",
    "nnm",
    "nnp",
    "mn",
    "dkh",
];

//Bảng tra chức năng rừng
var MDSD_MA_MUC_DICH = [
    "1 - Phòng hộ đầu nguồn",
    "2 - Phòng hộ chắn sóng",
    "3 - Phòng hộ chắn cát",
    "4 - Phòng hộ môi sinh",
    "5 - Vườn quốc gia",
    "6 - Bảo tồn thiên nhiên",
    "7 - Nghiên cứu khoa học",
    "8 - Rừng lịch sử VHCQ",
    "9 - Gỗ lớn",
    "10 - Gỗ nhỏ",
    "11 - Tre nứa",
    "12 - Mục đích sản xuất khác",
];
