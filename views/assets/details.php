<h1>Asset details</h1>

<table>
    <tr>
        <td>Name:</td>
        <td><strong><?php echo $this->asset->getName() ?></strong></td>
    </tr>
    <tr>
        <td>ID:</td>
        <td><?php echo $this->asset->getId() ?></td>
    </tr>    
    <tr>
        <td>Model:</td>
        <td><?php echo $this->asset->getModel() ?></td>
    </tr>
    <tr>
        <td>Manufacturer:</td>
        <td><?php echo $this->asset->getMan() ?></td>
    </tr>
    <tr>
        <td>Asset Number:</td>
        <td><?php echo $this->asset->getAssetnumber(); ?> </td>

    </tr>
    <tr>
        <td>Serial Number:</td>
        <td><?php echo $this->asset->getSerial() ?></td>
    </tr>    
    <tr>
        <td>Notes:</td>
        <td><?php echo $this->asset->getNotes() ?>
    </tr>
    <tr><td colspan="2"> &nbsp;</td></tr>
    <tr> 
        <td>Record created by:</td>
        <td>
            <a href="<?php echo URL . 'people/details/' . $this->asset->getCreatorID(); ?>">
                <?php echo $this->asset->getCreatorName(); ?>
            </a>
        </td>

    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
        <td colspan="2">
            <strong>
                Loan history
            </strong>
        </td>        
    </tr>
    <?php if ($this->asset->getCurrentLoanId() != null): ?>
        <tr>
            <td>Currently out</td>
            <td>
                <a href="<?php echo URL . 'people/details/' . $this->asset->getCurrentBorrowerId(); ?>">
                    <?php echo $this->asset->getCurrentBorrowerName(); ?>
                </a> - 
                <a href="<?php echo URL . 'loans/details/' . $this->asset->getCurrentLoanId(); ?>" >
                    Loan <?php echo $this->asset->getCurrentLoanId(); ?>
                </a>
            </td>   
        </tr>
        <tr>
            <td></td>
            <td>

            </td>
        </tr>
    <?php endif; ?>


    <?php if (count($this->asset->getLoans()) > 0) : ?>

        <?php foreach ($this->asset->getLoans() as $loanArr): ?>
        
            <tr>
                <td>
                    Loan <a href="<?php echo URL . '/loans/details/' . $loanArr['loanid']; ?>">
                        <?php echo $loanArr['loanid']; ?>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

    <?php endif; ?>

    <tr>
        <td></td>
        <td></td>                    
    </tr>








</table>

