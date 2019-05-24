<h1>Loan detail</h1>

<?php echo $this->borrower->getFirstname() . ' ' . $this->borrower->getLastname(); ?>    
<br />
<?php echo $this->borrower->getemail(); ?>
<br />
<?php echo $this->borrower->getUsername(); ?>



<ul>
    <?php foreach ($this->items as $item) : ?>
        <li><?php echo $item->getName(); ?>
        </li>
    <?php endforeach; ?>
</ul>


<form method="POST" action="">
    Notes :<br />
    <textarea name="notes" ></textarea>
    <?php foreach ($this->items as $item): ?>
        <input type='hidden' name='items[]' value='<?php echo $item->getId(); ?>' />
    <?php endforeach; ?>

    <br /><br />
    <input type='hidden' name='page3' value='page3'></input>
    <input type="submit" name="submit" value="Submit"></input>

    &nbsp;
    &nbsp;
    &nbsp;
    <a href="<?php echo URL; ?>/loans" >Cancel</a>


</form>