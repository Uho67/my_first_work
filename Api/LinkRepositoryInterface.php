<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 25.07.19
 * Time: 0:02
 */

namespace Mymodule\Test\Api;


interface LinkRepositoryInterface
{
    public function getById($id);
    public function deleteById($id);
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
    public function save(\Mymodule\Test\Api\Links\LinkInterface $link);
    public function delete(\Mymodule\Test\Api\Links\LinkInterface $link);
}