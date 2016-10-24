<h1>Status</h1>
<div>
<?php echo $vars->error ?>
</div>
<?php if(!$vars->products) : ?>
<p>
    Vi har endnu ikke besøgt din webshop. <br />Hvis din webshop ikke er besøgt inden for en time efter du har installeret modulet til din webshop skal du kontakte info@vubla.com.
    <?php if($vars->isBeeingCrawled){ ?>
       <br /> Lige nu bliver din webshop besøgt. Hvis vi ikke er færdig inden for et par timer bedes du kontakte info@vubla.com
    
    <?php } ?>

</p>
<?php else : ?>

<div class="two-column-left">
    <h2>Sidst opdateret</h2>
    <p>
        Her kan du se hvornår Vubla sidst var forbi din webshop for at opdatere dine produkter.
    </p>
    Sidste besøg: <b><?php echo $this->time($vars->lastcrawled) ?></b><br />
    Næste planlagte besøg: <b><?php echo $this->time($vars->nextCrawl) ?> (+/- 1 time)</b> <br />
    <br />
    Hvis du ønsker at få besøgt din webshop tidligere kan du klikke på knappen nedenfor
    <form action="<?php echo $this->link('status','crawlprior');?>" method="post">
        <input type="submit" name="crawl" class="crawl" value="Besøg hurtigst muligt" />
    </form>
</div>

<div class="two-column-right">
    <h2>Abonnement</h2>
    
    Du har <b><?php echo $vars->products ?></b> produkter og du må maks have <b><?php echo $vars->max_products ?></b> før du skal skifte til en større pakke.
    <div id="progressbar"></div>
    <br />
    
    <?php 
    if($vars->paydate >= 0 || $vars->hasTnum){
        if($vars->isTrial){ ?>
           Du har <b><?php echo ceil((($vars->paydate-time())/60/60/24)); ?></b> dage tilbage af din gratis prøve periode.
           Din pakke koster <b><?php echo $vars->next_price ?></b> DKK.
        <?php } else { ?>
           Næste betaling falder <b><?php echo $this->date($vars->paydate) ?></b> beløbet er <b><?php echo $vars->next_price ?></b> DKK.<br />
        <?php 
        } 
    }  
    if($vars->paydate <= 0 && $vars->isTrial && !$vars->hasTnum){ 
        ?>Din prøve periode er udløbet.   
            <form action="<?php  $this->link('payment'); ?>" method="post">
                <input type="submit" name="crawl" class="pay" value="Køb Vubla" />
            </form> 
            <br />
     <?php
  
  }  elseif(!$vars->hasTnum && VUBLA_DEBUG) { // The vubla debug should be removed ?>
        <br /> 
        Du har endnu ikke købt vubla.   
        <form action="<?php echo $this->link('payment');?>" method="post">
            <input type="submit" name="pay" class="pay" value="Køb vubla" />
        </form> <br />
   <?php
    }
    if ($vars->webshop->pack_id != $vars->webshop->next_pack_id) {
        if($vars->next_max_products <= $vars->products ){ ?>
            <br /> <b>Vigtigt!</b> I næste måned skifter du til en pakke der gør at vi ikke kan finde alle dine produkter. 
            <br /> Vi anbefaler at du skifter til en større pakke.<br />
        <?php   
        }
    }
    
     if($vars->products > $vars->max_products) { ?>
    <p><br />
        <b>Vigtigt!</b> Du har i øjeblikket flere produkter på din webshop end din pakke tillader.<br/>
        
        For at opgradere antallet af tilladte produkter.
    </p>
    <?php } elseif($vars->products*$vars->warnRatio > $vars->max_products) { ?>
    <p><br />
        Du er tæt på at overskride det maksimale antal produkter for din nuværende pakke.<br/>
        
        Overvej at opgradere din pakke til at tillade flere produkter med det samme for at undgå at nye produkter ikke kan findes med Vubla<br/>
        
    </p>
    <?php }?>
        <br /> Hvis du ønsker at skifte pakke kan du vælge det herunder <br />
        <form action="<?php  $this->link('payment','changepackage'); ?>" method="post">
            <?php 
            if($vars->webshop->next_pack_id != 1 && $vars->products <= $vars->products_small){ ?>
            <input type="submit" name="pack[1]" class="pack_small" value="Lille" />
                <?php
            } 
            if($vars->webshop->next_pack_id != 2 && $vars->products <= $vars->products_medium){ ?>
                
            <input type="submit" name="pack[2]" class="pack_medium" value="Mellem" />
                <?php
    
            } 
            if($vars->webshop->next_pack_id != 3 && $vars->products <= $vars->products_medium){ ?>
            <input type="submit" name="pack[3]" class="pack_large" value="Stor" />
                <?php
            } ?>
        
        </form> 
    <?php
         
    
    ?> 
</div>
<?php endif ?>