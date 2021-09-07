<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <td>Dear {{ $name }}!</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Please click on the below link to activate your account:- </td>
        </tr>
        <tr>
            <td><a href="{{ url('confirm/'.$code) }}">Confirm Account</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
       
        <tr>
            <td>Thanks & Regards,</td>
        </tr>
        <tr>
            <td>E-Commerce Website</td>
        </tr>
    </table>
</body>
</html>