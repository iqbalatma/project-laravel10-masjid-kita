import ApexCharts from 'apexcharts'

$(function() {
    let options = {
        title: {
            text: 'Transaksi Masjid',
            align: 'left'
        },
        chart: {
            type: 'line'
        },
        series: [{
            name: 'sales',
            data: []
        }, {
            name: 'sales2',
            data: []
        }],
        xaxis: {
            categories: []
        },
        noData: {
            text: 'Loading...'
        }
    }
    const chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();


    $.ajax({
        url: "/ajax/dashboard",
        type: "GET"
    }).done(function (response){
        chart.updateSeries([{
            name:"sales",
            data: [1,2,3,1,2,3123,123,123,1,]
        },{
            name:"sales2",
            data: [12,21,31]
        },{
            name:"sales",
            data: [11,21,30]
        }]);
        chart.updateOptions({
            xaxis: {
                categories: response.categories
            }
        })
        console.log(response)
    }).fail(function (response){
        console.log(response)
    })


// var options = {
//     chart: {
//         type: 'line'
//     },
//     series: [{
//         name: 'sales',
//         data: [30,40,35,50,49,60,70,91,125]
//     },{
//         name: 'sales',
//         data: [301,401,351,501,491,601,710,911,1125]
//     }],
//     xaxis: {
//         categories: [1991,1992,1993,1994,1995,1996,1997, 1998,1999]
//     }
// }
//
//
});
