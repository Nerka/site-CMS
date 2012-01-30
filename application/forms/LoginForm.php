<?php
class Application_Form_LoginForm extends Zend_Dojo_Form
{
    public $buttonDecorators = array(
        'DijitElement',
	array(array('data' => 'HtmlTag'), array('tag' => 'dd', 'class' => 'buttonElement')),
	array(array('label' => 'HtmlTag'), array('tag' => 'dt', 'placement' => 'buttonLabel')),
    );
    public function init()
    {
        $this->setName('loginForm');
        $this->setMethod('post');
        $this->setAction('/admin/login');
        
        $this->addElement('ValidationTextBox', 'email', array(
            'validators'    =>  array('EmailAddress'),
            'regExp'        =>  "\b[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}\b",
            'required'      =>  true,
            'label'         =>  'E-mail',
            'class'         =>  'siteCMSInputs'
        ));

        $this->addElement('PasswordTextBox', 'password', array(
            'required'  =>  true,
            'type'      =>  'password',
            'label'     =>  'Password',
            'class'     =>  'siteCMSInputs'
        ));

        $this->addElement('button', 'register', array(
            'label'         =>	'Login',
            'decorators'    =>	$this->buttonDecorators,
            'baseClass'     =>  'siteCMSButtons',
            'type'          =>  'submit'
        ));
    }
}