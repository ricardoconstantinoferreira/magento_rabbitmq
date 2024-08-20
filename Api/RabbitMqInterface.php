<?php

declare(strict_types=1);

namespace RCFerreira\Queue\Api;

interface RabbitMqInterface
{

    /**
     * @api
     *
     * @return void
     */
    public function execute(): void;
}
