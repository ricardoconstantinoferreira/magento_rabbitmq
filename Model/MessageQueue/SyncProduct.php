<?php

declare(strict_types=1);

namespace RCFerreira\Queue\Model\MessageQueue;

use Magento\Framework\MessageQueue\ConsumerConfiguration;

class SyncProduct extends ConsumerConfiguration
{

    public const TOPIC_NAME = "syncRhProductTopic";

    /**
     * @param $request
     * @return void
     * @throws \Zend_Log_Exception
     */
    public function process($request): void
    {
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/rohan.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->infor(print_r($request,true));
    }
}
