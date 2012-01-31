<?php
class Application_Model_Row_System extends Zend_Db_Table_Row_Abstract
{
    private $model;
    
    public function getPages()
    {
        $this->model = $this->findDependentRowset('Application_Model_DbTable_Pages');
        return $this->model;
    }
}
?>
