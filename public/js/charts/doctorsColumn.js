const chart = Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Medico mas activo por mes'
    },
    subtitle: {
        text: 'Informacion actualizada'
    },
    xAxis: {
        categories: [
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Citas atendidad' //unidad de medida
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

function fetchData()
{
    // Fecth Api
    fetch('/charts/doctors/column/data')
        .then(function(response){
            return response.json();
        })
        .then(function(myJosn){
            console.log(myJosn);
        })
}
