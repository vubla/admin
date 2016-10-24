<?php

if(!defined('INVOICE_PATH')) define ('INVOICE_PATH','/var/www/admin.vubla.com/htdocs/invoices/' );

class webshopController extends BaseController {
   
    function standard() {
        $this->redirect('user','index');
    }
    
    function loginas(){
           $salt = "superman";
           $this->view = 'loginas';
         $db = VPDO::getVdo(DB_METADATA);
         $db->exec('delete from secure_logins where  uid = '.(int)$_GET['id']);   
         if(!isset($_SERVER['PHP_AUTH_USER']) ){
            $this->vars->link = 'no autg!!';
             return false;
         }  
         $time = time();
         $sql = "insert into secure_logins (uid,ip, time, name) values (" .$db->quote($_GET['id']).  ", ". $db->quote($_SERVER['REMOTE_ADDR'])." ,'".
                                                                            $time. "', '".
                                                                           $_SERVER['PHP_AUTH_USER']."' )";
         $db->exec($sql);
         $email = $db->fetchOne('select email from customers  where id = ?', array($_GET['id']));
         echo $salt. $time. $_SERVER['PHP_AUTH_USER']. $_SERVER['REMOTE_ADDR']. $email . $salt;
        $this->vars->link = '?master='. md5($salt. $time. $_SERVER['PHP_AUTH_USER']. $_SERVER['REMOTE_ADDR']. $email . $salt). '&id='. $_GET['id'];
       
    }

 	function soap(){
 		
 		$wid = $_GET['id'];
		if($wid < 1){
    		throw new Exception("Missing wid");
    	}
    	
     	$this->vars->error = '';
        // Magento login information 
         $this->key = Settings::get('mage_api_key', $wid); 

        try {
        $this->soap =  MagentoSoapClientFactory::getFactory($wid)->create();
        }
        catch (Exception $e)
        {
            $this->vars->error  = $e;
        }
		$result = null;
		@$function = $_GET['function'];
		if($function && $this->vars->error == ''){
			
			try {
    			if(($_GET['arg2']))
    			{
    				$result = $this->soap->call ($function,array($_GET['arg1'],$_GET['arg2'] ));
    			} 
    			elseif(($_GET['arg1']))
    			{
    				$result = $this->soap->call ($function,$_GET['arg1'] );
    			}
    			else {
    				$result = $this->soap->call ($function  );
    			}
                if($result == NULL)
                {
                    $this->vars->error = $this->soap->getLastError();
                }
			} catch (SoapFault $e){
				$this->vars->error = $e;
			}
		}
		
		$this->vars->result = $result;
		$this->view = "soap";
 	}
 
    function sanity()
    {
        $sc = new SanityChecker($_GET['id']);
        $this->view = "data";
        $this->vars->data =  $sc->generateReport();
    }
    
    function info(){
        
    }
    
    function statistics() 
    {
        if(isset($_GET) && isset($_GET['id'])) {
            $wid = $_GET['id'];
            $statProvider = new WebshopStatisticsProvider($wid);
            $this->vars->numSearchesPerWord = $statProvider->getNumberOfSearchesPerNumberOfKeywords();
            $this->vars->numOfWords = $statProvider->getNumberOfWords();
            $this->vars->numOfRankedWords = $statProvider->getNumberOfRankedWords();
            $this->vars->percentageRanked = number_format(($this->vars->numOfRankedWords*100)/$this->vars->numOfWords,2);
            $this->vars->percentageRankedThreshold = number_format(Settings::get('ranked_search_threshold',$wid),2);
            $this->vars->numOfWordsToCareAbout = $statProvider->getNumberOfWordsNotDontCare();
            $this->vars->wid = $wid;
            $this->view = 'webshopstat';
        } else {
            $this->vars->error = 'No id given to statistics';
            $this->view = 'userindex';
        }
    }
    function newpaydate() 
    {
        if(isset($_GET) && isset($_GET['id'])) {
            $wid = $_GET['id'];
            $sql = 'select * from customers c  left join webshops w using(id) left join crawllist l on l.wid = c.id  where id = ?';
            $stm = vdo::meta()->prepare($sql);
            $stm->execute(array($wid));
            $user = $stm->fetchObject();
            $stm->closeCursor();
            $this->vars->completeDate = date("jS F-Y, G:i",$user->paydate);
            $data = explode(' ',date("Y n j G i",$user->paydate));
            $this->vars->date = array();
            $this->vars->date['year'] = $data[0];
            $this->vars->date['month'] = $data[1];
            $this->vars->date['date'] = $data[2];
            $this->vars->date['hour'] = $data[3];
            $this->vars->date['minute'] = $data[4];
            $this->vars->name = $user->hostname;
            $this->vars->wid = $wid;
            $this->view = 'webshoppaydate';
        }
        else if(isset($_POST) && isset($_POST['id']))
        {
            $db = VPDO::getVdo(DB_METADATA);
            $wid = $_POST['id'];
            $dateString = $_POST['year'].' '.
                $_POST['month'].' '.
                $_POST['date'].' '.
                $_POST['hour'].' '.
                $_POST['minute'];
            $newTimestamp = DateTime::createFromFormat("Y n j G i",$dateString)->getTimestamp();
            
            $query = new UpdateQuery('webshops',$db);
            $query->set('paydate',$newTimestamp)->where('id='.$db->quote($wid));
            $query->execute();
            $this->redirect('user','view',null,array('id'=>$wid));
        } 
        else {
            $this->vars->error = 'No id given to statistics';
            $this->view = 'userindex';
        }
    }

    function swaptestshop() 
    {
        if(isset($_GET) && isset($_GET['id'])) {
            $wid = $_GET['id'];
            $db = VPDO::getVdo(DB_METADATA);
            $query = new UpdateQuery('webshops',$db);
            $query->set('test_shop','1-test_shop',false)->where('id='.$db->quote($wid));
            $query->convertToSqlString();
            $query->execute();
            $this->redirect('user','view',null,array('id'=>$wid));
        }
    } 
    
    function generateinvoice()
    {
        if(isset($_GET) && isset($_GET['id'])) {
            $wid = $_GET['id'];
            $sql = 'select *, c.name as fullname from customers c  left join webshops w using(id) left join crawllist l on l.wid = c.id  where id = ?';
            $stm = vdo::meta()->prepare($sql);
            $stm->execute(array($wid));
            $user = $stm->fetchObject();
            $stm->closeCursor();
            $this->vars->wid = $wid; 
            $this->vars->name = $user->hostname;
            $vat = settings::get('payment_vat',$wid);
            $pack_name = '';
            switch($user->next_pack_id){
                case 1:
                    $pack_name = __('Lille');
                    break;
                case 2:
                    $pack_name =  __('Mellem');
                    break;
                case 3:
                    $pack_name =  __('Stor');
                    
                    break;
                default:
                    $pack_name =  __('Speciel');
            }
            $address = 'v/'.$user->fullname. "\n\n".
                       $user->address . "\n\n".
                       ($user->address2? $user->address2. "\n\n" : null) .
                       $user->postal . $user->city. "\n\n".
                       $user->phone ."\n\n".
                       $user->email;
            
            $this->vars->data = array();
            $this->vars->data['invoice_nr'] = $wid.'-'.time();
            $this->vars->data['date'] = date('d-m-Y',$user->paydate);
            $this->vars->data['company'] = $user->company;
            $this->vars->data['address'] = $address;
            $this->vars->data['pack_name'] = $pack_name;
            $this->vars->data['amount'] = (int) 100*Payment::getNextPrice($wid);
            $this->vars->data['currency'] = Payment::getCurrency($wid);
            $this->vars->data['vat'] = $vat;
            $this->vars->data['email'] = $user->email;
            $this->vars->data['fullname'] = $user->fullname;
            
            $this->vars->textarea = array();
            $this->vars->textarea['address'] = 1;
            $this->vars->messages = array();
            $this->vars->messages['invoice_nr'] = 'Should have format: &lt;wid&gt;-&lt;unix timestamp&gt;';
            $this->vars->messages['date'] = 'Leave blank to derive date from invoice nr';
            $this->vars->messages['vat'] = '25% = 1.25, 0% = 1.00';
            $this->vars->messages['amount'] = 'This is en cents/øre';
            $this->vars->messages['currency'] = 'DKK/USD';
            $this->vars->messages['email'] = 'Only relevant for sending invoice, not generation';
            $this->vars->messages['fullname'] = 'Only relevant for sending invoice, not generation';
            $this->view = 'generateinvoice';
        }
        else if(isset($_POST) && isset($_POST['id']))
        {
            $wid = $_POST['id'];
            if($_POST['generate'])
            {
                $invoice_nr = $_POST['invoice_nr'];
                $date = $_POST['date'];
                $company = $_POST['company'];
                $address = $_POST['address'];
                $pack_name = $_POST['pack_name'];
                $amount = $_POST['amount'];
                $currency = $_POST['currency'];
                $vat = $_POST['vat'];
                $email = $_POST['email'];
                $fullname = $_POST['fullname'];
                $purchases = array(
                    array(__('Vubla Interne Søgmaskine').' ('.$pack_name.')',$amount/100)
                    );
                    
                if(empty($date))
                {
                    $temp = explode('-', $invoice_nr);
                    $date = date('d-m-Y',$temp[1]);
                }
                $pdf = new Invoice();
                $pdf->createInvoice($invoice_nr,$date,$company,$address,$purchases, $currency,$vat*100-100);
                $this->view = 'confirm';
                $this->vars->controller = 'webshop';
                $this->vars->task = 'sendinvoice';
                $this->vars->posts = array('id'=>$wid,'email'=>$email,'fullname'=>$fullname,'invoice_nr'=>$invoice_nr);
                $this->vars->message = 'The invoice is generated as: <a href="'.LOGIN_URL.'/invoices/'.$invoice_nr.'.pdf">'.INVOICE_PATH.$invoice_nr.'</a><br><br>Send generated invoice to: <b>'.$email.'</b>?';
            }
            else {
                $this->redirect('user','view',null,array('id'=>$wid));
            }
        }
        else {
            $this->vars->error = 'No id given to generate invoice';
            $this->view = 'userindex';
	
        }
    }

    function sendinvoice()
    {
        if(isset($_POST) && isset($_POST['id']))
        {
            $wid = $_POST['id'];
            if($_POST['ok'])
            {
                $invoice_nr = $_POST['invoice_nr'];
                $email = $_POST['email'];
                $fullname = $_POST['fullname'];
                $response = VublaMailer::sendPaymentEmail($email,$fullname, $invoice_nr);
                $this->vars->error = 'Please remember to move the invoice from: ' . INVOICE_PATH . $invoice_nr. '.pdf to /var/vubla/invoices.<br><br>I would do it if I could, but I do not have the permissions for it :(';
                $this->view = 'userindex';
            }
            else {
                $this->redirect('user','view',null,array('id'=>$wid));
            }
        }
        else {
            $this->vars->error = 'No id given to send invoice';
            $this->view = 'userindex';
        }
    }
    
    function settings()
    {
        $wid = $this->getRequestVariable('id');
        if(isset($_POST) && sizeof($_POST) > 1) {
            if(isset($_POST['submitSettings'])) {
                $_POST['submitSettings'] = null;
                Settings::setAllLocal($_POST, $wid);
                $this->vars->msg = __('Indstillingerne er gemt');
            }
            elseif(isset($_POST['submitUserData'])) 
            {
                $errors = VublaFramework::$user->updateCustomerData($_SESSION['uid'],$_POST);
                $this->vars->msg = '';
                if(is_array($errors)){
                    foreach($errors as $error) {
                        $this->vars->msg .= $error;
                    }
                }
                if(empty($this->vars->msg)) {
                    $this->vars->msg = __('Indstillingerne er gemt');
                } else {
                    $this->vars->msg .= __(' Indstillingerne er ikke gemt!');
                }
            }
        }  
        ########## SETTINGS
        $this->vars->list = Settings::getSettingsArray($wid, array(0,1));
        $this->view = 'settings';
        
        ############ PERSONAL INFO
        $this->vars->personnalSettings = array();
        $data = VublaFramework::$user->getCustomerData($_SESSION['uid']);
        $longNames = array(
            __("Fulde Navn"),
            //"E-mail",
            __("Telefon Nummer"),
             __("Virksomhed"),
            __("Addresse"),
            "",
           
             __("Postnummer"),
            __("By")
           
        );
        $descriptions = array(
            "",
            //"Det er denne E-mail vi vil kontakte dig på. OBS hvis du ændre din email, skal den aktiveres igen!",
            "",
            "",
            "",
            "",
            "",
            ""
        );
        $i = 0;
        foreach($data as $col => $val){
            $work = new stdClass();
            $work->name = $col;
            $work->value = $val;
            $work->description = $descriptions[$i];
            $work->longName = $longNames[$i];
            $work->type = "text";
            $this->vars->personnalSettings[] = clone $work;
            $work = null;
            $i++;
        }
        
        $password = new stdClass();
        $password->name = 'newPassword';
        $password->value = '';
        $password->description = __("Indtast dit nye kodeord her");
        $password->longName = __("Nyt Kodeord");
        $password->type = "password";
        $this->vars->personnalSettings[] = $password;
        
        $password2 = new stdClass();
        $password2->name = 'newPassword2';
        $password2->value = '';
        $password2->description = __("Genindtast dit nye kodeord her");
        $password2->longName = __("Gentast Nyt Kodeord");
        $password2->type = "password";
        $this->vars->personnalSettings[] = $password2;
        $this->addJs(LOGIN_URL.'/js/jquery.ibutton.min.js');
        $this->addCss(LOGIN_URL.'/stylesheets/jquery.ibutton-giva-original.css');
        //$this->addCss(LOGIN_URL.'/stylesheets/controlpanel.css');
    }
}
