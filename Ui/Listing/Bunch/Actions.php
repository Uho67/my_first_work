<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 26.07.19
 * Time: 8:51
 */

namespace Mymodule\Test\Ui\Listing\Bunch;

use Mymodule\Test\Ui\Listing\ActionsAbstract;

class Actions extends ActionsAbstract
{
    protected $edit = 'mymodule_test/bunch/edit';
    protected $delete = 'mymodule_test/bunch/delete';
    protected $id = 'bunch_id';

}