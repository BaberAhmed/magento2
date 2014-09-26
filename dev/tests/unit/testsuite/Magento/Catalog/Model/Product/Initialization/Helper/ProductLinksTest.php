<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Magento\Catalog\Model\Product\Initialization\Helper;

use Magento\Catalog\Model\Product;
use Magento\TestFramework\Helper\ObjectManager;

class ProductLinksTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\Catalog\Model\Product\Initialization\Helper\ProductLinks
     */
    private $model;

    public function testInitializeLinks()
    {
        $links = ['related' => ['data'], 'upsell' => ['data'], 'crosssell' => ['data']];
        $this->assertInstanceOf(
            '\Magento\Catalog\Model\Product',
            $this->model->initializeLinks($this->getMockedProduct(), $links)
        );

    }

    protected function setUp()
    {
        $helper = new ObjectManager($this);
        $this->model = $helper->getObject('\Magento\Catalog\Model\Product\Initialization\Helper\ProductLinks');
    }

    /**
     * @return Product
     */
    private function getMockedProduct()
    {
        $mockBuilder = $this->getMockBuilder('\Magento\Catalog\Model\Product')
            ->setMethods(
                [
                    'getRelatedReadonly',
                    'getUpsellReadonly',
                    'getCrosssellReadonly',
                    'setCrossSellLinkData',
                    'setUpSellLinkData',
                    'setRelatedLinkData',
                    '__wakeup'
                ]
            )
            ->disableOriginalConstructor();
        $mock = $mockBuilder->getMock();

        $mock->expects($this->any())
            ->method('getRelatedReadonly')
            ->will($this->returnValue(false));

        $mock->expects($this->any())
            ->method('getUpsellReadonly')
            ->will($this->returnValue(false));

        $mock->expects($this->any())
            ->method('getCrosssellReadonly')
            ->will($this->returnValue(false));

        $mock->expects($this->any())
            ->method('setCrossSellLinkData');

        $mock->expects($this->any())
            ->method('setUpSellLinkData');

        $mock->expects($this->any())
            ->method('setRelatedLinkData');

        return $mock;
    }
} 