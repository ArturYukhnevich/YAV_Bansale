<?php

class YAV_Bansale_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function checkAvailabilityProduct($product)
    {
        if (!Mage::getStoreConfig('bansale/settings/enabled')) {
            return false;
        }

        $curTime = Mage::getModel('core/date')->timestamp(time());
        $startTime = strtotime(Mage::getStoreConfig('bansale/settings/starttime'));
        $endTime = strtotime(Mage::getStoreConfig('bansale/settings/endtime'));

        if (($curTime < $startTime) && ($curTime > $endTime)) {
            return false;
        }

        $categoryIds = explode(',', Mage::getStoreConfig('bansale/settings/category'));
        $productCategoryIds = $product->getCategoryIds();

        if (!empty(array_intersect($categoryIds, $productCategoryIds))) {
            return true;
        }

        return false;
    }
}