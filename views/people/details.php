<h2>Person details!</h2>

<table>
    <tr>
        <td>Firstname</td>
        <td><?php echo $this->person->getFirstname(); ?></td>
    </tr>

    <tr>
        <td>Lastname:</td>
        <td><?php echo $this->person->getLastname(); ?></td>
    </tr>

    <tr>
        <td>ID:</td>
        <td><?php echo $this->person->getId(); ?></td>
    </tr>


    <tr>
        <td>e-mail:</td>
        <td><?php echo $this->person->getEmail(); ?></td>
    </tr>

    <tr>
        <td>Tel:</td>
        <td><?php echo $this->person->getTel(); ?></td>
    </tr>

    <tr>
        <td>Username:</td>
        <td><?php echo $this->person->getUsername(); ?></td>
    </tr>


    <?php if ($this->loans != null): ?>
        <tr>
            <td>Loans</td>
            <?php foreach ($this->loans as $loan): ?>
            <tr>
                <td>
                    <a href="<?php echo URL . 'loans/details/' . $loan['id']; ?>">
                        Loan <?php echo $loan['id']; ?>
                    </a>
                </td>
                <?php if ($loan['time'] != null): ?>
                    <td>- <?php echo gmdate("Y-m-d", $loan['time']); ?>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach ?>       
    </tr>
<?php endif ?>

<tr>
    <td>
        <a href="<?php echo URL . '/loans/create/' . $this->person->getId(); ?>">New Loan</a>
    </td>
</tr>


</table>