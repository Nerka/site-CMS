<?php
/*
 * Description of IndexController
 *
 * @author Nerutiz
 */
class AdminController extends Zend_Controller_Action
{
    public function init()
    {
        $user = new Application_Model_User();
        if(!$user->loggedIn())
            $this->_redirect('/admin/login');
        else 
            $this->_helper->layout()->setLayout('notlogged');
    }
    

    public function loginAction()
    {
        $this->view->loginForm = new Application_Form_LoginForm();
    }
    
    public function registerAction()
    {
        $registrationForm = new Application_Form_RegisterForm();
        
        $validator = new Zend_Validate_Db_RecordExists(
            array(
            'table' => 'users',
            'field' => 'email'
        ));
        
        $this->view->registrationForm = $registrationForm;
        
        if ($this->getRequest()->isPost())
        {
            if ($registrationForm->isValid($this->getRequest()->getPost()))
            {
                if (!$validator->isValid($registrationForm->email->getValue()))
                {
                    $user = new Application_Model_User($registrationForm->getValues());
                    $userMapper = new Application_Model_UserMapper();
                    $userMapper->saveUser($user);
                    
                    $user->authenticateUser($user->getEmail(), $user->getPassword());
                    $this->_redirect('/');
                }
            }
        }
    }
}
