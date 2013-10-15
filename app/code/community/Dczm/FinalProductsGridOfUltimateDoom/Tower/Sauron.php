<?php
class Dczm_FinalProductsGridOfUltimateDoom_Tower_Sauron
{
	
	public function look(Varien_Event_Observer $observer)
	{	
		$block = $observer->getEvent()->getBlock();
		if(($block instanceof Mage_Adminhtml_Block_Catalog_Product_Grid)) {
			$block->addColumnAfter('finalproductsgridofultimatedoom_categories', array(
					'header'	=> Mage::helper('finalproductsgridofultimatedoom')->__('Category'),
					'index'		=> 'finalproductsgridofultimatedoom_category',
					'sortable'	=> false,
					'type'  => 'options',
					'width' => 200,
					'options'	=> Mage::getSingleton('finalproductsgridofultimatedoom/shrub')->toOptionArray(),
					'renderer'	=> 'finalproductsgridofultimatedoom/siphon',
					'filter_condition_callback' => array($this, 'finalFilter'),
			),'name');
		}
	}
	public function lookCats(Varien_Event_Observer $observer)
	{	
		$data = $observer->getEvent()->getData();
		if(isset($data['attributes_data']['finalproductsgrid_cats'])){
			$cats = $data['attributes_data']['finalproductsgrid_cats']['cats'];
			$remove = $data['attributes_data']['finalproductsgrid_cats']['remove'];
			$product_ids = $data['product_ids'];
			$adapter = Mage::getSingleton('core/resource')->getConnection('core_write');
			$table_cp = Mage::getSingleton('core/resource')->getTableName('catalog/category_product');
			if($remove == 1){
				$query = $adapter->quoteInto("DELETE FROM $table_cp WHERE product_id IN( ? )", $product_ids);
				$adapter->query($query);
			}
			if(!empty($cats)){
				$cats_array = explode(', ', $cats);
				foreach($cats_array as $cat) {
					$counter = 0;
					$query = "INSERT INTO " . $table_cp . " (category_id, product_id, position) VALUES ";
					$values = array();
					foreach($product_ids as $product_id) {
						$values[] = '(' . implode(', ', array($cat, $product_id, 0)) . ')';
						$counter++;
						if($counter > 500){
							$adapter->query($query. implode(", ", $values) ." ON DUPLICATE KEY UPDATE category_id=category_id");
							$values = array();
						}
						if(!empty($values)){
							$adapter->query($query. implode(", ", $values) ." ON DUPLICATE KEY UPDATE category_id=category_id");
						}
						
					}
					
				}
			}
			unset($data['attributes_data']['finalproductsgrid_cats']);
		}
	}
	
	public function finalFilter($collection, $column)
	{
		$category_id = $column->getFilter()->getValue();
		$cp_table = Mage::getSingleton('core/resource')->getTableName('catalog/category_product');
		if($category_id == -1){
			$collection->getSelect()->joinLeft( array('cp'=>$cp_table), 'e.entity_id = cp.product_id', array())->where('cp.category_id IS NULL')->distinct();
			return $collection;
		}
		$_category = Mage::getModel('catalog/category')->load($category_id);
		if( Mage::getStoreConfig('catalog/finalproductsgridofultimatedoom/show_by') == Dczm_FinalProductsGridOfUltimateDoom_Tower_Showby::SHOW_BY_PATH ) {
			$path = $_category->getPath();
			$category_collection =  Mage::getModel('catalog/category')->getCollection()
			->addAttributeToFilter(array(
							    array(
							        'attribute' => 'path',
							        'eq'        => $path,
							        ),
							    array(
							        'attribute' => 'path',
							        'like'      => $path.'/%',
							        ),
							    ));
			$category_ids = $category_collection->getAllIds();
			
			$collection->getSelect()->joinLeft( array('cp'=>$cp_table), 'e.entity_id = cp.product_id', array())->where('cp.category_id in(?)',$category_ids)->distinct();
		}
		else{
			
			$collection->addCategoryFilter($_category);
		}
		return $collection;
	}
	
}
