<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 25.07.19
 * Time: 10:09
 */

namespace Mymodule\Test\Ui\Listing\Link;

use Mymodule\Test\Ui\Listing\ActionsAbstract;

class Actions extends ActionsAbstract
{
    protected $edit = 'mymodule_test/link/edit';
    protected $delete = 'mymodule_test/link/delete';
    protected $id = 'link_id';
}