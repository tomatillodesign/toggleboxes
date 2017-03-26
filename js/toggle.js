(function($) {

  $("h3.clb-toggle-trigger").click(function(){
       $(this).toggleClass("active").next().slideToggle("fast");
       return false;
 });

})( jQuery );
