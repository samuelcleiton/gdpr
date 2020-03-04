<?php 




    $gdpr_positions = array(
        "top" => "Superior",
        //"top_left" => "Superior esquerdo",
        //"top_right" => "Superior direito",
        "bottom" => "Inferior"
    );

    $gdpr_themes = array(
        "ocean" => "Ocean",
        "life" => "Life",
        "pastelzao" => "Pastelzão",
        "deep-blue" => "Deep Blue",
    );

    if($_POST['gdpr_hidden'] == 'Y') {
     
        $gdpr_enabled = $_POST['gdpr_enabled'];
        
         
        $gdpr_position =  $_POST['gdpr_position'];
        update_option('gdpr_position', $gdpr_position);

        $gdpr_theme = $_POST['gdpr_theme'] ;
        update_option('gdpr_theme', $gdpr_theme);
        
        $gdpr_button_label = $_POST['gdpr_button_label']  ;
        update_option('gdpr_button_label', $gdpr_button_label) ;

        $gdpr_message = $_POST['gdpr_message'] ;
        update_option('gdpr_message', $gdpr_message);

        ?>
        <div class="updated"><p><strong><?php _e('Salvo com sucesso' ); ?></strong></p></div>
        <?php
    } 



        $gdpr_enabled = get_option("gdpr_enabled") ?: $gdpr_default_values["gdpr_enabled"];
        $gdpr_position = empty(get_option("gdpr_position")) ? $gdpr_default_values["gdpr_position"] : get_option("gdpr_position");
        $gdpr_theme = empty(get_option("gdpr_theme")) ? $gdpr_default_values["gdpr_theme"] : get_option("gdpr_theme");
        $gdpr_button_label = empty(get_option("gdpr_button_label")) ? $gdpr_default_values["gdpr_button_label"] : get_option("gdpr_button_label");
        $gdpr_message = empty(get_option("gdpr_message")) ? $gdpr_default_values["gdpr_message"] : get_option("gdpr_message");
    
?>



<div class="wrap">
    <h2>GDPR Compliance para WordPress</h2>
     
    <?php
        echo "<!--";
        echo "gdpr_enabled: " . $gdpr_enabled .  " | ". ( isset($gdpr_enabled) ? "checked" : "false" ) . "<br>";
        echo "gdpr_position: " . $gdpr_position . "<br>";
        echo "gdpr_theme: " . $gdpr_theme . "<br>";
        echo "gdpr_button_label: " . $gdpr_button_label . "<br>";
        echo "gdpr_message: " . $gdpr_message . "<br>";
        echo "-->";
    ?>

    <form name="gdpr_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="gdpr_hidden" value="Y">

        <table class="form-table">
            <tr valign="top">
                <th scope="row">Mostrar mensagem</th>
                <td>
                    <input type="checkbox" name="gdpr_enabled" <?=( isset($gdpr_enabled)==1 ? "checked" : "" )  ?> value="true" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Posição</th>
                <td>
                    <select name="gdpr_position">
                      
                        <?php
                            foreach ($gdpr_positions as $key => $value) {
                                echo "<option value='". $key ."' ". ($key==$gdpr_position ? "selected=selected" : "") ." >". $value ."</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">Tema</th>
                <td>
                    <select name="gdpr_theme">
                        
                        <?php
                            foreach ($gdpr_themes as $key => $value) {
                                echo "<option value='". $key ."' ". ($key==$gdpr_theme ? "selected=selected" : "") ." >". $value ."</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">Texto do botão</th>
                <td>
                    <input type="text" name="gdpr_button_label" value="<?= $gdpr_button_label ?>" />
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">Mensagem</th>
                <td>
                    <?php

                    $settings = array( 'media_buttons' => false );

                    wp_editor( $gdpr_message, "gdpr_message", $settings );

                    ?>

                </td>
            </tr>

        </table>

        <hr />

        <p class="submit">
            <input type="submit" name="Submit" value="<?php _e('Salvar alterações' ) ?>" />
        </p>

    </form>

</div>


