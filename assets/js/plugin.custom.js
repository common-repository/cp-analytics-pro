jQuery(document).ready(function(){
//alert(2222);
// for titles first word color
/*jQuery('.titles h1').each(function() {
	var h = $(this).html();
	var index = h.indexOf(' ');
	if(index == -1) {jQuery
		index = h.length;
	}
	$(this).html('<span>' + h.substring(0, index) + '</span>' + h.substring(index, h.length));
});*/	
	
// for tab	
//jQuery('#myTab').tabCollapse();

//alert(1111);
// for datepicker 
jQuery('.input-daterange').datepicker({
         format: "yyyy-mm-dd"
	
});


jQuery('#table-resp, #table-resp-traffic, #table-resp-content, #table-resp-events, #table-resp-conversions, #table-resp-country, #table-resp-city, #table-resp-social-net, #table-resp-social-url, #table-resp-pluguns').DataTable();

jQuery('.nav-tabs li').click(function(){
jQuery('#table-resp, #table-resp-traffic, #table-resp-content, #table-resp-events, #table-resp-conversions, #table-resp-country, #table-resp-city, #table-resp-social-net, #table-resp-social-url, #table-resp-pluguns').DataTable();

jQuery('#table-respInTab, #table-resp-trafficInTab, #table-resp-contentInTab, #table-resp-eventsInTab, #table-resp-conversionsInTab, #table-resp-countryInTab, #table-resp-cityInTab, #table-resp-social-netInTab, #table-resp-social-urlInTab, #table-resp-plugunsInTab').DataTable( {
        responsive: true
    } );
});

jQuery('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    jQuery(jQuery.fn.dataTable.tables(true)).DataTable()
        .columns.adjust()
        .responsive.recalc();
});
});