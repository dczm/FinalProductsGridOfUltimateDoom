<?php
class Dczm_FinalProductsGridOfUltimateDoom_Tower_Prepare extends Mage_Eav_Model_Entity_Setup
{
	//create fpgoudutcoacm_cats attribute to catch product attribute update - dirty way, but I have no idea how do it by another way without override a controller class
	public function getDefaultEntities()
    {
        return array(
            'catalog_product' => array(
                'entity_model'      => 'catalog/product',
                'attribute_model'   => 'catalog/resource_eav_attribute',
                'table'             => 'catalog/product',
                'additional_attribute_table' => 'catalog/eav_attribute',
                'entity_attribute_collection' => 'catalog/product_attribute_collection',
                'attributes'        => array(
                    'finalproductsgrid_cats' => array(	
                        'label'             => 'Final Products Grid Of Ultimate Doom categories',
                        'type'              => 'varchar',
                        'input'             => 'text',
                        'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                        'required'          => false,
                        'user_defined'      => false,
                        'searchable'        => false,
                        'filterable'        => false,
                        'comparable'        => false,
                        'visible_on_front'  => false,
                        'visible_in_advanced_search' => false,
                        'unique'            => false
                    ),
               )
           ),
      );
      }
}