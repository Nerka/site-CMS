<?php
class Application_Model_System
{
    protected $_id;
    protected $_generatedId;
    protected $_name;
    
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
    
    public function setGeneratedid($generatedId)
    {
        $this->_generatedId = $generatedId;
        return $this;
    }
    
    public function getGeneratedid()
    {
        return $this->_generatedId;
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
}
?>
