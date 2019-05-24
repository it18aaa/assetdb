<h1>Search LJMU User Database</h1>

<form action="<?php echo URL; ?>userinfo/search" method="get">
<table>
    <tr>
        <td><label>Username:</label></td>
        <td><input type="text" name="username" /></td>
    </tr>   
    <tr><td>
    ~or~
        </td></tr>
        <tr>
        <td><label>Lastname:</label></td>
        <td><input type="text" name="lastname" /></td>
    </tr>   

    
    <tr>
        <td></td>
        <td><input type="submit" value="Search"/></td>
    </tr>
</table>