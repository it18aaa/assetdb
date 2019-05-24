<?php $assets = $this->loan->getAssets(); ?>
<?php $borrower = $this->loan->getBorrower(); ?>
<?php $creator = $this->loan->getCreator(); ?>
<?php $loan = $this->loan; ?>
<?php $borrowerName = $borrower->getFirstname() . ' ' . $borrower->getLastname(); ?>
<?php $borrowerUrl = URL . 'people/details/' . $borrower->getId(); ?>
<?php $creatorName = $creator->getFirstname() . ' ' . $creator->getLastname(); ?>
<?php $creatorUrl = URL . 'people/details/' . $creator->getId(); ?>



<h1>Loan <?php echo $loan->getId(); ?> details</h1>

<table cellpadding="6">

    <tr>
        <td>
            Borrower:
        </td>
        <td>
            <strong>
                <a href="<?php echo $borrowerUrl; ?>">
                    <?php echo $borrowerName; ?>
                </a>
            </strong>
        </td>
    </tr>
    <tr>
        <td>Loan created by:</td>
        <td>
            <a href="<?php echo $creatorUrl; ?>">
                <?php echo $creatorName; ?>
            </a>
        </td>

    </tr><tr></tr>
    <tr><td valign="top">Loan items:</td>
        <td>
            <table border="1" cellpadding="10" cellspacing="0">
                <tr>
                    <th>Asset</th>
                    <th>Signed Out</th>
                    <th>Returned</th>
                    <th>Date returned</th>
                    <th>Signed in by</th>
                </tr>
                <?php foreach ($assets as $asset): ?>
                    <tr>
                        <td>
                            <a href="<?php echo URL . 'assets/details/' . $asset->getId(); ?>">
                                <?php echo $asset->getName(); ?><br />
                            </a>
                        </td>
                        <td>
                            <?php echo $this->uxTimeToDateStr($asset->getSignouttime()); ?>
                        </td>
                        <td>
                            <?php echo $asset->getComplete(); ?>
                        </td>
                        
                        <td>
                            <?php echo $this->uxTimeToDateStr($asset->getSignintime()); ?>
                        </td>
                        <td>
                            <?php echo $asset->getSigninbywhom(); ?>
                        </td>
                        <td>
                            <?php if ($asset->getComplete() == 'N'): ?>
                            <a href="<?php echo URL . 'loans/returnAsset/' . $asset->getId();?>">
                                Return
                            </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </td>
    </tr>
    <tr>

    </tr>
</table>

