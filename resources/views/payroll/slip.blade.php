<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Slip Gaji</title>

    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width:100%;
            border-collapse: collapse;
        }

        td {
            padding:8px;
            border:1px solid #ccc;
        }

        h2 {
            text-align:center;
        }
    </style>
</head>

<body>

<h2>SLIP GAJI</h2>

<table>
    <tr>
        <td>Nama</td>
        <td>{{ $payroll->employee->name }}</td>
    </tr>

    <tr>
        <td>NIK</td>
        <td>{{ $payroll->employee->employee_number }}</td>
    </tr>

    <tr>
        <td>Periode</td>
        <td>{{ $payroll->period }}</td>
    </tr>

    <tr>
        <td>Gaji Pokok</td>
        <td>Rp {{ number_format($payroll->basic_salary) }}</td>
    </tr>

    <tr>
        <td>Tunjangan</td>
        <td>Rp {{ number_format($payroll->allowance) }}</td>
    </tr>

    <tr>
        <td>Potongan</td>
        <td>Rp {{ number_format($payroll->deduction) }}</td>
    </tr>

    <tr>
        <td><b>Gaji Bersih</b></td>
        <td>
            <b>
                Rp {{ number_format($payroll->net_salary) }}
            </b>
        </td>
    </tr>
</table>

</body>
</html>
