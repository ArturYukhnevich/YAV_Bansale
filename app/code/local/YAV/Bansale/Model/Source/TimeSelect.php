<?php

class YAV_Bansale_Model_Source_TimeSelect
{
    private $times = [];

    public function __construct()
    {
        $this->generateTime();
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $times = [];
        foreach ($this->times as $time) {
            $times[] = ['value' => $time, 'label' => Mage::helper('bansale')->__($time)];
        }

        return $times;
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        $times = [];
        foreach ($this->times as $time) {
            $times[$time] = [$time => Mage::helper('bansale')->__($time)];
        }

        return $times;
    }

    private function generateTime()
    {
        $start = "00:00";
        $end = "23:59";

        $tStart = strtotime($start);
        $tEnd = strtotime($end);

        $tNow = $tStart;


        $format = 'h:i A';
        if (Mage::getStoreConfig('catalog/custom_options/time_format') === '24h') {
            $format = 'H:i';
        }

        while ($tNow <= $tEnd) {
            $this->times[] = date($format, $tNow);
            $tNow = strtotime('+1 hours', $tNow);
        }
    }
}