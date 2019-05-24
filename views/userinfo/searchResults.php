<h1>Search LJMU User Database</h1>

<h2>Search Results</h2>
<table>

    <?php foreach ($this->results as $data) : ?>
        <?php if ($data['division'] == 'Faculty of Science'): ?>
            <tr style="font-weight: bold;">       
            <?php else: ?>
            <tr>
            <?php endif; ?>
            <Td><?php echo $data['username']; ?> </td>
            <Td><?php echo $data['firstname']; ?> </td>
            <Td><?php echo $data['lastname']; ?> </td>
            <Td><?php echo $data['type']; ?> </td>
            <!-- <Td><?php echo $data['division']; ?></td> -->
            <Td><?php echo $data['dept']; ?></td>
            <td><a href='show/<?php echo $data['username']; ?>'>Details</a></td>
        </tr>

    <?php endforeach; ?>
    
</table>
