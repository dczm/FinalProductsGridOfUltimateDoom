<?php
class Dczm_FinalProductsGridOfUltimateDoom_Tower_Shrub	
{
    public function toOptionArray()
    {
        $options = array(-1 => Mage::helper('finalproductsgridofultimatedoom')->__('Without category'));
        foreach ($this->_getCategories() as $category) {
            $options[$category['value']] = $category['label'];
        }

        return $options;
    }
    
    
    
    private function _getChildren(Varien_Data_Tree_Node $node, $values, $level = 0)
    {
    	$level++;
    
    	$values[$node->getId()]['value'] =  $node->getId();
    	$values[$node->getId()]['label'] = str_repeat("--", $level)." ".$node->getName();
    
    	foreach ($node->getChildren() as $child)
    	{
    		$values = $this->_getChildren($child, $values, $level);
    	}
    
    	return $values;
    }
    
    private function _getCategories()
    {
    	$store = Mage::app()->getFrontController()->getRequest()->getParam('store', 0);
    	$parentId = $store ? Mage::app()->getStore($store)->getRootCategoryId() : 1; 
    	
    	$tree = Mage::getResourceSingleton('catalog/category_tree')->load();
    
    	$root = $tree->getNodeById($parentId);
    
    	if($root && $root->getId() == 1)
    	{
    		$root->setName(Mage::helper('catalog')->__('Root'));
    	}
    
    	$collection = Mage::getModel('catalog/category')->getCollection()
    	->setStoreId($store)->addAttributeToSelect('name');    	
    
    	$tree->addCollectionData($collection, true);
    
    	return $this->_getChildren($root, array());
    }
}
