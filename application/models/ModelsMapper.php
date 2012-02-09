<?php
class Application_Model_ModelsMapper
{
    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable))
            $dbTable = new $dbTable();
        
        if (!$dbTable instanceof Zend_Db_Table_Abstract) 
            throw new Exception('Invalid table data gateway provided');
        
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
    
    public function getModels()
    {
        $models = $this->getDbTable()->fetchAll($this->getDbTable()->select());
        return $models;   
    }
    
    public function getModelsObjects()
    {
        $models = $this->getModels();
        $arrayOfObjects = array();
        
        foreach ($models as $model):
            $modelObject = new Application_Model_Models($model->toArray());
            $arrayOfObjects[] = $modelObject;
        endforeach;
        
        return $arrayOfObjects;
    }
    
    public function getModelsArrays()
    {
        $models = $this->getModels();
        $arrayOfArrays = array();

        foreach($models as $model):
            $methods = get_class_methods($model->getSystem());
            $modelAsArray = $model->toArray();
            $method = 'get' . ucfirst($model->name);
            $childrenArray = array();
            if(in_array($method, $methods))
            {
                foreach ($model->getSystem()->$method() as $page):
                    $childrenArray[] = array('_reference' => $page->id);
                    $arrayOfArrays[] = $page->toArray();
                endforeach;
                $modelAsArray['children'] =  $childrenArray;
            }
                
            $modelAsArray['type'] =  'module';
            $arrayOfArrays[] = $modelAsArray; 
            
        endforeach;
        
        return $arrayOfArrays;
    }
    
    public function getModelsDojoData()
    {
        $models = $this->getModelsArrays();
        $data = new Zend_Dojo_Data();
        $data->setIdentifier('id')
        ->setLabel('name')
        ->addItems($models);
        
        return $data;
    }
    
    public function getModelsSystem()
    {
        $models = $this->getModels();
        return $models->current()->getSystem();
    }
    
    public function getModelsChildrens()
    {
        $system = $this->getModelsSystem();
        $children = $system->getPages()->toArray();
        return $children;
    }
}
?>
