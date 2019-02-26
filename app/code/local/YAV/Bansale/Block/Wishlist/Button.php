<?php

class YAV_Bansale_Block_Wishlist_Button extends Mage_Wishlist_Block_Customer_Wishlist_Button
{
    /**
     * @return bool
     */
    public function checkItems()
    {
        /**
         * @var YAV_Bansale_Helper_Data $helper
         */
        $helper = Mage::helper('bansale');

        $items = $this->getWishlist()->getItemCollection();

        foreach ($items as $item) {
            $product = $item->getProduct();

            if ($helper->checkAvailabilityProduct($product)) {

                return false;
            }
        }

        return true;
    }
}
