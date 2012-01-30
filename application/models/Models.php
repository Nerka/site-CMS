<?php
class Application_Model_Models
{
    protected $_id;
    protected $_name;
    protected $_url;
    protected $_table;
    protected $_status;
    protected $_systemId;
    
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
    
    public function setUrl($url)
    {
        $this->_url = $url;
        return $this;
    }
    
    public function getUrl()
    {
        return $this->_url;
    }
    
    public function setTable($table)
    {
        $this->_table = $table;
        return $this;
    }
    
    public function getTable()
    {
        return $this->_table;
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
}
?>
