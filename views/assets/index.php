
<h2>Assets</h2>

<a href="<?php echo URL; ?>people/addAsset">Add Asset</a>

<br />

<?php echo "COUNT: ". count($this->data); ?>
<table id="assettable" style="border: 1px solid grey;">
    <tr>
        <th>ID</th>
        <th>Asset name</th>
        <th>Type</th>
        
        
            
    </tr>
    
    <?php foreach($this->data as $asset): ?>
    
    <tr>                
        <td><?php echo $asset['id']; ?></td>
        <td><?php echo $asset['name']; ?></td>
        <td><?php echo $asset['type']; ?></td>
        <td>
            <a href="<?php echo URL .'assets/details/'. $asset['id']; ?>">Details</a>
        </td>
        
    </tr>
    
    <?php endforeach; ?>
</table>

