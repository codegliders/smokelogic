$(function () {

    $(window).on("resize", function () {
        $("#chart").data("kendoChart").refresh();
    });
    $('#date-cont').html(moment().format('MMMM Do YYYY, hh:mm:ss a'));

    function createChart() {
        $("#chart").kendoChart({
            dataSource: {
                transport: {
                    read: {
                        url: "/getpiechartdatalasttwoweeks",
                        dataType: "json"
                    }
                },
                sort: {
                    field: "date",
                    dir: "asc"
                }
            },
            title: {
                text: "Cigarettes last 15 days"
            },
            legend: {
                position: "top"
            },
            seriesDefaults: {
                type: "column"

            },
            series: [{
                    field: "cigarettes",
                    name: "Cigarettes",
                    color: " #37abc8"
                }],
            categoryAxis: {
                field: "date",
                labels: {
                    rotation: -90
                },
                crosshair: {
                    visible: true
                }
            },
            valueAxis: {
                labels: {
                    format: "{0} units",
                },
                majorUnit: 20
            },
            tooltip: {
                visible: true,
                shared: true,
                format: "N0"
            }
        });
    }

    $("#btnaddcig").click(function () {


        var date = moment().format('YYYY-MM-DD');
        var time = moment().format('HH:mm:ss');
        $('#date').val(date);
        $('#time').val(time);
        $("#frmcig").submit();
    });

    $(document).ready(createChart);
    $(document).bind("kendo:skinChange", createChart);



});
/*
//gauge

function createGauge() {
    $("#gauge").kendoRadialGauge({
        pointer: {
            value: $("#gauge-value").val()
        },
        scale: {
            minorUnit: 5,
            startAngle: -30,
            endAngle: 210,
            max: 240
        }
    });
}

function createGauge2() {
    $("#gauge2").kendoRadialGauge({
        pointer: {
            value: $("#gauge2-value").val()
        },
        scale: {
            minorUnit: 5,
            startAngle: -30,
            endAngle: 210,
            max: 240
        }
    });
}
$(document).ready(function () {
    createGauge();
   createGauge2();
    function updateValue() {
        $("#gauge").data("kendoRadialGauge").value($("#gauge-value").val());
    }

    if (kendo.ui.Slider) {
        $("#gauge-value").kendoSlider({
            min: 0,
            max: 240,
            showButtons: false,
            change: updateValue
        });
    } else {
        $("#gauge-value").change(updateValue);
    }


    $(document).bind("kendo:skinChange", function (e) {
        createGauge();
    });
});


$(window).resize(function(){
   var gauge = $("#gauge").data("kendoRadialGauge");
    var gauge2 = $("#gauge2").data("kendoRadialGauge");
   gauge.resize();
   gauge2.resize();
})*/

$(document).ready(function () {

});