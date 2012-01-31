<?php
class Application_Model_Rowset_Pages extends Zend_Db_Table_Rowset_Abstract
{
    public function getAsArrayOfTradesObjects()
    {
        $pagesArray = array();

        while ($this->valid())
        {
            var_dump($this->current());
           
            $this->next();
        }
        $this->rewind();

        return $pagesArray;
    }
}
?>
