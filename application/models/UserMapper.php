<?php
class Application_Model_UserMapper
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
                $this->setDbTable('Application_Model_DbTable_Users');
        }
        return $this->_dbTable;
    }
    
    public function saveUser(Application_Model_User $user)
    {
        $systemMapper = new Application_Model_SystemMapper();
        
        if($systemMapper->getSystem())
            $system = $systemMapper->getSystem();
        else
        {
            $systemName = 'siteCMS';
            $systemData = array(
                'generatedid'   =>  uniqid($systemName . '_'),
                'name'          =>  $systemName
            );
            
            $system = new Application_Model_System($systemData);
            $lastInsertedId = $systemMapper->createSystem($system);  
            $system->setId($lastInsertedId);
        }

        $data = array(
            'email'     =>  $user->getEmail(),
            'password'  =>  md5($user->getPassword()),
            'username'  =>  $user->getEmail(),
            'system_id' =>  $system->getId()
        );
        
        if (null === ($id = $user->getId()))
        {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        }
    }
}
?>
