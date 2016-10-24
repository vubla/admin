<h1>Prøv Vubla</h1>
<?php 
if( isset($_GET['q'])){
    $_POST['q'] = $_GET['q'];
}
?>
<div class="two-column-left">
	<h2>Prøve din søgemaskine</h2>
	<p>
		Nedenfor kan du prøve Vubla søgemaskinen. Du søger efter de produkter, der også findes i din webshop
	</p>
	<p>
		<b>Husk:</b> Prøv at søge efter ord med æ, ø eller å. Hvis produkter ikke vises korrekt, da gå til <a href="<?php $this->link('settings'); ?>">indstillinger</a> og slå "aktiv encoding" til.
	</p>
	
	<form method="post" accept-charset="utf-8" action="<?php $this->link('searchlayout', 'view'); ?>">
		<input name="host" type="text" value="<?php echo $_POST['host']; ?>"/> 
		<input name="q" type="text" value="<?php echo $_POST['q']; ?>"/> <input name="search_submit" type="submit" value="Søg"/>
	</form>

	<?php 
	
    	if(isset($_POST['search_submit']) || isset($_GET['q'])){

           
            //echo '<pre>';
            $link = API_URL.'/search/?q='.urlencode($_POST['q']).'&host='.urlencode($_POST['host']).'&param=q&enable=1';
            //echo '<a href="'.$link.'">fff</a>';
            //echo '</pre>';
            echo file_get_contents($link); 
		}
	?>
</div>

<div class="two-column-right">
	<h2>Udseende</h2>
	<p>
		Her kan du ændre udseendet af søgeresultatet, lige fra teksttyper til farver.<br />
		<a href="<?php $this->link('searchlayout', 'edit'); ?>">Klik her</a>
	</p>
</div>

