<?php

namespace EventSchema\Event;


use JsonSchema\Constraints\Constraint;
use JsonSchema\Validator;

class EventValidator
{
    /** @var \JsonSchema\Validator */
    protected $validator;

    /**
     * EventValidator constructor.
     *
     * @param \JsonSchema\Validator|null $validator
     */
    public function __construct(Validator $validator = null)
    {
        $this->validator = $validator ?? new Validator();
    }

    /**
     * @param string $json
     * @param \EventSchema\Event\Event $event
     * @return bool
     */
    public function validate(string &$json, Event $event)
    {
        $this->validator->validate($json, $event->getSchema(), Constraint::CHECK_MODE_APPLY_DEFAULTS);

        return $this->validator->isValid();
    }
}
