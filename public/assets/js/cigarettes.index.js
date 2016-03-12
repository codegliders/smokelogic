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
                    color:" #37abc8"
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

$(document).ready(function () {

});