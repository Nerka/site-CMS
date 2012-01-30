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
    }

    public function loginAction()
    {
        $this->_helper->layout()->setLayout('notlogged');
        
        $loginForm = new Application_Form_LoginForm();
        $user = new Application_Model_User();
        
        if ($this->getRequest()->isPost())
        {
            if ($loginForm->isValid($this->getRequest()->getPost()))
            {
                $request = $this->getRequest();
                $authentication = $user->authenticateUser($request->getParam('email'), $request->getParam('password'));
            
                if(!$authentication)
                {
                    $loginForm->getElement('email')->setValue($loginForm->getValue('email'));
                    $loginForm->getElement('password')->setValue('');
                    $this->view->authenticationMessage = "Wrong username or password provided. Please try again.";
                }
                else
                    $this->_redirect('/admin/');
            }   
        } 
        
        $this->view->loginForm = $loginForm;
    }
    
    public function registerAction()
    {
        $this->_helper->layout()->setLayout('notlogged');
        
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
                    $this->_redirect('/admin/');
                }
            }
        }
    }
    
    public function indexAction()
    {
        
    }
    
    public function modelsAction()
    {
        $this->_helper->layout->disableLayout();
        $modelsMapper = new Application_Model_ModelsMapper();
        $models = $modelsMapper->getModelsDojoData();
        echo $models;
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect('/admin/login');
    }
}
