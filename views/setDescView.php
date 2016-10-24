<h1 class="line">Indstillinger</h1>

<div class="fullcol last">
<?php if(isset( $vars->msg) && $vars->msg){ ?>
<div id="error_display">
<?php echo $vars->msg ?>
</div>
<?php } 


?>

<form id="settings-form" action="<?php echo LOGIN_URL.'/settings/language'; ?>/" method="post">
    <table id="settings">
    <?php 
        foreach($vars->list as $setting){
               echo '<tr><td>'.$setting->name.'<td>';
              echo '<td><input type="hidden" name="settings['.$setting->id.'][name]" value="'.$setting->name.'" /> </td>';
            foreach($setting as $key=>$val)
            {
                if(strpos($key, 'description') !== false){
                 echo '<td><textarea cols="30" rows="10" name="settings['.$setting->id.']['.$key.']">'.$val.'</textarea></td>';
                } else if (strpos($key, 'longname') !== false)
                {
                    echo '<td><input type="text" name="settings['.$setting->id.']['.$key.']" value="'.$val.'" /> </td>';
                } else if ($key == 'id') {
                     echo '<td><input type="hidden" name="settings['.$setting->id.']['.$key.']" value="'.$val.'" /> </td>';
                }
                 ?>
               
                 <?php
            }
            echo  '</tr>';
        }
    ?>
    </table>
    <input type="hidden" name="controller" value="settings" />
    <input type="hidden" name="action" value="language" />
    <input type="submit" name="submitSettingsLang" class="save" value="Gem" />
    <input type="submit" name="cancel" class="cancel" value="Annuller" /><br />
    <br />
    <br />

    </form>
