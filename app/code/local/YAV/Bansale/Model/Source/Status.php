<?php

class YAV_Bansale_Model_Source_Status
{
    const ENABLED = '1';
    const DISABLED = '0';

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::ENABLED, 'label' => Mage::helper('bansale')->__('Enabled')],
            ['value' => self::DISABLED, 'label' => Mage::helper('bansale')->__('Disabled')],
        ];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [
            self::DISABLED => Mage::helper('bansale')->__('Disabled'),
            self::ENABLED  => Mage::helper('bansale')->__('Enabled'),
        ];
    }
}