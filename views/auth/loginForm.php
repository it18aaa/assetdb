LOGIN FORM!

<form action="<?php echo URL; ?>auth/doLogin" method="post">
<table>
    <tr>
        <td><label>Username:</label></td>
        <td><input type="text" name="username" /></td>
    </tr>
    <tr>
        <td><label>Password:</label></td>
        <td><input type="password" name="password" /></td>   
    </tr>
    <tr>
        <td></td>
        <td><input type="submit"></td>
    </tr>
</table>