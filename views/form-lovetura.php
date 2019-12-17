<?php
    $ajax_nonce = wp_create_nonce( 'loveturaoutput' ); 
?>
<div class="lovetura-contact-form" id="lovetura-contact">
    <form class="info-form" id="ajaxcontactform">
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
            <input type="date" class="form-control" id="startSesion" name="fechasesion" required>
        </div>
        <div class="form-group col-sm-12 col-md-6">
            <select id="inputServicio" class="form-control" name="sesion" required>
                <option value="" disabled selected>Elige tu sesion</option>
                <option value="ProcesoSeduccion">Procesos de Seducción</option>
                <option value="ColonizadorLiberado">Colonizador Liberado</option>
                <option value="DescolonizacionEmocional">Descolonización Emocional</option>
            </select>
        </div>
    </div>

    <input id="hiddenNonceField" type="hidden" name="nonce" value="<?php echo $ajax_nonce; ?>">
    <input id="hiddenAJAXAction" type="hidden" name="action" value="">
    
    <div class="form-row">
        <div class="form-group col-md-12">
            <textarea class="form-control" name="mensaje" rows="5" id="comment" placeholder="Describe tu motivo de consulta" required></textarea>
        </div>
        <button class="btn btn-lovetura btn-lg" id="btn-submit" type="submit">Enviar</button>
    </div>
    </form>
</div>