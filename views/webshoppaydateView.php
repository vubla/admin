<?php
echo '<h1>';
    echo 'Paydate of '.$vars->name;
echo '</h1>';

if(isset($vars->error)) {
    echo $vars->error;
}

echo 'Current paydate: ';
echo '<b>';
    echo $vars->completeDate;
echo '</b>';



echo '<h2>';
    echo 'Set New';
echo '</h2>';
echo '<form action="'.$this->link('webshop','newpaydate','',true).'" method="post">';
    foreach ($vars->date as $key => $value) {
        $temp = strtoupper($key[0]).substr($key, 1);
        echo $temp.': <input style="width:50px;margin-right:10px" type="text" name="'.$key.'" value="'.$value.'"/>';
    }
    echo '<input type="hidden" name="id" value="'.$vars->wid.'"/>';
    echo '<input type="submit" value="Set" />';
echo '</form>';