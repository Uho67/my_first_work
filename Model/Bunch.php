<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 25.07.19
 * Time: 14:09
 */

namespace Mymodule\Test\Model;


class Bunch extends \Magento\Framework\Model\AbstractModel implements \Mymodule\Test\Api\Bunch\BunchInterface, \Magento\Framework\DataObject\IdentityInterface
{
    /** {@inheritdoc} */
    public function _construct()
    {
        $this->_init(\Mymodule\Test\Model\ResourceModel\Bunch::class);
    }

    /** {@inheritdoc} */
    public function getIdentities()
    {
        return [sprintf("%s_%s", \Mymodule\Test\Api\Bunch\BunchInterface::CACHE_TAG, $this->getId())];
    }

    public function getLinkId(){
        return $this->getData(\Mymodule\Test\Api\Bunch\BunchInterface::LINK_ID_FILD);
    }
    public function setLinkId($id){
        $this->setData(\Mymodule\Test\Api\Bunch\BunchInterface::LINK_ID_FILD, $id);
        return $this;
    }

    public function getPageId(){
        return $this->getData(\Mymodule\Test\Api\Bunch\BunchInterface::PAGE_ID_FILD);
    }

    public function setPageId($id){
        $this->setData(\Mymodule\Test\Api\Bunch\BunchInterface::PAGE_ID_FILD, $id);
        return $this;
    }

}