## Single Responsibility Principle

-----

> &ldquo; A class should have one and only one reason to change &rdquo;

----

```php
<?php
interface UserService {
    public function connect();

    public function getUser(int $user);
    public function save(User $user);

    public function login(string $username, string $password);
}
```

Three Responsibilities:
- Database connection
- Fetching a user
- Authenticating a user 

Notes: 
Three Responsibilities:
- Database connection
- Fetching a user
- Authenticating a user 

----

Now each class only has one reason to change

```php
interface DatabaseConnection {
    public function connect();
    public function query($query);
}

interface UserRepository {
    public function get($id);
    public function save(User $user);
}

interface PasswordAuthenticationService {
    public function authenticate(...);
}
``` 

