<?php

class Application_Model_AdminViewHelper
{
       const LOGIN_ACTION = 'login';
       const REGISTER_ACTION = 'register';
       
       public function loggedIN()
       {
           $action = Zend_Controller_Front::getInstance()->getRequest()->getActionName();
           if(!Zend_Auth::getInstance()->hasIdentity() && $action != self::LOGIN_ACTION && $action != self::REGISTER_ACTION)
               return false;
           else
               return true;
       }
}
?>
