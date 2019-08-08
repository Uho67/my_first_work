<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 25.07.19
 * Time: 0:11
 */

namespace Mymodule\Test\Model;


class Link extends \Magento\Framework\Model\AbstractModel implements \Mymodule\Test\Api\Links\LinkInterface
{
    /** {@inheritdoc} */
    public function _construct()
    {
        $this->_init(\Mymodule\Test\Model\ResourceModel\Link::class);
    }

    public function getText(){
        return $this->getData(\Mymodule\Test\Api\Links\LinkInterface::TEXT_FIELD);
    }
    public function setText($text){
        $this->setData(\Mymodule\Test\Api\Links\LinkInterface::TEXT_FIELD, $text);
        return $this;
    }

    public function getBody(){
        return $this->getData(\Mymodule\Test\Api\Links\LinkInterface::BODY_FIELD);
    }

    public function setBody($body){
        $this->setData(\Mymodule\Test\Api\Links\LinkInterface::BODY_FIELD, $body);
        return $this;
    }

    public function getStatus(){
        return $this->getData(\Mymodule\Test\Api\Links\LinkInterface::STATUS_FIELD);
    }

    public function setStatus($status){
        $this->setData(\Mymodule\Test\Api\Links\LinkInterface::STATUS_FIELD, $status);
        return $this;
    }
}