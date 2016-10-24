<?php 

$user = $vars->user;
$user_id = $user['id'];

echo '<h1>';
    echo $user['hostname'];
echo '</h1>';

if(isset($vars->error)) {
    echo $vars->error;
}

echo '<div>';
                    echo '<a href="'.$this->link('user','resetcrawl','?id='.$user_id,true).'">Crawl ASAP</a>';
                    echo ' | ';
                    echo '<a href="'.$this->link('user','delete','?id='.$user_id,true).'">Delete</a>';
                    echo ' | ';
                    echo '<a href="'.$this->link('webshop','loginas','?id='.$user_id,true).'">Login as</a>';
                    echo ' | ';
                    echo '<a href="'.$this->link('webshop','soap','?id='.$user_id,true).'">Soap</a>';
                    echo ' | ';
                    echo '<a href="'.$this->link('webshop','sanity','?id='.$user_id,true).'">Sanity</a>';
                    echo ' | ';
                    echo '<a href="'.$this->link('webshop','statistics','?id='.$user_id,true).'">Statistics</a>';
                    echo ' | ';
                    echo '<a href="'.$this->link('webshop','newpaydate','?id='.$user_id,true).'">New Paydate</a>';
                    echo ' | ';
                    echo '<a href="'.$this->link('webshop','swaptestshop','?id='.$user_id,true).'">'.($user['test_shop']?'Make Untest':'Make Test').'</a>';
                    echo ' | ';
                    echo '<a href="'.$this->link('webshop','generateinvoice','?id='.$user_id,true).'">Generate Invoice</a>';
echo '</div>';      
echo '<div  style="float:left;padding-right:50px;">';
echo '<h2>';
    echo 'Info';
echo '</h2>';
                    echo '<table>';
                    foreach ($user as $key => $value) {
                        if(!is_null($value) && $value !== '')
                        {
                            echo '<tr>';
                                echo '<td class="attribute-name">';
                                    echo $key;
                                echo '</td>';
                                echo '<td class="attribute-value">';
                                    echo $value;
                                echo '</td>';
                            echo '</tr>';
                        }
                    }
                    echo '</table>';
                    
echo '</div>';                    
echo '<div  style="float:left">';
echo '<h2>';
    echo 'Something to come?';
echo '</h2>';

echo '</div>';