const chart = Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Top 5 Medicos mas activos'
    },
    subtitle: {
        text: 'Ordenado por Mayor No. Citas Atendidas'
    },
    xAxis: {
        categories: [
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Citas atendidas' //unidad de medida
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
    ]
});

let $start, $end;

function fetchData()
{
    const startDate = $start.val();
    const endDate =   $end.val();

    // Fecth Api
    const url = `/charts/doctors/column/data?start=${startDate}&end=${endDate}`
    fetch(url)
        .then(response =>response.json())
        .then(data => {
            //console.log(data);
            chart.xAxis[0].setCategories(data.categories)

            if(chart.series.length > 0)
            {
                chart.series[2].remove();
                chart.series[1].remove();
                chart.series[0].remove();
            }


            chart.addSeries(data.series[0]); // Atendidas
            chart.addSeries(data.series[1]); // Canceladas
            chart.addSeries(data.series[2]); // Total Appointments
        })
}

$(function () {

    $start=$('#startDate');
    $end=$('#endDate');

    fetchData();

    $start.change(fetchData);
    $end.change(fetchData);
});
