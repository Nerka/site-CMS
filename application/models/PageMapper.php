<?php
class Application_Model_PageMapper
{
    protected $_dbTable;
    
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
                $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
                throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
                $this->setDbTable('Application_Model_DbTable_Pages');
        }
        return $this->_dbTable;
    }
    
    public function createPage(Application_Model_Page $page)
    {
        $pageData = array(
            'type'          =>  $page->getType(),
            'url'           =>  $page->getUrl(),
            'publishtype'   =>  $page->getPublishtype(),
            'createdat'     =>  $page->getCreatedat(),
            'name'          =>  $page->getName(),
            'system_id'     =>  $page->getSystem_id(),
            'users_id'      =>  $page->getUsers_id()
        );
        
        if(!$page->getId())
        {
            $this->getDbTable()->insert($pageData);
            return $this->getDbTable()->getAdapter()->lastInsertId();
        }
        else
        {
            $pageRow = $this->getDbTable()->fetchRow($this->getDbTable()->select()->where('id = ?', $page->getId()));
            $pageRow->name = $page->getName();
            $pageRow->save();
        }
    }
    
    public function removePage($pageId /* Page ID */)
    {
        $where = $this->getDbTable()->getAdapter()->quoteInto('id = ?', $pageId);
        $this->getDbTable()->delete($where);
    }
}
?>
