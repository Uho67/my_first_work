<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 25.07.19
 * Time: 10:34
 */

namespace Mymodule\Test\Controller\Adminhtml\Link;

use Mymodule\Test\Controller\Adminhtml\Link as BaseLink;

class Delete extends Baselink
{
    const ACL_RESOURCE          = 'Mymodule_Test::delete';
    const MENU_ITEM             = 'Mymodule_Test::delete';
    /** {@inheritdoc} */
    public function execute()
    {
        $id = $this->getRequest()->getParam(static::QUERY_PARAM_ID);
        if (!empty($id)) {
            try {
                $this->repository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('Link has been deleted.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(_('Link can\'t delete'));
                return $this->doRefererRedirect();
            }
        } else {
            $this->logger->error(
                sprintf("Require parameter `%s` is missing", static::QUERY_PARAM_ID)
            );
            $this->messageManager->addMessage(__('No item to delete'));
        }
        return $this->redirectToGrid();
    }

}