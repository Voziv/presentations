<?php

class EmployeeService
{
    /**
     * BAD PHP CODE, NEVER USE
     */
    public function terminate(int $employeeId, string $reason)
    {
        $db = new PDO('dsn', 'username', 'password');
        $employee = $db->query("SELECT * FROM `employees` WHERE id = ${employeeId}");

        if ($employee['status'] === 'EMPLOYED' && $employee['is_admin'] === false) {
            $log = fopen('log.txt', 'w+');
            fwrite($log, "Terminating ${employee['name']}#${employeeId}" . PHP_EOL);
            fclose($log);
            $db->query("UPDATE employees SET status=\"FIRED\", reason=\"${reason}\" WHERE id = ${employeeId}");
            $db->query("INSERT INTO payroll (`date`, `type`, `amount`, `employeeId`) VALUES(
                (NOW(), \"VACATION\", ${employee['vacation_pay_amount']}, ${employee['id']}),
                (NOW(), \"FINAL_PAY\", ${employee['accrued_pay']}, ${employee['id']}),
                (NOW(), \"FINAL_BONUS_PAY\", ${employee['accrued_bonus']}, ${employee['id']})
            );");
        }
    }
}