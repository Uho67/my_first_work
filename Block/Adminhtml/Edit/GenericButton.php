<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 25.07.19
 * Time: 11:56
 */

namespace Mymodule\Test\Block\Adminhtml\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;

use Mymodule\Test\Api\LinkRepositoryInterface;

class GenericButton
{
    protected $_registry ;
    /** @var Context */
    protected $context;
    /** @var LinkRepositoryInterface*/
    protected $repository;
    public function __construct(
        \Magento\Framework\Registry $registry,
        Context $context,
        LinkRepositoryInterface $repository
    ) {
        $this->_registry    = $registry;
        $this->context      = $context;
        $this->repository   = $repository;
    }
    /**
     * Return Order ID
     *
     * @return int|null
     */
    public function getLinkId()
    {
        try {
           return $this->_registry->registry('mymodule_test_current_link')->getId();
        }catch (NoSuchEntityException $e){}
        return null;
    }
    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
