# O
Open / Closed Principle

-----

> “Software entities (classes, modules, functions, etc.) should be open 
> for extension, but closed for modification”
>
> — Wikipedia

----

Let's add a new payment type, Direct Deposit

BAD:
```php
<?php
class PayrollService {
    public function payEmployee($employeeId, $amount, $type) {
        if ($type === 'Cheque') {
            // Cheque  logic 
        }
        elseif ($type === 'DirectDeposit') { 
            // Direct deposit logic 
        }    
    }
}
```


----

GOOD:
```php
interface PayrollMethod {
    public function payEmployee($employeeId, $amount);
}
```
```php
class DirectDepositStrategy implements PayrollMethod {
    public function payEmployee($employeeId, $amount) {
        // Direct deposit logic 
    }
}
```
```php
class ChequeStrategy  implements PayrollMethod {
    public function payEmployee($employeeId, $amount) {
        // Cheque Logic
    }
}
```