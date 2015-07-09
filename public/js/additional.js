$(document).ready(function(){
    autoAlert(".alert",1500)
    if($("#navbar").length){
        if($("#timer").length){
            waktu = document.getElementById("timer").innerHTML.split(':');
            compare=new Date();
            compare.setHours(waktu[0]);
            compare.setMinutes(waktu[1]);
            compare.setSeconds(waktu[2]);
            startTime();
        }
    }
    resizeElements();
    $(window).on('resize',function(){
        resizeElements();
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

    if(today>compare){
        var difference = Math.abs(today - compare);
        var minutes = Math.floor(difference/1000/60);
    }
    else{
        var minutes = 0;
    }

    document.getElementById('clock_nav').innerHTML = h+":"+m+":"+s;
    if($("#clock").length){
        document.getElementById('clock').innerHTML = h+":"+m+":"+s;
        document.getElementById('timer').innerHTML = "Menit Kesiangan : " + minutes;
    }

    var t = setTimeout(function(){startTime()},500);
}

function checkTime(i) {
    if (i<10) {i = "0" + i};
    return i;
}

function autoAlert(selector, delay) {
    var elm = $(selector);
    elm.fadeIn("slow").delay(delay).slideUp("slow")
}

function resizeElements(){
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
}