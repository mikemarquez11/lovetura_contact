(function($) {
    $(function() {

        "use strict";
        
        // Repeater Sessions
        var scntDiv = $('#p_scents');
        var i = $('#p_scents p').length;
        
        $('#addScnt').on('click', function() {
                $('<p><label for="p_scnts"><input type="text" id="p_scnt" size="20" name="sesiones[]" value="" placeholder="Ingresa Sesion" /></label> <button class="button button-primary" id="remScnt">X</button></p>').appendTo(scntDiv);
                i++;
                return false;
        });

        $( document ).on( 'click', '#remScnt', function(e){
            console.log('Here');
            e.preventDefault();
            if( i > 1 ) {
                $(this).parents('p').remove();
                i--;
        }
        return false;

        });

    $(function() {

        "use strict";

        // Repeater Dates
        var dateDiv = $('#p_dates');
        var i = $('#p_dates p').length;

        $('#addDate').on('click', function() {
                $('<p><label for="p_dats"><input type="text" id="p_dat" size="20" name="unadates[]" value="" placeholder="dd-mm-yy" /></label> <button class="button button-primary" id="remDate">X</button></p>').appendTo(dateDiv);
                i++;
                return false;
        });

        $( document ).on( 'click', '#remDate', function(e){
            e.preventDefault();
            if( i > 1 ) {
                $(this).parents('p').remove();
                i--;
        }
        return false;
        });
    });
});

})(jQuery);