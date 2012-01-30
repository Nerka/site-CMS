<?php
class Application_Model_ModelsMapper
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
                $this->setDbTable('Application_Model_DbTable_Models');
        }
        return $this->_dbTable;
    }   
    
    public function getModelsObjects()
    {
        $models = $this->getDbTable()->fetchAll($this->getDbTable()->select());
        $arrayOfObjects = array();
        
        foreach ($models as $model):
            $modelObject = new Application_Model_Models($model->toArray());
            $arrayOfObjects[] = $modelObject;
        endforeach;
        
        return $modelObject;
    }
}
?>
