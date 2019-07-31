<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 25.07.19
 * Time: 0:03
 */

namespace Mymodule\Test\Api\Links;


interface LinkInterface
{

    const TABLE_NAME                = 'my_link_table';
    const ID_FIELD                  = 'link_id';
    const TEXT_FIELD                = 'link_text';
    const BODY_FIELD                = 'body';
    const STATUS_FIELD              = 'status';


    const CACHE_TAG                 = 'my_link_table';
    const REGISTRY_KEY              = 'my_link_table';

    public function getId();

    public function getText();
    public function setText($text);
    public function getBody();
    public function setBody($body);
    public function getStatus();
    public function setStatus($status);



}