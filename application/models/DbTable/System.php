<?php
class Application_Model_DBTable_System extends Zend_Db_Table_Abstract
{
    protected $_name = 'system';
    protected $_dependentTables = array('Application_Model_DBTable_Pages', 'Application_Model_DBTable_Posts');
    protected $_rowClass = 'Application_Model_Row_System';
}
?>
