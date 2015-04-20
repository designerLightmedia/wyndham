<?php
class SimpleVocabTermTable extends Omeka_Db_Table
{
    public function findByElementId($elementId)
    {
        $select = $this->getSelect()->where('element_id = ?', $elementId);
        return $this->fetchObject($select);
    }
}