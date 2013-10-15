<?php
class Dczm_FinalProductsGridOfUltimateDoom_Tower_Showby	
{
	const SHOW_BY_DISPLAY_SETTINGS = 1;
	const SHOW_BY_PATH = 2;
    public function toOptionArray()
    {
        return array(
            array('value'=>self::SHOW_BY_DISPLAY_SETTINGS, 'label'=>Mage::helper('catalog')->__('Display Settings')),
            array('value'=>self::SHOW_BY_PATH, 'label'=>Mage::helper('catalog')->__('Path')),                    
        );
    }

}
