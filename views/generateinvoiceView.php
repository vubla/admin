<?php
echo '<h1>';
    echo 'Generate invoice for '.$vars->name;
echo '</h1>';

if(isset($vars->error)) {
    echo $vars->error;
}
echo '<form action="'.$this->link('webshop','generateinvoice','',true).'" method="post">';

if(!is_array($vars->messages))
{
    $vars->messages = array();
}
    foreach ($vars->data as $key => $value) {
        $temp = '<span style="min-width:100px;float:left;padding-top:9px">'.strtoupper($key[0]).substr($key, 1).' :</span>';
        if(array_key_exists($key,$vars->textarea))
        {
            echo $temp.'<textarea style="width:200px;margin-right:10px" name="'.$key.'" rows="9">'.$value.'</textarea>';
        }
        else 
        {
            echo $temp.'<input style="width:200px;margin-right:10px" type="text" name="'.$key.'" value="'.$value.'"/>';
        }
        if(array_key_exists($key,$vars->messages))
        {
            echo '('.$vars->messages[$key].')';
        }
        echo '<br>';
    }
    echo '<input type="hidden" name="id" value="'.$vars->wid.'"/>';
    echo '<input type="submit" name="generate" value="Generate" />';
echo '</form>';