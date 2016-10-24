<h1>
    Users
</h1>
<?php
    if(isset($vars->error)) {
        echo $vars->error;
    }
?>
<?php
    if(!empty($vars->users)) {
?>
<h2>
    Active Users
</h2>
<table class="users">
    <tr>
      
        <th>
            ID
        </th>
        <th>
            Webshop ID
        </th>
        <th>
            Email
        </th>
        <th>
            Name
        </th>
         <th>
            Host
        </th>
           <th>
            Type
        </th>
         <th>
            TNum
        </th>
           <th>
            Paydate
        </th>
          <th>
            Amount
        </th>
          <th>
            Package ID
        </th>
        
    </tr>
    <?php
        foreach($vars->users as $user) {
            echo '<tr>';
               
                echo '<td>';
                    echo '<a href="'.$this->link('user','view','?id='.$user->id,true) .'">'.$user->id.'</a>';
                echo '</td>';
                echo '<td>';
                    echo $user->wid;
                echo '</td>';
                echo '<td>';
                    echo $user->email;
                echo '</td>';
                echo '<td>';
                    echo $user->real_name;
                echo '</td>';
				echo '<td>';
                    echo $user->hostname;
                echo '</td>';
                echo '<td>';
                    echo $user->type;
                echo '</td>';
				 echo '<td>';
                    echo $user->transactionnum;
                echo '</td>';
                    echo '<td>';
                    echo $this->datetime($user->paydate);
                echo '</td>';
                   echo '<td>';
                    echo $user->price;
                echo '</td>';
                   echo '<td>';
                    echo $user->pack_id;
                echo '</td>';
            echo '</tr>';
        }
    ?>
</table>


<?php
}
    if(!empty($vars->testusers)) {
?>
<br/>
<br/>
<h2>
    Test Users
</h2>
<table class="users">
    <tr>
      
        <th>
            ID
        </th>
        <th>
            Webshop ID
        </th>
        <th>
            Email
        </th>
        <th>
            Name
        </th>
         <th>
            Host
        </th>
           <th>
            Type
        </th>
         <th>
            TNum
        </th>
           <th>
            Paydate
        </th>
    </tr>
    <?php
        foreach($vars->testusers as $user) {
            echo '<tr>';
               
                echo '<td>';
                    echo '<a href="'.$this->link('user','view','?id='.$user->id,true) .'">'.$user->id.'</a>';
                echo '</td>';
                echo '<td>';
                    echo $user->wid;
                echo '</td>';
                echo '<td>';
                    echo $user->email;
                echo '</td>';
                echo '<td>';
                    echo $user->real_name;
                echo '</td>';
                echo '<td>';
                    echo $user->hostname;
                echo '</td>';
                echo '<td>';
                    echo $user->type;
                echo '</td>';
                 echo '<td>';
                    echo $user->transactionnum;
                echo '</td>';
                    echo '<td>';
                    echo $this->datetime($user->paydate);
                echo '</td>';
            echo '</tr>';
        }
    ?>
</table>

<?php
    }
    if(!empty($vars->deletedUsers)) {
?>
<br/>
<br/>
<h2>
    Deleted Users
</h2>
<table class="users">
    <tr>
        <th>
            Actions
        </th>
        <th>
            ID
        </th>
        <th>
            Webshop ID
        </th>
        <th>
            Email
        </th>
        <th>
            Name
        </th>
        <th>
            Time of Deletion
        </th>
    </tr>
    <?php
        foreach($vars->deletedUsers as $user) {
            echo '<tr>';
                echo '<td>';
                echo '<div class="actions">';
                    echo '<a href="'.$this->link('user','recover','?id='.$user->id,true).'">Recover</a>';
                    echo ' | ';
                    echo '<a href="'.$this->link('user','purge','?id='.$user->id,true).'">Purge</a>';
                echo '</div>';
                echo '</td>';
                echo '<td>';
                    echo $user->id;
                echo '</td>';
                echo '<td>';
                    echo $user->wid;
                echo '</td>';
                echo '<td>';
                    echo $user->email;
                echo '</td>';
                echo '<td>';
                    echo $user->name;
                echo '</td>';
                echo '<td>';
                    echo $user->deleteTime;
                echo '</td>';
            echo '</tr>';
        }
    ?>
</table>

<?php
   }
?>