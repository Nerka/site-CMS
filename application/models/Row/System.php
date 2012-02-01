<?php
class Application_Model_Row_System extends Zend_Db_Table_Row_Abstract
{
    private $pages;
    private $posts;
    
    public function getPages()
    {
        $this->pages = $this->findDependentRowset('Application_Model_DbTable_Pages');
        return $this->pages;
    }
    
    public function getPosts()
    {
        $this->posts = $this->findDependentRowset('Application_Model_DbTable_Posts');
        return $this->posts;
    }
}
?>
