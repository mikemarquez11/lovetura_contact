(function($) {
    const unavArray = Object.values(lovetura_dates.unav_dates);
    //datetime picker
    $( "#ui-datepicker" ).datepicker({
        firstDay: 0,
        dateFormat: 'dd-mm-yy',
        minDate: new Date(),
        beforeShowDay: my_check
    });

    //var unavailableDates = [ "22-02-2020", "10-02-2020", "25-02-2020" ];

    function my_check(d) {
    var year = d.getFullYear(),
        month = ("0" + (d.getMonth() + 1)).slice(-2),
        day = ("0" + (d.getDate())).slice(-2);

    var formatted = day + '-' + month + '-' + year;

    if ($.inArray(formatted, unavArray) != -1) {
        return [false, "fully_booked", "unAvailable"];
    } else {
        return [true, "bookable", "Available"];
    }
  }
      
})( jQuery );