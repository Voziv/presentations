# L
Liskov Substituion Principle

-----

> “Let ϕ ( x ) be a property provable about objects x of type T. Then ϕ ( y ) 
> should be true for objects y of type S where S is a subtype of T.”
>
> — Barbara Liskov and Jeanette Wing

Notes:
Φ = phi / phy  (FI as in WI-FI)


----

English please

-----

> “Objects in a program should be replaceable with instances of their subtypes without 
> altering the correctness of that program.”
>
> — Wikipedia

----

Let's take this interface for example

```php
<?php

interface Logger {
    public function log(string $message, $context = null);
}
```

This should only ever log a message with its context.

----

WRONG

```php
<?php

class AuthLogger implements Logger {
    public function log(string $message, $context = null) {
        User::delete();
        
        fopen('log.txt');
        // ... proceed with logging
    }
}
```

We've now added functionality which isn't "logging".

----

RIGHT

```php
<?php

class SlackLogger implements Logger {
    public function log(string $message, $context = null) {
        $this->slack->send(
            $this->channel,
            $message,
            $this->formatContext($context)
        );
    }
}
```



----

ALSO RIGHT

```php
<?php
class AggregateLogger implements Logger {
    private $loggers;

    public function __construct($loggers) {
        $this->loggers = $loggers;
    }

    public function log(string $message, $context = null) {
        foreach ($this->loggers as $logger) {
            $logger->log($message, $context);
        }
    }
}
```

This also handles the S in solid too.

