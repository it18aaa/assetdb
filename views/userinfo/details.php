<h1>Search LJMU User Database</h1>

<h2> User details: </h2>
<h3><?php echo $this->data['firstname'] . ' ' . $this->data['lastname']; ?></h3>

<form method="post" action="<?php echo URL; ?>people/addPerson">

    <input type="hidden" name="username" value="<?php echo $this->data['username']; ?>" />
    <input type="hidden" name="firstname" value="<?php echo $this->data['firstname']; ?>" />
    <input type="hidden" name="lastname" value="<?php echo $this->data['lastname']; ?>" />
    <input type="hidden" name="mail" value="<?php echo $this->data['mail']; ?>" />
    <input type="hidden" name="dept" value="<?php echo $this->data['dept']; ?>" />
    <input type="hidden" name="tel" value="<?php echo $this->data['tel']; ?>" />
    <input type="hidden" name="division" value="<?php echo $this->data['division']; ?>" />
    <input type="hidden" name="type" value="<?php echo $this->data['type']; ?>" />


    <table>

        <tr>
            <td>Username:</td>
            <td><?php echo $this->data['username']; ?></td>
        </tr>
        <tr> 
            <td>Email:</td>
            <td><?php echo $this->data['mail']; ?></td>
        </tr>
        <tr>
            <td>Tel:</td> 
            <td><?php echo $this->data['tel']; ?></td>
        </tr>
        <tr> 
            <td>Department: </td>
            <td><?php echo $this->data['dept']; ?></td><tr> 
        </tr>
        <tr> 
            <td>Division:</td>
            <td><?php echo $this->data['division']; ?></td><tr> 
        </tr>
        <tr> 
            <td>Type:</td>
            <td><?php echo $this->data['type']; ?></td>
            <td>    <input type="submit" name="submit" value="Add to database?"/>
            </td>

        </tr>
        <tr>         
        </tr>
    </table>



</form>