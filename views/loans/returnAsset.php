<?php $asset = $this->asset; ?>
<?php $auth_id = User::get_id(); ?>
<?php $auth_name = User::get_firstname() . ' ' . User::get_lastname(); ?>
<?php $doStuffLink = URL . '/loans/returnAssetDo/' . $asset->getId(); ?>
<?php $dontDoStuffLink = $this->ref; ?>


<h1>Are you sure you wish to sign this asset back in?</h1>

<h2>Details:</h2>

<!-- show asset details! -->

<table cellspacing="14">
    <tr>
        <td>Name:</td>
        <td><strong><?php echo $asset->getName() ?></strong></td>
    </tr>
        <tr>
        <td>Who borrowed it?</td>
        <td><?php echo $asset->getCurrentBorrowerName() ?>
    </tr>    

    <tr>
        <td>ID:</td>
        <td><?php echo $asset->getId() ?></td>
    </tr>    
    <tr>
        <td>Model:</td>
        <td><?php echo $asset->getModel() ?></td>
    </tr>
    <tr>
        <td>Manufacturer:</td>
        <td><?php echo $asset->getMan() ?></td>
    </tr>
    <tr>
        <td>Asset Number:</td>
        <td><?php echo $asset->getAssetnumber(); ?> </td>
    </tr>
    <tr>
        <td>Serial Number:</td>
        <td><?php echo $asset->getSerial() ?></td>
    </tr>    
    <tr>
        <td>Notes:</td>
        <td><?php echo $asset->getNotes() ?>
    </tr>
</table>
<br />

<!-- yes or no --->
<p>
    The decision is yours <?php echo $auth_name; ?>, but decide wisely... </p>
<p>
[&nbsp;<a href="<?php echo $doStuffLink; ?>">Do this</a>&nbsp;] &nbsp;
&nbsp;[&nbsp;<a href="<?php echo $dontDoStuffLink; ?>">No, don't do this!</a>&nbsp;]</p>
<br /><br />



