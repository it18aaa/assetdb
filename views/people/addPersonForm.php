<!-- if sent here from the ljmu database search, want to load default values! -->

<h2>Add person to people database</h2>

   

<form action="<?php echo URL; ?>people/doAddPerson" method="post">
<table>
    <tr>
        <td><label>Username:</label></td>
        <td><input type="text" name="username" value="<?php if(isset($this->person))  echo $this->person->getUsername(); ?>" /></td>
    </tr>
    
    <tr>
        <td><label>Firstname:</label></td>
        <td><input type="text" name="firstname" value="<?php if(isset($this->person))  echo $this->person->getFirstname(); ?>" /></td>
    </tr>

    <tr>
        <td><label>Lastname:</label></td>
        <td><input type="text" name="lastname" value="<?php if(isset($this->person))  echo $this->person->getLastname(); ?>" /></td>
    </tr>
    
    <tr>
        <td><label>Email:</label></td>
        <td><input type="text" name="email" value="<?php if(isset($this->person))  echo $this->person->getEmail(); ?>" /></td>   
    </tr> 
        
    <tr>
        <td><label>Telephone:</label></td>
        <td><input type="text" name="tel" value="<?php if(isset($this->person))  echo $this->person->getTel(); ?>" /></td>   
    </tr>

    <tr>
        <td></td>
        <td><input type="submit"></td>
    </tr>
</table>