$(document).ready(function(){
    if($("#navbar").length){
        startTime();
    }
    $(window).on('resize',function(){
        if($(window).width()<768){
            $("#clock_nav").hide();
            $("#clock").css({
                fontSize:"32px"
            })
        }
        else{
            $("#clock_nav").show();
            $("#clock").css({
                fontSize:"64px"
            })
        }
    });
    if(location.pathname == "/home/laporan"){
        $("#tgl").datepicker();
        $("#tgl").datepicker("option","dateFormat","yy-mm-dd");
        var a=$("#tabel").DataTable({
            dom: 't'
        });
        $("#nisSearch").on("keyup change",function(){
            a.column(0).search($("#nisSearch").val()).draw()
        });
        $("#nameSearch").on("keyup change",function(){
            a.column(1).search($("#nameSearch").val()).draw()
        });
        $("#kelasSearch").on("keyup change",function(){
            a.column(2).search($("#kelasSearch").val()).draw()
        });
        $("#tahunAjaranSearch").on("keyup change",function(){
            a.column(3).search($("#tahunAjaranSearch").val()).draw()
        });
        $("#periodeSearch").on("keyup change",function(){
            a.column(4).search($("#periodeSearch").val()).draw()
        });
        $("#tgl").on("keyup change",function(){
            a.column(6).search($("#tgl").val()).draw()
        });
    }
    else if(location.pathname=="/home/configuration"){
        for(i=1;i<7;i++){
            $("#time"+ i.toString()).datetimepicker({
                locale:"en",
                format:"HH:mm"
            });
        }
    }
});



function startTime() {
    var today=new Date();
    var h=today.getHours();
    var m=today.getMinutes();
    var s=today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);

    var compare=new Date();
    compare.setHours(6);
    compare.setMinutes(30);
    compare.setSeconds(00);

    document.getElementById('clock_nav').innerHTML = h+":"+m+":"+s;
    if($("#clock").length){
        document.getElementById('clock').innerHTML = h+":"+m+":"+s;
        if(today>compare){
            $('#clock').css({
                color:"black",
                textShadow:"0px 0px 15px white"
            });
        }
    }

    var t = setTimeout(function(){startTime()},500);
}

function checkTime(i) {
    if (i<10) {i = "0" + i};
    return i;
}

