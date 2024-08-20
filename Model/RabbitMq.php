<?php

declare(strict_types=1);

namespace RCFerreira\Queue\Model;

use Magento\Framework\Exception\CouldNotSaveException;
use RCFerreira\Queue\Api\RabbitMqInterface;
use Magento\Framework\MessageQueue\PublisherInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\MessageQueue\ConsumerFactory;
use RCFerreira\Queue\Logger\Logger;
use RCFerreira\Queue\Model\MessageQueue\SyncProduct;

class RabbitMq implements RabbitMqInterface
{

    /**
     * @param PublisherInterface $publisher
     * @param Json $json
     */
    public function __construct(
        private PublisherInterface $publisher,
        private Json $json,
        private ConsumerFactory $consumerFactory,
        private Logger $logger
    ) {}

    /**
     * @return void
     * @throws CouldNotSaveException
     */
    public function execute(): void
    {
        try {
            $details[] = [
                "any_informatic_index" => "value",
            ];
            $batchSize = 500;
            $noOfMessages = 1;

            $this->logger->info('Webapi executed successfully');

            $this->publisher->publish(
                SyncProduct::TOPIC_NAME,
                $this->json->serialize($details)
            );
            $consumer = $this->consumerFactory->get('syncRhProductConsumer', $batchSize);
            $consumer->process($noOfMessages);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Error save queue'));
        }
    }

}
