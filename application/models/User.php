<?php
class Application_Model_User
{
    protected $_id;
    protected $_username;
    protected $_password;
    protected $_firstname;
    protected $_lastname;
    protected $_email;
    protected $_address;
    protected $_photo;
    protected $_status;
    protected $_systemId;

    const LOGIN_ACTION = 'login';
    const REGISTER_ACTION = 'register';

    public function __construct(array $options = null)
    {
        if (is_array($options))
            $this->setOptions($options);
    }
    
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) 
        {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) 
                $this->$method($value);
        }
        return $this;
    }
    
    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }
    
    public function getId()
    {
        return $this->_id;
    }
    
    public function setUsername($username)
    {
        $this->_username = $username;
        return $this;
    }
    
    public function getUsername()
    {
        return $this->_username;
    }

    public function setPassword($password)
    {
        $this->_password = $password;
        return $this;
    }
    
    public function getPassword()
    {
        return $this->_password;
    }

    public function setFirstname($firstname)
    {
        $this->_firstname = $firstname;
        return $this;
    }
    
    public function getFirstName()
    {
        return $this->_firstname;
    }
    
    public function setLastname($lastname)
    {
        $this->_lastname = $lastname;
        return $this;
    }

    public function getLastname()
    {
        return $this->_lastname;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
        return $this;
    }

    public function getEmail()
    {
        return $this->_email;
    }
    
    public function setAddress($address)
    {
        $this->_address = $address;
        return $this;
    }
    
    public function getAddress()
    {
        return $this->_address;
    }

    public function setPhoto($photo)
    {
        $this->_photo = $photo;
        return $this;
    }
    
    public function getPhoto()
    {
        return $this->_photo;
    }

    public function setStatus($status)
    {
        $this->_status = $status;
        return $this;
    }
    
    public function getStatus()
    {
        return $this->_status;
    }
    
    public function setSystem_id($systemId)
    {
        $this->_systemId = $systemId;
        return $this;
    }
    
    public function getSystem_id()
    {
        return $this->_systemId;
    }

    public function loggedIn()
    {
       $action = Zend_Controller_Front::getInstance()->getRequest()->getActionName();
       if(!Zend_Auth::getInstance()->hasIdentity() && $action != self::LOGIN_ACTION && $action != self::REGISTER_ACTION)
           return false;
       else
           return true;
    }
    
    public function authenticateUser($email, $password)
    {
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();

        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);

        $authAdapter->setTableName('users')
        ->setIdentityColumn('email')
        ->setCredentialColumn('password')
        ->setCredentialTreatment('MD5(?)');

        $authAdapter->setIdentity($email)
        ->setCredential($password);
        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($authAdapter);
        
        if($result->isValid())
        {
            $userInfo = $authAdapter->getResultRowObject(null, 'password');
            $authStorage = $auth->getStorage();
            $authStorage->write($userInfo);
            return true;
        }
        else
           return false;
    }
}
?>
