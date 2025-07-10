<main class="contenedor">
    <h2>Encuesta para Diagnosticar el Estado de Madurez Digital de la Empresa</h2>

    <form class="formulario" method="POST" onsubmit="return validarFormulario();">
        <!-- Sección 1 -->
        <div id="paso-1" class="seccion">
            <h3><?php echo $temas[0] ?> [<span id="puntaje1">0</span>]</h3>
            <?php for ($i = 0; $i < 6; $i++) { ?>
                <label class="preguntas"><?php echo ($i + 1) . ". " . $preguntas[$i]; ?></label><br>
                <div class="opciones">
                    <?php for ($j = 1; $j <= 5; $j++) { ?>
                        <input type="radio" id="pregunta1_<?php echo $i; ?>_seleccion<?php echo $j; ?>" name="pregunta<?php echo $i; ?>" value="<?php echo $j; ?>" onchange="actualizarPuntaje('pregunta1_<?php echo $i; ?>', <?php echo $j; ?>, 1);">
                        <label class="preguntas" for="pregunta1_<?php echo $i; ?>_seleccion<?php echo $j; ?>"><?php echo $j; ?></label>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>

        <!-- Sección 2 -->
        <div id="paso-2" class="seccion ocultar">
            <h3><?php echo $temas[1] ?> [<span id="puntaje2">0</span>]</h3>
            <?php for ($i = 6; $i < 9; $i++) { ?>
                <label class="preguntas"><?php echo ($i + 1). ". " . $preguntas[$i]; ?></label><br>
                <div class="opciones">
                    <?php for ($j = 1; $j <= 5; $j++) { ?>
                        <input type="radio" id="pregunta2_<?php echo $i; ?>_seleccion<?php echo $j; ?>" name="pregunta<?php echo $i; ?>" value="<?php echo $j; ?>" onchange="actualizarPuntaje('pregunta2_<?php echo $i; ?>', <?php echo $j; ?>, 2);">
                        <label class="preguntas" for="pregunta2_<?php echo $i; ?>_seleccion<?php echo $j; ?>"><?php echo $j; ?></label>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>

        <!-- Sección 3 -->
        <div id="paso-3" class="seccion ocultar">
            <h3><?php echo $temas[2] ?> [<span id="puntaje3">0</span>]</h3>
            <?php for ($i = 9; $i < 16; $i++) { ?>
                <label class="preguntas"><?php echo ($i + 1) . ". " . $preguntas[$i]; ?></label><br>
                <div class="opciones">
                    <?php for ($j = 1; $j <= 5; $j++) { ?>
                        <input type="radio" id="pregunta3_<?php echo $i; ?>_seleccion<?php echo $j; ?>" name="pregunta<?php echo $i; ?>" value="<?php echo $j; ?>" onchange="actualizarPuntaje('pregunta3_<?php echo $i; ?>', <?php echo $j; ?>, 3);">
                        <label class="preguntas" for="pregunta3_<?php echo $i; ?>_seleccion<?php echo $j; ?>"><?php echo $j; ?></label>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>

        <!-- Sección 4 -->
        <div id="paso-4" class="seccion ocultar">
            <h3><?php echo $temas[3] ?> [<span id="puntaje4">0</span>]</h3>
            <?php for ($i = 16; $i < 26; $i++) { ?>
                <label class="preguntas"><?php echo ($i + 1) . ". " . $preguntas[$i]; ?></label><br>
                <div class="opciones">
                    <?php for ($j = 1; $j <= 5; $j++) { ?>
                        <input type="radio" id="pregunta4_<?php echo $i; ?>_seleccion<?php echo $j; ?>" name="pregunta<?php echo $i; ?>" value="<?php echo $j; ?>" onchange="actualizarPuntaje('pregunta4_<?php echo $i; ?>', <?php echo $j; ?>, 4);">
                        <label class="preguntas" for="pregunta4_<?php echo $i; ?>_seleccion<?php echo $j; ?>"><?php echo $j; ?></label>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>

        <!-- Sección 5 -->
        <div id="paso-5" class="seccion ocultar">
            <h3><?php echo $temas[4] ?> [<span id="puntaje5">0</span>]</h3>
            <?php for ($i = 26; $i < 30; $i++) { ?>
                <label class="preguntas"><?php echo ($i + 1) . ". " . $preguntas[$i]; ?></label><br>
                <div class="opciones">
                    <?php for ($j = 1; $j <= 5; $j++) { ?>
                        <input type="radio" id="pregunta5_<?php echo $i; ?>_seleccion<?php echo $j; ?>" name="pregunta<?php echo $i; ?>" value="<?php echo $j; ?>" onchange="actualizarPuntaje('pregunta5_<?php echo $i; ?>', <?php echo $j; ?>, 5);">
                        <label class="preguntas" for="pregunta5_<?php echo $i; ?>_seleccion<?php echo $j; ?>"><?php echo $j; ?></label>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>

        <!-- Sección 6 -->
        <div id="paso-6" class="seccion ocultar">
            <h3><?php echo $temas[5] ?> [<span id="puntaje6">0</span>]</h3>
            <?php for ($i = 30; $i < 37; $i++) { ?>
                <label class="preguntas"><?php echo ($i + 1) . ". " . $preguntas[$i]; ?></label><br>
                <div class="opciones">
                    <?php for ($j = 1; $j <= 5; $j++) { ?>
                        <input type="radio" id="pregunta6_<?php echo $i; ?>_seleccion<?php echo $j; ?>" name="pregunta<?php echo $i; ?>" value="<?php echo $j; ?>" onchange="actualizarPuntaje('pregunta6_<?php echo $i; ?>', <?php echo $j; ?>, 6);">
                        <label class="preguntas" for="pregunta6_<?php echo $i; ?>_seleccion<?php echo $j; ?>"><?php echo $j; ?></label>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>

        <div class="contenedor-botones">
            <button type="button" id="anterior" class="boton-verde ocultar">Anterior</button>
            <button type="submit" id="enviar" class="boton-verde">Enviar</button>
            <button type="button" id="siguiente" class="boton-verde">Siguiente</button>
        </div>

        <input type="hidden" id="nombreEmpresaHidden" name="nombreEmpresa">
        <input type="hidden" id="nombreContactoHidden" name="nombreContacto">
        <input type="hidden" id="apellidoContactoHidden" name="apellidoContacto">
        <input type="hidden" id="correoContactoHidden" name="correoContacto">
        <input type="hidden" id="telefonoContactoHidden" name="telefonoContacto">


    </form>
</main>
