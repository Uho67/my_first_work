<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 25.07.19
 * Time: 12:12
 */

namespace Mymodule\Test\Controller\Adminhtml\Link;

use Mymodule\Test\Controller\Adminhtml\Link as BaseLink;
use Mymodule\Test\Api\Links\LinkInterface;

use Magento\Framework\Exception\NoSuchEntityException ;

class Edit extends BaseLink
{
    const ACL_RESOURCE          = 'Mymodule_Test::edit';
    const MENU_ITEM             = 'Mymodule_Test::edit';
    const PAGE_TITLE            = 'Form Link';
    const BREADCRUMB_TITLE      = 'Form Link';
    /** {@inheritdoc} */

    public function execute()
    {
        $id = $this->getRequest()->getParam(static::QUERY_PARAM_ID);
        if($id == null){
           return parent::execute();
        }
        if (!empty($id)) {
            try {
                $model = $this->repository->getById($id);
                $this->registry->register('mymodule_test_current_link', $model);
            } catch (NoSuchEntityException $exception) {
                $this->logger->error($exception->getMessage());
                $this->messageManager->addErrorMessage(__('Entity with id %1 not found', $id));
                return $this->redirectToGrid();
            }
        } else {
            $this->logger->error(
                sprintf("Require parameter `%s` is missing", static::QUERY_PARAM_ID)
            );
            $this->messageManager->addErrorMessage("Link not found");
            return $this->redirectToGrid();
        }
        $data = $this->_session->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->registry->register(LinkInterface::REGISTRY_KEY, $model);
        return parent::execute();
    }
}