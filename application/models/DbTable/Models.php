<?php
class Application_Model_DBTable_Models extends Zend_Db_Table_Abstract
{
    protected $_name = 'models';
    protected $_rowClass = 'Application_Model_Row_Models';
    protected $_referenceMap = array(
    'System' => array(
        'columns'       => 'system_id', 
        'refTableClass' => 'Application_Model_DBTable_System', 
        'refColumns'    => 'id'
    ));
}
?>
