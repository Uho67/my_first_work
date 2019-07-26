<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Mymodule\Test\Controller\Adminhtml\Link;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Cms\Controller\Adminhtml\Page\PostDataProcessor;


use Mymodule\Test\Api\BunchRepositoryInterface as LinkRepository;
use Mymodule\Test\Api\Links\LinkInterface;


/**
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class InlineEdit extends \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Cms\Controller\Adminhtml\Page\PostDataProcessor
     */
    protected $dataProcessor;

    /**
     * @var \Mymodule\Test\Api\BunchRepositoryInterface
     */
    protected $linkRepository;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    /**
     * @param Context $context
     * @param PostDataProcessor $dataProcessor
     * @param LinkRepository $linkRepository
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        PostDataProcessor $dataProcessor,
        linkRepository $linkRepository,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->dataProcessor = $dataProcessor;
        $this->linkRepository = $linkRepository;
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        $postItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($postItems))) {
            return $resultJson->setData([
                'messages' => [__('Please correct the data sent.')],
                'error' => true,
            ]);
        }

        foreach (array_keys($postItems) as $linkId) {
            /** @var \Mymodule\Test\Model\Link $link */
            $link = $this->linkRepository->getById($linkId);
            try {
                $linkData = $this->filterPost($postItems[$linkId]);
                $this->validatePost($linkData, $link, $error, $messages);
                $extendedPageData = $link->getData();
                $this->setLinkData($link, $extendedPageData, $linkData);
                $this->linkRepository->save($link);
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $messages[] = $this->getErrorWithPageId($link, $e->getMessage());
                $error = true;
            } catch (\RuntimeException $e) {
                $messages[] = $this->getErrorWithPageId($link, $e->getMessage());
                $error = true;
            } catch (\Exception $e) {
                $messages[] = $this->getErrorWithPageId(
                    $link,
                    __('Something went wrong while saving the link.')
                );
                $error = true;
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Filtering posted data.
     *
     * @param array $postData
     * @return array
     */
    protected function filterPost($postData = [])
    {
        $pageData = $this->dataProcessor->filter($postData);
        $pageData['custom_theme'] = isset($pageData['custom_theme']) ? $pageData['custom_theme'] : null;
        $pageData['custom_root_template'] = isset($pageData['custom_root_template'])
            ? $pageData['custom_root_template']
            : null;
        return $pageData;
    }

    /**
     * Validate post data
     *
     * @param array $linkData
     * @param \Mymodule\Test\Model\Link $link
     * @param bool $error
     * @param array $messages
     * @return void
     */
    protected function validatePost(array $linkData, \Mymodule\Test\Model\Link $link, &$error, array &$messages)
    {
        if (!($this->dataProcessor->validate($linkData) && $this->dataProcessor->validateRequireEntry($linkData))) {
            $error = true;
            foreach ($this->messageManager->getMessages(true)->getItems() as $error) {
                $messages[] = $this->getErrorWithPageId($link, $error->getText());
            }
        }
    }

    /**
     * Add page title to error message
     *
     * @param LinkInterface $link
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithPageId(LinkInterface $link, $errorText)
    {
        return '[Page ID: ' . $link->getId() . '] ' . $errorText;
    }

    /**
     * Set link data
     *
     * @param \Mymodule\Test\Model\Link $link
     * @param array $extendedLinkData
     * @param array $linkData
     * @return $this
     */
    public function setLinkData(\Mymodule\Test\Model\Link $link, array $extendedLinkData, array $linkData)
    {
        $link->setData(array_merge($link->getData(), $extendedLinkData, $linkData));
        return $this;
    }
}
