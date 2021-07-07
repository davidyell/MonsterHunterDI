<?php
/**
 * @var \App\Model\Entity\Monster[] $monsters
 */
?>
<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">

<div class="container">
    <h1>Available Monsters</h1>

    <table class="table table-bordered table-striped">
        <tr>
            <th>Name</th>
            <th>Species</th>
        </tr>
        <?php foreach ($monsters as $monster): ?>
            <tr>
                <td><?= $monster->name()?></td>
                <td><?= $monster->species()?></td>
            </tr>
        <?php endforeach;?>
    </table>

</div>
