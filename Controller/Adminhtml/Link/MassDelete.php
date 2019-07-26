<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Mymodule\Test\Controller\Adminhtml\Link;


use Mymodule\Test\Controller\Adminhtml\Link as BaseLink;

/**
 * Class MassDelete
 */
class MassDelete extends BaseLink
{

    public function execute()
    {
        $ids = $this->getRequest()->getParam('selected');
        if (count($ids)) {
            foreach ($ids as $id) {
                try {
                    $this->repository->deleteById($id);
                } catch (\Exception $e) {
                    $this->logger->error($e->getMessage());
                    $this->logger->critical(
                        sprintf("Can\'t delete Link: %d", $id)
                    );
                    $this->messageManager->addErrorMessage(__('Link with id %1 not deleted', $id));
                }
            }
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) has been deleted.', count($ids))
            );
        } else {
            $this->logger->error("Parameter ids must be array and not empty");
            $this->messageManager->addWarningMessage("Please select items to delete");
        }
        return $this->redirectToGrid();
    }
}
