<?php

class EmployeeService
{
    public function getEmployee(Employee $employee)
    {
        $cacheKey = 'employee-' . $employee['id'];
        if ($redis->has($cacheKey)) return $redis->get($cacheKey);
        $db = new MySQL('dsn', 'username', 'password');


        $employeeHydrator = new EmployeeHydrator();
        $employeeData = $db->query("SELECT * FROM `employees` WHERE id = ${employeeId}");
        $employee = $employeeHydrator->createAndHydrate($employeeData);
        return $employee;
    }
}