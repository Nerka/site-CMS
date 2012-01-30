<?php
class Application_Model_SystemMapper
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
                $this->setDbTable('Application_Model_DbTable_System');
        }
        return $this->_dbTable;
    }
    
    public function createSystem(Application_Model_System $system)
    {
        $data = array(
            'generatedid'   =>  $system->getGeneratedid(),
            'name'          =>  $system->getName()
        );
        $this->getDbTable()->insert($data);
        
        return $this->getDbTable()->getAdapter()->lastInsertId();
    }
    
    public function getSystem()
    {
        $systems = $this->getDbTable()->fetchAll($this->getDbTable()->select());
       
        if(!$systems->current())
            return false;
        
        $system = $systems->current()->toArray();
        $systemObject = new Application_Model_System($system);
        
        return $systemObject;
    }
}
?>
