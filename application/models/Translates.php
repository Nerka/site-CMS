<?php

class Application_Model_Translates
{
    protected $_id;
    protected $_title;
    protected $_content;
    protected $_language;
    protected $_pages_id;
    protected $_posts_id;
    
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
    
    public function setTitle($title)
    {
        $this->_title = $title;
        return $this;
    }
    
    public function getTitle()
    {
        return $this->_title;
    }
    
    public function setContent($content)
    {
        $this->_content = $content;
        return $this;
    }
    
    public function getContent()
    {
        return $this->_content;
    }
    
    public function setLanguage($language)
    {
        $this->_language = $language;
        return $this;
    }
    
    public function getLanguage()
    {
        return $this->_language;
    }
    
    public function setPages_id($pageId)
    {
        $this->_pages_id = $pageId;
        return $this;
    }
    
    public function getPages_id()
    {
        return $this->_pages_id;
    }
    
    public function setPosts_id($postId)
    {
        $this->_posts_id = $postId;
        return $this;
    }
    
    public function getPosts_id()
    {
        return $this->_posts_id;
    }
}

?>
