<h2>People</h2>

<a href="<?php echo URL; ?>people/addPerson">Add Person</a>

<table id="peopletable">
    <tr>
        <th>id</th>
        <th>Firstname</th>
        <th>Lastname</th>
        
    </tr>
    
    <?php foreach($this->data as $person): ?>
    
    <tr>                
        <td><?php echo $person['id']; ?></td>
        <td><?php echo $person['firstname']; ?></td>
        <td><?php echo $person['lastname']; ?></td>
        <td><a href="<?php echo URL ?>people/details/<?php echo $person['id'] ?>">[Details]</a></td>
        <td><a href="<?php echo URL .'/loans/create/'. $person['id']; ?>">[New Loan]</a></td>
    </tr>
    
    <?php endforeach; ?>
</table>


