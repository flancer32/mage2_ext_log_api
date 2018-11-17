<?php
/**
 * Authors: Alex Gusev <alex@flancer64.com>
 * Since: 2018
 */

namespace Flancer32\LogApi\Controller\Js;

use Flancer32\LogApi\Config as Cfg;

/**
 * Compose landing HTML to extract JS error log from browser's local storage.
 */
class View
    extends \Magento\Framework\App\Action\Action
{
    /** @var \Magento\Framework\View\Layout */
    private $layout;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Layout $layout
    ) {
        parent::__construct($context);
        $this->layout = $layout;
    }

    public function execute()
    {
        /** @var \Flancer32\LogApi\Block\Js\Logger $block */
        $block = $this->layout->createBlock(\Flancer32\LogApi\Block\Js\Logger::class);
        $tmpl = Cfg::MODULE . '::js/viewer.phtml';
        $block->setTemplate($tmpl);
        $type = \Magento\Framework\Controller\ResultFactory::TYPE_RAW;
        /** @var \Magento\Framework\Controller\Result\Raw $result */
        $result = $this->resultFactory->create($type);
        $html = $block->toHtml();
        $result->setContents($html);
        return $result;
    }

}