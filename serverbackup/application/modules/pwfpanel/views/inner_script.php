<script src="<?php echo base_url() . 'backend_asset/admin/js/' ?>app.js"></script> 
<script>

    function getCharts(filterval){
             /*
             * Flot Jquery plugin is used for charts
             *
             * For more examples or getting extra plugins you can check http://www.flotcharts.org/
             * Plugins included in this template: pie, resize, stack, time
             */

            // Get the elements where we will attach the charts

                    var url = "<?php echo base_url() ?>pwfpanel/getcharts";
                    $.ajax({
                        method: "POST",
                        url: url,
                        data: {filterval: filterval},
                        dataType: "json",
                        success: function (response) {
                            if (response.status == 200) {

                                $("#totalv").html(response.totalv);
                                $("#totalu").html(response.totalu);
                                $("#totale").html(response.totale);
                               
                                var chartOverview = $('#chart-overview');

                                // Random data for the charts
                                //var dataEarnings    = [[1, 11600], [2, 13950], [3, 10900], [4, 10050], [5, 11000], [6, 14300], [7, 12500], [8, 15050], [9, 12650], [10, 14000], [11, 15000], [12, 17900]];
                                //var dataOrders      = [[1, 3000], [2, 3500], [3, 2900], [4, 3800], [5, 2800], [6, 2408], [7, 2682], [8, 4400], [9, 5400], [10, 4750], [11, 6100], [12, 7560]];

                                var dataEarnings = response.vendors;
                                var dataOrders  = response.users;
                                var enquiries  = response.enquiries;
                                // Array with month labels used in Classic and Stacked chart
                                var chartMonths     = [[1, 'Jan'], [2, 'Feb'], [3, 'Mar'], [4, 'Apr'], [5, 'May'], [6, 'Jun'], [7, 'Jul'], [8, 'Aug'], [9, 'Sep'], [10, 'Oct'], [11, 'Nov'], [12, 'Dec']];

                                // Overview Chart
                                $.plot(chartOverview,
                                    [
                                        {
                                            label: 'Vendors',
                                            data: dataEarnings,
                                            lines: {show: true, fill: true, fillColor: {colors: [{opacity: 0.25}, {opacity: 0.25}]}},
                                            points: {show: true, radius: 6}
                                        },
                                        {
                                            label: 'Clients',
                                            data: dataOrders,
                                            lines: {show: true, fill: true, fillColor: {colors: [{opacity: 0.15}, {opacity: 0.15}]}},
                                            points: {show: true, radius: 6}
                                        },
                                        {
                                            label: 'Enquiries',
                                            data: enquiries,
                                            lines: {show: true, fill: true, fillColor: {colors: [{opacity: 0.15}, {opacity: 0.15}]}},
                                            points: {show: true, radius: 6}
                                        }
                                    ],
                                    {
                                        colors: ['#1bbae1', '#333333', '#d9416c'],
                                        legend: {show: true, position: 'nw', margin: [15, 10]},
                                        grid: {borderWidth: 0, hoverable: true, clickable: true},
                                        yaxis: {ticks: 3, tickColor: '#f1f1f1'},
                                        xaxis: {ticks: chartMonths, tickColor: '#ffffff'}
                                    }
                                );

                                // Creating and attaching a tooltip to the classic chart
                                var previousPoint = null, ttlabel = null;
                                chartOverview.bind('plothover', function(event, pos, item) {

                                    if (item) {
                                        if (previousPoint !== item.dataIndex) {
                                            previousPoint = item.dataIndex;

                                            $('#chart-tooltip').remove();
                                            var x = item.datapoint[0], y = item.datapoint[1];

                                            if (item.seriesIndex === 1) {
                                                ttlabel = '<strong>' + y + '</strong> Users';
                                            } else if(item.seriesIndex === 2) {
                                                ttlabel = '<strong>' + y + '</strong> Enquiries';
                                               
                                            }else{
                                                ttlabel = '<strong>' + y + '</strong> Vendors';
                                            }

                                            $('<div id="chart-tooltip" class="chart-tooltip">' + ttlabel + '</div>')
                                                .css({top: item.pageY - 45, left: item.pageX + 5}).appendTo("body").show();
                                        }
                                    }
                                    else {
                                        $('#chart-tooltip').remove();
                                        previousPoint = null;
                                    }
                                });






                            } else {
                                $("#msg").html("<div class='alert alert-danger'>Records not found</div>");
                            }
                        },
                        error: function (error, ror, r) {
                            $("#msg").html("<div class='alert alert-danger'>Records not found</div>");
                        },
                    });







    }

    getCharts();

    function getTables(filterval){

                    var url = "<?php echo base_url() ?>pwfpanel/getTablesVendor";
                    $.ajax({
                        method: "POST",
                        url: url,
                        data: {filterval: filterval},
                        success: function (response) {
                            $("#getTablesVendor").html(response);
                        }
                    });
                    $.ajax({
                        method: "POST",
                        url: "<?php echo base_url() ?>pwfpanel/getTablesUsers",
                        data: {filterval: filterval},
                        success: function (response) {
                            $("#getTablesUsers").html(response);
                        }
                    });
                    $.ajax({
                        method: "POST",
                        url: "<?php echo base_url() ?>pwfpanel/getTablesEnquiries",
                        data: {filterval: filterval},
                        success: function (response) {
                            $("#getTablesEnquiries").html(response);
                        }
                    });
    }


</script>