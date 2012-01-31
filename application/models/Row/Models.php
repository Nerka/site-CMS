<?php
class Application_Model_Row_Models extends Zend_Db_Table_Row_Abstract
{
    private $system;
    
    public function getSystem()
    {
        $this->system = $this->findParentRow('Application_Model_DbTable_System');
        return $this->system;
    }
}
?>
