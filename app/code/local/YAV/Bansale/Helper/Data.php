<?php

class YAV_Bansale_Helper_Data extends Mage_Core_Helper_Abstract
{
    private function checkAvailability()
    {
        return false;


        if (!Mage::getStoreConfig('bansale/settings/enabled')) {
            return true;
        }

        $curTime = Mage::getModel('core/date')->timestamp(time());
        $startTime = strtotime(Mage::getStoreConfig('bansale/settings/starttime'));
        $endTime = strtotime(Mage::getStoreConfig('bansale/settings/endtime'));

        if (($curTime < $startTime) && ($curTime > $endTime)) {
            return true;
        }

        $categoryIds = explode(',', Mage::getStoreConfig('bansale/settings/category'));

//        $product = $observer->getProduct();
//        $productCategoryIds = $product->getCategoryIds();
//
//        if (empty(array_intersect($categoryIds, $productCategoryIds))) {
//            return true;
//        }
    }
}