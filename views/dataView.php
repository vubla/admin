<?php
if(is_array($vars->data)){
    echo '<pre>';
    var_dump($vars->data);
    echo '</pre>';

} else {
    echo $vars->data;
}

?>