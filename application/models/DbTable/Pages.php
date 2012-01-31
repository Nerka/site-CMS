<?php
class Application_Model_DBTable_Pages extends Zend_Db_Table_Abstract
{
    protected $_name = 'pages';
    protected $_referenceMap = array(
    'System' => array(
        'columns'       => 'system_id', 
        'refTableClass' => 'Application_Model_DBTable_System', 
        'refColumns'    => 'id'
    ));
}
?>
