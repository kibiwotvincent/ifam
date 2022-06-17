$(function() {
  'use strict';
  $('#datepickerwidget').datetimepicker({
      inline: true,
      format: 'L'
  });
  var ps = new PerfectScrollbar(".scrollable", {
      wheelSpeed: 10,
      wheelPropagation: true,
      minScrollbarLength: 5
  });
});