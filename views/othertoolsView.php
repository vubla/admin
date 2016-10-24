<div style="float:left;">
<a href="https://admin.search.vubla.com/apc.php">APC on search</a><br>
<a href="https://admin.vubla.com/notforanders/apc.php">APC on crawler</a><br>
<a href="https://admin.search.vubla.com/cacti/index.php">Cacti on search</a><br>
<a href="https://admin.vubla.com/cacti/index.php">Cacti on Crawler</a><br>
<a href="https://db.vubla.com">phpMyAdmin on Search</a><br>
<a href="https://admin.vubla.com/somedbmanager">phpMyAdmin on Crawler</a><br>
<a href="https://devwiki.vubla.com">Developer Wiki</a><br/>
<a href="https://admin.vubla.com/xref/output/index.html">Xref</a><br/>
<a href="https://admin.vubla.com/settings/language">settings strings</a><br/>
<a href="<?php echo LOGIN_URL; ?>/scrape/index">Scraper Interface</a><br/>

<br/><br/>

<br/><br/><br/><br/>
Money made so far:<b>
<?
echo number_format($vars->moneySoFar,2,',','.');

?>
</b> USD<br/><br/>
Money to come in the following 30 days:<b>
<?
echo number_format($vars->moneyPerMonth,2,',','.');

?>
</b> USD<br/><br/>
Money earned in the last 30 days:<b>
<?
echo number_format($vars->moneyEarnedLastMonth,2,',','.');

?>
</b> USD<br/><br/>
</div>
<div style="float:left;">

<?php

if(((int)$vars->moneyPerMonth) > ((int)$vars->moneyEarnedLastMonth))
{
    ?>   <img width="200px" src="http://futureupdate.files.wordpress.com/2008/04/happy-face_happyface_smiley_2400x2400.jpg"> <?php
} else 
    {
         ?>  <img  width="200px" src="http://cdn4.staztic.com/cdn/screenshot/smile-red-and-yellow-live-wall-1-1.jpg">   <?php
    }

?>

</div>
