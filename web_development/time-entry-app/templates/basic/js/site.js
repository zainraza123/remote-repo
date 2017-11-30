$(function() {
  $('#sidebar a[href^="' + location.href + '"]').parent().addClass('active-menu-item');
});