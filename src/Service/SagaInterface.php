<?php

namespace ServiceSchema\Service;

use ServiceSchema\Event\MessageInterface;

interface SagaInterface
{

    /**
     * @param \ServiceSchema\Event\MessageInterface $message
     * @return \ServiceSchema\Event\MessageInterface|bool
     */
    public function rollback(MessageInterface $message = null);

}
