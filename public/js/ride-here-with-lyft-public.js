(function($) {
  "use strict";

  $(window).load(function() {
    var referrer = encodeURIComponent(window.location.href);
    var endpoint =
      "https://www.lyft.com/api/get-a-ride/partner-codes/default?referrer=" +
      referrer;
    $.get(endpoint).success(function(data) {
      var description = data.partner_code.description;
      $(".ride-here-with-lyft__description").html(description);
    });
  });
})(jQuery);
