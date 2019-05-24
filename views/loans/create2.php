<?php $person = $this->data['borrower']; ?>

<h2>New Loan</h2>

<?php echo $person->getFirstname() . " " . $person->getLastname(); ?>

<br /><br />
<form method="POST" action="">

    <?php foreach ($this->data['assets'] as $asset): ?>

        <input type='checkbox' name='items[]' value='<?php echo $asset['id']; ?>'> </input>
        
        <?php echo $asset['name']; ?> 

        <br />        
    <?php endforeach; ?>        
        <input type="hidden" name='page2' value='page2'></input>
        <input type="submit" name='submit' value="submit"></input>
    &nbsp; &nbsp;
    &nbsp; &nbsp;
    &nbsp; &nbsp;
    <a href="<?php echo URL; ?>/loans" >Cancel</a>


</form>




