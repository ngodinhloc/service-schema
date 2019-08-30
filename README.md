# Service Schema
[![Build Status](https://travis-ci.com/brighte-capital/service-schema.svg?branch=master)](https://travis-ci.com/brighte-capital/service-schema)
[![codecov](https://codecov.io/gh/brighte-capital/service-schema/branch/master/graph/badge.svg)](https://codecov.io/gh/brighte-capital/service-schema)

Using json schema to validate event messages and process services.

Event is defined by json
<pre>
{
  "event": "Users.afterSaveCommit.Create",
  "time": "20190726032212",
  "payload": {
    "user": {
      "data": {}
    },
    "account": {
      "data": {
        "name": "Brighte"
      }
    }
  }
}
</pre>

Service has a json schema that use to validate against the Event json
<pre>
{
  "type": "object",
  "properties": {
    "event": {
      "type": "string",
      "minLength": 0,
      "maxLength": 256
    },
    "time": {
      "type": "string",
      "minLength": 0,
      "maxLength": 256
    },
    "payload": {
      "type": "object",
      "properties": {
        "user": {
          "type": "object",
          "properties": {
            "data": {
              "type": "object"
            },
            "class": {
              "type": "string",
              "default": "\\App\\Entity\\User"
            }
          },
          "required": [
            "data"
          ]
        },
        "account": {
          "type": "object",
          "properties": {
            "data": {
              "type": "object"
            },
            "class": {
              "type": "string",
              "default": "\\App\\Entity\\Account"
            }
          },
          "required": [
            "data"
          ]
        }
      },
      "required": [
        "user",
        "account"
      ],
      "additionalProperties": false
    }
  },
  "required": [
    "event",
    "payload"
  ],
  "additionalProperties": true
}
</pre>
 
## Configuration
<pre>
"require": {
        "brightecapital/service-schema": "^1.0.0"
    }
</pre>
## Sample code
### configs 
events.json
<pre>
[
  {
    "event": "Users.afterSaveCommit.Create",
    "services": [
      "ServiceSchema\\Tests\\Service\\Samples\\CreateContact",
      "ServiceSchema\\Tests\\Service\\Samples\\CreateTask"
    ]
  },
  {
    "event": "Users.afterSaveCommit.Update",
    "services": [
      "ServiceSchema\\Tests\\Service\\Samples\\UpdateContact"
    ]
  }
]
</pre>

In this events.json:
- There are 02 events that the microservice is listening to: "Users.afterSaveCommit.Create", "Users.afterSaveCommit.Update"
- Each of event have a list of services that will run the event

services.json
<pre>
[
  {
    "service": "ServiceSchema\\Tests\\Service\\Samples\\CreateContact",
    "schema": "/jsons/schemas/CreateContact.json",
    "callbacks": [
      "ServiceSchema\\Tests\\Service\\Samples\\PushMessageToSqs",
      "ServiceSchema\\Tests\\Service\\Samples\\PushMessageToLog"
    ]
  },
  {
    "service": "ServiceSchema\\Tests\\Service\\Samples\\UpdateContact",
    "schema": "/jsons/schemas/UpdateContact.json",
    "callbacks": [
      "ServiceSchema\\Tests\\Service\\Samples\\PushMessageToLog"
    ]
  },
  {
    "service": "ServiceSchema\\Tests\\Service\\Samples\\CreateTask",
    "schema": "/jsons/schemas/CreateTask.json"
  }
]
</pre>

In this services.json:
- There are 03 services:  "ServiceSchema\\Tests\\Service\\Samples\\CreateContact", "ServiceSchema\\Tests\\Service\\Samples\\UpdateContact", "ServiceSchema\\Tests\\Service\\Samples\\CreateTask",
- Each service has a schema and a list of callback services

### services schema
CreateContact.json
<pre>
{
  "type": "object",
  "properties": {
    "event": {
      "type": "string",
      "minLength": 0,
      "maxLength": 256
    },
    "time": {
      "type": "string",
      "minLength": 0,
      "maxLength": 256
    },
    "payload": {
      "type": "object",
      "properties": {
        "user": {
          "type": "object",
          "properties": {
            "data": {
              "type": "object"
            },
            "class": {
              "type": "string",
              "default": "\\App\\Entity\\User"
            }
          },
          "required": [
            "data"
          ]
        },
        "account": {
          "type": "object",
          "properties": {
            "data": {
              "type": "object"
            },
            "class": {
              "type": "string",
              "default": "\\App\\Entity\\Account"
            }
          },
          "required": [
            "data"
          ]
        }
      },
      "required": [
        "user",
        "account"
      ],
      "additionalProperties": false
    }
  },
  "required": [
    "event",
    "payload"
  ],
  "additionalProperties": true
}
</pre>

In this CreateContact.json:
- It requires the message to have "name" and "payload"
- "payload" requires "user" and "account"
- "user" requires "data"
- "account" requires "data"

### Event
<pre>
$event = new Event();
$event->setName("Users.afterSaveCommit.Create");
$event->setTime("20190730123000");
$event->setPayload(["user" => ["data" => ["name" => "Ken"]], "account" => ["data" => ["name" => "Brighte"]]]);
$message = $event->toJson();
// '{"name":"Users.afterSaveCommit.Create","time":"20190730123000","payload":{"user":{"data":{"name":"Ken"}},"account":{"data":{"name":"Brighte"}}}}'
// this message is used to push to SQS or other services
</pre>

### Service
<pre>
namespace ServiceSchema\Tests\Service\Samples;

use ServiceSchema\Event\Message;
use ServiceSchema\Event\MessageInterface;
use ServiceSchema\Service\Service;
use ServiceSchema\Service\ServiceInterface;

class CreateContact extends Service implements ServiceInterface
{
    public function consume(MessageInterface $event = null)
    {
        echo "CreateContact";

        return new Message();
    }
}

</pre>

### Processor
<pre>
// Receive message from SQS or other services
$message = '{"name":"Users.afterSaveCommit.Create","time":"20190730123000","payload":{"user":{"data":{"name":"Ken"}},"account":{"data":{"name":"Brighte"}}}}';
// config the Processor
$processor = new Processor(["events.json"], ["services.json"], "serviceSchemaDir");
// process the message
$result = $processor->process($message);
/*
 * In this example, event "Users.afterSaveCommit.Create" has 02 services listening to it (configued in events.json)
 * "ServiceSchema\\Tests\\Service\\Samples\\CreateContact", "ServiceSchema\\Tests\\Service\\Samples\\CreateTask"
 * When $processor->process(message): CreateContact->run(Event) and CreateTask->run(Event) will be executed.
 * Service CreateContact has 02 callback services (configured in services.json): 
 * "ServiceSchema\\Tests\\Service\\Samples\\PushMessageToSqs","ServiceSchema\\Tests\\Service\\Samples\\PushMessageToLog"
 * When CreateContact->run(Event) returns an Event then PushMessageToSqs->run(Event) and PushMessageToLog->run(Event) will be executed
 */
</pre>

Please refer tests to see the sample configs of events, services, schema and usage of Processor
- tests/jsons/configs/events.json: configuration of events
- tests/jsons/config/services.json: configuration of services
- tests/jsons/configs/schemas/: sample services schemas (CreateContact.json, CreateTask.json, UpdateContact.json)
- tests/Main/ProcessorTest.php: how to config and run the Processor
