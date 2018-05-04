
var dashboard = function () {
    var data_sales=[],data_presale=[];
    var bindElement = function () {
        $(".connectedSortable").sortable({
            placeholder: "sort-highlight",
            connectWith: ".connectedSortable",
            handle: ".box-header, .nav-tabs",
            forcePlaceholderSize: true,
            zIndex: 999999,
            update:function(event, ui){
                updateWidgetsPosition();
            }
        });
        $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");
        $(document).on('click','ul[kp-dashboard="pagination"] a, a[kp-action-tracking="refresh"]',function(e){
            e.preventDefault();
            if($(this).closest('[kp-clients-widget]').length){
                var div = $(this).closest('[kp-clients-widget]');
                getClientsData({
                    obj:div,
                    url:$(this).attr('href')
                });
            }
            else{
                getActivityData($(this).attr('href'));
            }
            return false;
        });
        $(document).on('ifChecked',function(e){
            var data={},obj = $(e.target);
            data.client_id = obj.closest('tr').data('id');
            data.field = obj.attr('kp-track');
            data.action = 'checked';
            updateClientTracking(data);
        });
        $(document).on('ifUnchecked',function(e){
            var data={},obj = $(e.target);
            data.client_id = obj.closest('tr').data('id');
            data.field = obj.attr('kp-track');
            data.action = 'unchecked';
            updateClientTracking(data);
        });
    };
    var updateClientTracking = function(data){
        $.ajax({
                url: capp.base_url + '/client/tracking/update',
                type: "post",
                dataType: 'JSON',
                data:data,
                success: function (res) {
                    Notify('Client record updated.',null,null,'success');
                },
                error: function () {
                    Notify('Error in updating client tracking data.',null,null,'danger');
                }
            });
    };
    var updateWidgetsPosition = function(){
        var dashboard = {};
        dashboard.column1 = $( 'section[kp-sortable="column1"]' ).sortable('toArray',{attribute:'kp-widget'} );
        dashboard.column2 = $( 'section[kp-sortable="column2"]' ).sortable('toArray',{attribute:'kp-widget'} );
        $.post(capp.base_url+'/dashboard/widget/position',dashboard,function(res){
            Notify('Dashboard postion saved.',null,null,'success');
        });
    };
    var overAllSaleGraph = function () {
        if ($('#over-all-sale').length) {
            var line = new Morris.Bar({
                element: 'over-all-sale',
                resize: true,
                data: data_sales,
                xkey: 'month',
                ykeys: ['at_need','pre_need','records_of_wishes','trade_client'],
                labels: ['At-need','Pre-need','Records of wishes','Trade'],
                lineColors: ['#3c8dbc'],
                hideHover: 'auto',
                xLabels: 'month',
//                xLabelFormat: function (x) {
//                    console.log(x);
//                    return moment(x).format('MMM');
//                }
            });
        }

    };
    var prepaidSaleGraph = function () {
        if ($('#prepaid-sale').length) {
            var line = new Morris.Bar({
                element: 'prepaid-sale',
                resize: true,
                data: data_presale,
                xkey: 'month',
                ykeys: ['pre_need'],
                labels: ['Pre-need Sale'],
                lineColors: ['#3c8dbc'],
                hideHover: 'auto',
                xLabels: 'month',
//                xLabelFormat: function (x) {
//                    return moment(x).format('MMM');
//                }
            });
        }
    };
    var getSalesData = function(){
        if ($('#over-all-sale').length || $('#prepaid-sale').length) {
            $.ajax({
                url: capp.base_url + '/graph/sales',
                type: "get",
                dataType: 'JSON',
                success: function (res) {
                    data_sales = res.over_all_sale;
                    data_presale = res.prepaid_sale
                    overAllSaleGraph();
                    prepaidSaleGraph();
                    commonjs.reinit();
                },
                error: function () {
                    Notify('Error in loading graph data',null,null,'danger');
//                    console.log('Error in loading graph data');
                }
            });
        }
    };
    var getActivityData = function (url) {
        var where = {};
        if ($('div#revisions-logs').length) {
            $overlay_div.clone().appendTo($('div#revisions-logs'));
//            $('div#revisions-logs').append($overlay_div);
            if (url == null) {
                url = capp.base_url + '/dashboard/activity';
                where = {'where': {'revisionable_type': 'App\\Models\\Client', 'key': 'created_at', 'old_value': null}};
            }
            $.get(url, where, function (res) {
                $('div#revisions-logs').html(res);
                commonjs.reinit();
            });
        }
    };
    var getClientsData = function(src){
        var url = src.url;
        $overlay_div.clone().appendTo(src.obj);
//        src.obj.append($overlay_div);
        if(url==null){
            url = src.obj.attr('kp-clients-widget');
        }
        $.ajax({
            url: url,
            type: "get",
            async:true,
            success: function (res) {
                src.obj.html(res);
                commonjs.reinit();
            },
            error: function () {
                console.log('Error in '+src.obj.attr('id'));
            }
        });
    };
    var getAllClientsWidgetsData = function(){
        
        $.each($('div[kp-clients-widget]'),function(){
            getClientsData({obj:$(this),url:null});
        });
//        getClientsData({});
    };
    return {
        init: function() {
            bindElement();
            getSalesData();
            getAllClientsWidgetsData();
            getActivityData(null);
            
        },    
    };
}();

