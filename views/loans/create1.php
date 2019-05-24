<h2>Create a new loan </h2>

Who is borrowing the equipment ? 

<p>If the person who wishes to borrow equipment is not in the database below, you 
    will need to add them.  

    You can search for and add existing LJMU users <a href="<?php echo URL ?>userinfo"> here</a> or, alternatively, 
    add non-LJMU users <a href="<?php echo URL; ?>people">here</a>.</p>

<p></p>

<?php foreach ($this->data['people'] as $person): ?>
    <li>
        <a href="<?php echo URL; ?>loans/create/<?php echo $person['id']; ?>">
            <?php
            echo $person['firstname'] . " ";
            echo $person['lastname'];
            ?>
    </li>
<?php endforeach; ?>

        &nbsp;
    &nbsp;
    &nbsp;
    <a href="<?php echo URL; ?>/loans" >Cancel</a>
