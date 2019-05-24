
<h2>Loans</h2>

<a href="<?php echo URL; ?>loans/create">New Loan</a><br />

<h4>Loan items outstanding</h4>

<table >
    <tr>
        <th>Loan</th>
        <th>Item</th>
        <th>Borrower</th>
        <th>Date</th>        
    </tr>

    <?php foreach ($this->data as $loaninfo): ?>
        <tr>                
            <td>                
                <?php echo $loaninfo['loanid']; ?>
            </td>
            <td>
                <a href="<?php echo URL . 'assets/details/' . $loaninfo['assetid']; ?>">
                    <?php echo $loaninfo['name']; ?>
                </a>
            </td>    
            
            <td>
                <a href="<?php echo URL . 'people/details/' . $loaninfo['personid']; ?>">
                    <?php echo $loaninfo['firstname'] . ' ' . $loaninfo['lastname']; ?>
                </a>
            </td>            
            <td>
                <?php echo $this->uxTimeToDateStr($loaninfo['signouttime']); ?>
            </td>
            <td>
                <a href="<?php echo URL . 'loans/details/' . $loaninfo["loanid"]; ?>">Details</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

