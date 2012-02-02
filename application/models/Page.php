<?php
class Application_Model_Page
{
    protected $_id;
    protected $_type;
    protected $_url;
    protected $_publishtype;
    protected $_createdat;
    protected $_name;
    protected $_system_id;
    protected $_users_id;
    
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
            if(in_array($method, $methods)) 
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
    
    public function setName($name)
    {
        $this->_name = $name;
        return $this;
    }
    
    public function getName()
    {
        return $this->_name;
    }
    
    public function setType($type)
    {
        $this->_type = $type;
        return $this;
    }
    
    public function getType()
    {
        return $this->_type;
    }
    
    public function setUrl($url)
    {
        $this->_url = $url;
        return $this;
    }
    
    public function getUrl()
    {
        return $this->_url;
    }
    
    public function setPublishtype($publish)
    {
        $this->_publishtype = $publish;
        return $this;
    }
    
    public function getPublishtype()
    {
        return $this->_publishtype;
    }
    
    public function setCreatedat($createdat) 
    {
        $this->_createdat = $createdat;
        return $this;
    }
    
    public function getCreatedat()
    {
        return $this->_createdat;
    }
    
    public function setSystem_id($systemId)
    {
        $this->_system_id = (int) $systemId;
        return $this;
    }
    
    public function getSystem_id()
    {
        return $this->_system_id;
    }
    
    public function setUsers_id($userId)
    {
        $this->_users_id = (int) $userId;
        return $this;
    }
    
    public function getUsers_id()
    {
        return $this->_users_id;
    }
}
?>
