(function($) {
    $(function() {
        
        var scntDiv = $('#p_scents');
        var i = $('#p_scents p').length;
        
        $('#addScnt').on('click', function() {
                $('<p><label for="p_scnts"><input type="text" id="p_scnt" size="20" name="sesiones[' + i +']" value="" placeholder="Ingresa Sesion" /></label> <button class="button button-primary" id="remScnt">X</button></p>').appendTo(scntDiv);
                i++;
                return false;
        });

        $( document ).on( 'click', '#remScnt', function(e){
            e.preventDefault();
            if( i > 1 ) {
                $(this).parents('p').remove();
                i--;
        }
        return false;
        });
});

})(jQuery);