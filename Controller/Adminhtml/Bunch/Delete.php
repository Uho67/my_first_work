<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 25.07.19
 * Time: 10:34
 */

namespace Mymodule\Test\Controller\Adminhtml\Bunch;

use Mymodule\Test\Controller\Adminhtml\Bunch as Base;

class Delete extends Base
{

    /** {@inheritdoc} */
    public function execute()
    {
        $id = $this->getRequest()->getParam(static::QUERY_PARAM_ID);
        if (!empty($id)) {
            try {
                $this->repository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('Bunch has been deleted.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(_('Bunch can\'t delete'));
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