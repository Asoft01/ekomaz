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
            <td>User Enquiry from E-Commerce Website. Details are as below: </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Name: {{ $name }}</td>
        </tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Email: {{ $email }}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Subject: {{ $subject }}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Message: {{ $comment }}</td>
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