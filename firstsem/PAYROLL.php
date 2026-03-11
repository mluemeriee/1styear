<?php

function calculatePayroll($name, $hoursWorked, $hourlyWage, $taxRate) {

    $grossPay = $hoursWorked * $hourlyWage;
    $taxes = $grossPay * ($taxRate / 100);
    $netPay = $grossPay - $taxes;


    echo "<h1>Payroll Summary\n </h1><br>";
	echo "Name: $name\n <br>";
    echo "Hours Worked: $hoursWorked\n <br>";
    echo "Hourly Wage: ₱$hourlyWage\n <br>";
    echo "Gross Pay: ₱$grossPay\n <br>";
    echo "Taxes Deducted: ₱$taxes\n <br>";
    echo "Net Pay: ₱$netPay\n <br>";
}


$employee1 = ['name' => 'Bluee', 'hoursWorked' => 40, 'hourlyWage' => 20, 'taxRate' => 10];


calculatePayroll($employee1['name'], $employee1['hoursWorked'], $employee1['hourlyWage'], $employee1['taxRate']);

?>


