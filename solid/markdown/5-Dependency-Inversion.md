# D
Dependency inversion principle

-------------

> “High-level modules should not depend on low-level modules. Both should 
> depend on abstractions. Abstractions should not depend on 
> details. Details should depend on abstractions.”
>
> — Wikipedia

notes: Dep


----

BAD
```
class UserRepository {
    private $db;
    public function __construct() {
        // New glue
        $this->db = new MySQL(...);
    }

    public function get(int $id) {
        $log = fopen('log.txt');
        fwrite($log, "Getting user ID $id");
        fclose($log);
        
        $db->query(...);
    }
}
```

----

### How do we fix this?

- Constructor injection
- Method injection
- Setter injection

----

Constructor injection
```
class UserRepository {
    private $db;
    private $logger;

    public function __construct(DatabaseConnection $db, Logger $logger) {
        $this->db = $db;
        $this->logger = $logger;
    }

    public function get(int $id) {
        $this->logger->log("Getting user ID $id");
        $user = $this->db->query(...);
        // .. Rest of get logic
    }
}
```

----

Function injection
```
class UserRepository {
    public function get(int $id, DatabaseConnection $db, Logger $logger) {
        $this->log("Getting user ID $id");
        $user = $db->query(...);
        // .. Rest of get logic
    }
}
```

----

Setter injection
```
class UserRepository {
    private $db;

    public function setDatabaseConnection(DatabaseConnection $db) {
        $this->db = $db;
    }
}
```