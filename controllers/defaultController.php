<?php
/**
 * This controller is the default controller,
 * Do not add any methods to it. This controller is special since it takes care of login.
 * 
 */ 
class defaultController extends BaseController {

    function standard(){
        $this->redirect('default','tools');
    }
    
    function tools(){
        $this->vars->moneySoFar = (VPDO::getVdo(DB_METADATA)->fetchOne(
            "SELECT (case currency when 'DKK' then (((sum(amount)/100)*0.80) /6) when 'USD' then ((sum(amount)/100)*0.80)  else 0 end ) 
            FROM `payments_log` pl
            where pl.chstat=0 and pl.qpstat=0 and wid != 12"));//,2,',','.');
        $aMonthFromNow = time() + 60*60*24*30;
        $this->vars->moneyPerMonth = (VPDO::getVdo(DB_METADATA)->fetchOne(
            'SELECT (sum(prices.value))
            FROM `webshops` shops 
                inner join `subscription_packages` packs on packs.id = shops.next_pack_id
                inner join prices on prices.price_id = packs.price_id  
            where shops.transactionnum > 1 and shops.test_shop = 0 and prices.language_id = 2 and shops.paydate < '.$aMonthFromNow));//,2,',','.');
        $this->view = 'othertools';
        
        $aMonthBackQuickPay = date('ymdHis',time() - 60*60*24*30);
        $this->vars->moneyEarnedLastMonth = (VPDO::getVdo(DB_METADATA)->fetchOne(
            "SELECT (case currency when 'DKK' then (((sum(amount)/100)*0.80) /6) when 'USD' then ((sum(amount)/100)*0.80)  else 0 end )
            FROM `payments_log` pl 
                inner join webshops w on w.id = pl.wid 
            where  w.test_shop = 0 and pl.chstat = 0 and (CAST(pl.time AS decimal(20,0)) > ".$aMonthBackQuickPay.')'));//;,2,',','.');





    }
  

}

?>