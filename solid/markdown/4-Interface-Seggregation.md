# I
Interface segregation principle

-----

> “No client should be forced to depend on methods it does not use.”
>
> — Wikipedia

----

> “Many small interfaces are better than one giant interface”

----

Not great

```php
<?php
interface UserRepository {
    public function get($id);
    public function getByEmail($email);
    public function set($user);
    public function setName($userId, $name);
    public function setEmail($userId, $email);
    public function delete($userId);
}
```

----

Better

```php
<?php
interface ReadUserRepository {
    public function get($id);
    public function getByEmail($email);
}

interface WriteUserRepository {
    public function set($user);
    public function setName($userId, $name);
    public function setEmail($userId, $email);
    public function delete($userId);
}
```

----

Using the read interface

```php
<?php
class UserAuthController {
    public function loginAction(
        string $email, 
        string $password, 
        ReadUserRepository $repository
    ) {
        $user = $repository->getByEmail($email);
        // ...
    }
}
```

----

But I don't want to write so many small classes for a single method or two.

```php
<?php
class UserRepository implements ReadUserRepository, WriteUserRepository {
    public function get($id) { /* ... */}
    public function getByEmail($email) { /* ... */}
    public function set($user) { /* ... */}
    public function setName($userId, $name) { /* ... */}
    public function setEmail($userId, $email) { /* ... */}
    public function delete($userId) { /* ... */}
}
```

Keeping the other principles in mind, it's ok to do this. Split it up later when it gets too big.