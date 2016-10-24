<?php

class userController extends BaseController {
    function standard() {
        $this->redirect('user','index');
    }
    
    function index() {
        $this->view = 'userindex';
        $this->vars->users = User::getAllNonTestUsers();
        $this->vars->testusers = User::getAllTestUsers();
      
        $this->vars->deletedUsers = User::getAllDeletedUsers();
        foreach($this->vars->deletedUsers as $user) {
            $user->deleteTime = date("Y-m/d H:i:s",$user->delete_time);
        }
    }
    
    function delete() {
        if(isset($_GET) && isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->vars->controller = 'user';
            $this->vars->task = 'delete';
            $this->vars->message = 'Are you sure you want to delete user with id: ' . $id . '?';
            $this->vars->posts = array('id' => $id);
            $this->view = 'confirm';
            
        } else {
            if(isset($_POST) && isset($_POST['ok']) && isset($_POST['id'])) {
                $id = $_POST['id'];
                $user = new User();
                $errors = $user->delete($id);
                if(!empty($errors)) {
                    $this->vars->error = $errors[0];
                    $this->view = 'userindex';
                } else {
                    $this->redirect('user','index');
                }
            } else {
                $this->redirect('user','index');
            }
        }
    }
    
    function recover() {
        if(isset($_GET) && isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->vars->controller = 'user';
            $this->vars->task = 'recover';
            $this->vars->message = 'Are you sure you want to recover user with id: ' . $id . '?';
            $this->vars->posts = array('id' => $id);
            $this->view = 'confirm';
            
        } else {
            if(isset($_POST) && isset($_POST['ok']) && isset($_POST['id'])) {
                $id = $_POST['id'];
                $user = new User();
                $errors = $user->recover($id);
                if(!empty($errors)) {
                    $this->vars->error = $errors[0];
                    $this->view = 'userindex';
                } else {
                    $this->redirect('user','index');
                }
            } else {
                $this->redirect('user','index');
            }
        }
    }
    
    function purge() {
        if(isset($_GET) && isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->vars->controller = 'user';
            $this->vars->task = 'purge';
            $this->vars->message = 'Are you sure you want to purge(delete permanently) user with id: ' . $id . '?';
            $this->vars->posts = array('id' => $id);
            $this->view = 'confirm';
            
        } else {
            if(isset($_POST) && isset($_POST['ok']) && isset($_POST['id'])) {
                $id = $_POST['id'];
                $user = new User();
                $errors = $user->purge($id);
                if(!empty($errors)) {
                    $this->vars->error = $errors[0];
                    $this->view = 'userindex';
                } else {
                    $this->redirect('user','index');
                }
            } else {
                $this->redirect('user','index');
            }
        }
    }
    
    function create() {
        if(isset($_GET)) {
            
        } else {
            if(isset($_POST) && isset($_POST['ok'])) {
                
            } else {
                $this->redirect('user','index');
            }
        }
    }
    
    function resetcrawl() {
        if(isset($_GET) && isset($_GET['id'])) {
            $id = $_GET['id'];
            $user = new User();
            if($user->crawlAtNextCron($id)) {
                $this->vars->error = 'User with id: '.$id.' will be crawled soon!';
                $this->view = 'userindex';
            } else {
                $this->vars->error = 'Failed to set to be crawled, maybe illegal id';
                $this->view = 'userindex';
            }
        } else {
            $this->vars->error = 'No id given to reset crawl';
            $this->view = 'userindex';
        }
    }
    
    function view()
    {
        if(isset($_GET) && isset($_GET['id']))
        {
            $this->view = 'user';
            $sql = 'select * from customers c  left join webshops w using(id) left join crawllist l on l.wid = c.id  where id = ?';
            $stm = vdo::meta()->prepare($sql);
            $stm->execute(array($_GET['id']));
            $user = $stm->fetchObject();
            $stm->closeCursor();
            $this->vars->user = get_object_vars($user);
            $this->vars->user['email'] = $this->setLinkEmail($this->vars->user['email']);
            $this->vars->user['hostname'] = $this->setLinkHostname($this->vars->user['hostname']);
            $dataFormat = "jS F-Y, G:i";
            $this->vars->user['paydate'] = date($dataFormat,$this->vars->user['paydate']);
            $this->vars->user['last_crawled'] = date($dataFormat,$this->vars->user['last_crawled']);
            $this->vars->user['last_updated'] = date($dataFormat,$this->vars->user['last_updated']);
            $this->vars->user['crawl_interval'] = $this->time_elapsed_B($this->vars->user['crawl_interval']);
            $this->vars->user['update_interval'] = $this->time_elapsed_B($this->vars->user['update_interval']);
        }
        else {
            $this->vars->error = 'No id given to statistics';
            $this->view = 'userindex';
        }
    }

    private function setLinkEmail($email) 
    {
        return '<a href="mailto:'.$email.'">'.$email.'</a> ';
    }

    private function setLinkHostname($host) 
    {
        return '<a href="http://'.$host.'">'.$host.'</a> ';
    }

    private function time_elapsed_B($secs){
        $bit = array(
            ' year'        => $secs / 31556926 % 12,
            ' week'        => $secs / 604800 % 52,
            ' day'        => $secs / 86400 % 7,
            ' hour'        => $secs / 3600 % 24,
            ' minute'    => $secs / 60 % 60,
            ' second'    => $secs % 60
            );
            
        foreach($bit as $k => $v)
        {
            if($v > 1)$ret[] = $v . $k . 's';
            if($v == 1)$ret[] = $v . $k;
        }
        
        return join(' ', $ret);
    }
}
