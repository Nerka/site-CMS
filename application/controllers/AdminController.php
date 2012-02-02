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
        $userData = Zend_Auth::getInstance()->getStorage()->read();
        $this->view->userData = json_encode($userData);
    }
    
    public function modelsAction()
    {
        $this->_helper->layout->disableLayout();
        $modelsMapper = new Application_Model_ModelsMapper();
        $models = $modelsMapper->getModelsDojoData();
        echo $models;
    }
    
    public function pagesAction()
    {
        $this->_helper->layout->disableLayout();
        Zend_Dojo_View_Helper_Dojo::setUseDeclarative();
        $modelsMapper = new Application_Model_ModelsMapper();
        $pages = $modelsMapper->getModelsSystem()->getPages();
        $this->view->pages = json_encode($pages->toArray());
    }
    
    public function savepageAction()
    {
        $this->_helper->layout->disableLayout();
        $userData = Zend_Auth::getInstance()->getStorage()->read();
        if ($this->getRequest()->isPost())
        {
            $date = new Zend_Date();
            $date = $date->get('yyyy-MM-dd HH:mm:ss');
            $page = new Application_Model_Page($this->getRequest()->getParams());
            $page->setUsers_id($userData->id)
                 ->setSystem_id($userData->system_id)
                 ->setCreatedat($date);
            
            $pageMapper = new Application_Model_PageMapper();
            $lastId = $pageMapper->createPage($page);
            
            echo json_encode(array(
                    'id'    => $lastId, 
                    'name'      => $page->getName(), 
                    'createdat' => $page->getCreatedat()
                ));
        }
    }
    
    public function removepageAction()
    {
        if ($this->getRequest()->isPost())
        {
            if($this->getRequest()->getParam('id'))
            {
                $pageMapper = new Application_Model_PageMapper();
                $pageMapper->removePage($this->getRequest()->getParam('id'));
            }
        }
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect('/admin/login');
    }
}
