jQuery(document).ready(function(){
  'use strict';
  var wbpsSale = jQuery('#wpbsc_total_sale').attr('total-sale');
  var wbpsStock = jQuery('#wpbsc_total_sale').attr('total-stock');
  jQuery('#jqmeter-container').jQMeter({
    goal:wbpsStock,
    raised:wbpsSale,
    meterOrientation:'horizontal',
    width:'100%',
    height:'5px'
  });
});
