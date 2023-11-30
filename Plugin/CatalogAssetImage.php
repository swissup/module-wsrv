<?php

namespace Swissup\Wsrv\Plugin;

class CatalogAssetImage
{
    private \Swissup\Wsrv\Helper\Data $helper;

    public function __construct(\Swissup\Wsrv\Helper\Data $helper)
    {
        $this->helper = $helper;
    }

    public function afterGetUrl(\Magento\Catalog\Model\View\Asset\Image $subject, $result)
    {
        return $this->helper->convertUrl($result);
    }
}
