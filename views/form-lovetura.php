<?php
    $ajax_nonce = wp_create_nonce( 'loveturaoutput' ); 
?>
<div class="lovetura-contact-form" id="lovetura-contact">
    <form class="info-form" id="ajaxcontactform" autocomplete="on">
    <div class="form-row">
        <div class="form-group col-sm-12 col-md-6">
            <input type="text" name="name" class="form-control" id="name" placeholder="Nombre" required autocomplete="name" maxlength="28">
        </div>
        <div class="form-group col-sm-12 col-md-6">
            <!--<label for="inputEmail4">Email</label>-->
            <input type="email" name="email" class="form-control" id="email" placeholder="E-mail" required autocomplete="email" maxlength="32">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-sm-12 col-md-3">
        <input type="number" name="edad" class="form-control" id="inputAge" placeholder="Edad" required autocomplete="age" min="3" max="80">
        </div>
        <div class="form-group col-sm-12 col-md-9">
            <!--<label for="mobile-number">Whatsapp</label>-->
            <input type="tel" name="whatsapp" class="form-control" id="mobile-number" placeholder="" required autocomplete="tel" maxlength="number">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-sm-12 col-md-6">
            <select id="inputServicio" class="form-control" name="sesion" required>
                <option value="" disabled selected>Elige tu sesion</option>
                <option value="ProcesosdeSeduccion">Procesos de Seducción</option>
                <option value="ColonizadorLiberado">Colonizador Liberado</option>
                <option value="DescolonizacionEmocional">Descolonización Emocional</option>
            </select>
        </div>
        <div class="form-group col-sm-12 col-md-6">
            <input type="date" class="form-control" id="startSesion" name="fechasesion" required>
        </div>
    </div>

    <input id="hiddenNonceField" type="hidden" name="nonce" value="<?php echo $ajax_nonce; ?>">
    <input id="hiddenAJAXAction" type="hidden" name="action" value="send_info">
    
    <div class="form-row">
        <div class="form-group col-md-12">
            <textarea class="form-control" name="mensaje" rows="5" id="comment" placeholder="Describe tu motivo de consulta" required></textarea>
        </div>
        
        <div><button class="btn btn-lovetura btn-lg" id="btn-submit" type="submit">Enviar</button></div>

        <!-- Response's Messages -->
        <ul id="form-messages">
        </ul>
    </div>
    </form>
    <div id="ajaxresponsesuccess" name="ajaxresponsesuccess" class="div-success"></div>
    <div id="ajaxresponseerror" name="ajaxresponseerror" class="div-error"></div>
</div>