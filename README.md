# Service Schema
Event based service processor for microservices.

Event is defined by json
<pre>
{
  "name": "Users.afterSaveCommit.Create",
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
    "name": {
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
    "name",
    "payload"
  ],
  "additionalProperties": false
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
      "ServiceSchema\\ServiceSamples\\CreateContact",
      "ServiceSchema\\ServiceSamples\\CreateTask"
    ]
  },
  {
    "event": "Users.afterSaveCommit.Update",
    "services": [
      "ServiceSchema\\ServiceSamples\\UpdateContact"
    ]
  }
]
</pre>
services.json
<pre>
[
  {
    "service": "ServiceSchema\\ServiceSamples\\CreateContact",
    "schema": "\\jsons\\schemas\\CreateContact.json",
    "callbacks": [
      "ServiceSchema\\ServiceSamples\\PushMessageToSqs",
      "ServiceSchema\\ServiceSamples\\PushMessageToLog"
    ]
  },
  {
    "service": "ServiceSchema\\ServiceSamples\\UpdateContact",
    "schema": "\\jsons\\schemas\\UpdateContact.json",
    "callbacks": [
      "ServiceSchema\\ServiceSamples\\PushMessageToLog"
    ]
  },
  {
    "service": "ServiceSchema\\ServiceSamples\\CreateTask",
    "schema": "\\jsons\\schemas\\CreateTask.json"
  }
]
</pre>

### services schema
CreateContact.json
<pre>
{
  "type": "object",
  "properties": {
    "name": {
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
    "name",
    "payload"
  ],
  "additionalProperties": false
}
</pre>

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
namespace ServiceSchema\ServiceSamples;

use ServiceSchema\Event\Event;
use ServiceSchema\Event\EventInterface;
use ServiceSchema\Service\Service;
use ServiceSchema\Service\ServiceInterface;

class CreateContact extends Service implements ServiceInterface
{
    public function run(EventInterface $event = null)
    {
        echo "CreateContact";

        return new Event();
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
 * In this example, event "Users.afterSaveCommit.Create" has 02 services listening to it (configued in event.json)
 * "ServiceSchema\\ServiceSamples\\CreateContact", "ServiceSchema\\ServiceSamples\\CreateTask"
 * When $processor->process(message): CreateContact->run(Event) and CreateTask->run(Event) will be executed.
 * Service CreateContact has 02 callback services (configured in services.json): 
 * "ServiceSchema\\ServiceSamples\\PushMessageToSqs","ServiceSchema\\ServiceSamples\\PushMessageToLog"
 * When CreateContact->run(Event) return an Event then PushMessageToSqs->run(Event) and PushMessageToLog->run(Event) will be executed
 */
</pre>
