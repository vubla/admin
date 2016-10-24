<div class="alignleft">
		<h2>Personlige Informationer</h2>
        <table>
        <?php
            foreach($vars->personnalSettings as $setting) {
                echo '<tr>';
                    echo '<td class="setting-text"> '.$setting->longName.' </td>';
                    echo '<td class="setting"><input type="'.$setting->type.'" name="'.$setting->name.'" value="'.$setting->value.'" /><td>';
                    echo '<td class="settings-description">'.$setting->description."</td>\n";
                echo '</tr>';
            }
        ?>
        </table>

        <input type="hidden" name="id" value="<?php echo $vars->id; ?>" />
        <input type="submit" name="submitUserData" class="save" value="Gem" />
        <input type="submit" name="cancel" class="cancel" value="Annuller" /><br />
        
    </div>