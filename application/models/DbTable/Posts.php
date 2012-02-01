<?php
class Application_Model_DBTable_Posts extends Zend_Db_Table_Abstract
{
    protected $_name = 'posts';
    protected $_referenceMap = array(
    'System' => array(
        'columns'       => 'system_id', 
        'refTableClass' => 'Application_Model_DBTable_System', 
        'refColumns'    => 'id'
    ));
}
?>
