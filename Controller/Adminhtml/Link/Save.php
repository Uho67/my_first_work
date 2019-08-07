<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 25.07.19
 * Time: 11:42
 */

namespace Mymodule\Test\Controller\Adminhtml\Link;

use Mymodule\Test\Api\Links\LinkInterface;
use Mymodule\Test\Controller\Adminhtml\Link as BaseLink;

class Save extends BaseLink
{
    const PAGE_TITLE        = 'Save link';
    const BREADCRUMB_TITLE  = 'Save link';

    /** {@inheritdoc} */
    public function execute()
    {

        $isPost = $this->getRequest()->isPost();
        if ($isPost) {

            $model = $this->getModel();
            $formData = $this->getRequest()->getParam('link');
            if (empty($formData)) {
                $formData = $this->getRequest()->getParams();
            }
            if(!empty($formData[LinkInterface::ID_FIELD])) {
                $id = $formData[LinkInterface::ID_FIELD];
                $model = $this->repository->getById($id);
            } else {
                unset($formData[LinkInterface::ID_FIELD]);
            }


            $model->setData($formData);



            try {
                $model = $this->repository->save($model);

                $this->messageManager->addSuccessMessage(__('Link has been saved.'));
                if ($this->getRequest()->getParam('back')) {
                    return $this->_redirect('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $this->redirectToGrid();
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                $this->messageManager->addErrorMessage(__('Link doesn\'t save' ));
            }
            $this->_getSession()->setFormData($formData);
            return (!empty($model->getId())) ?
                $this->_redirect('*/*/edit', ['id' => $model->getId()])
                : $this->_redirect('*/*/create');
        }
        return $this->doRefererRedirect();
    }


}