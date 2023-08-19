<?php
/**
 * @var \App\Model\Entity\Monster[] $monsters
 */
?>
<link rel="stylesheet" href="/bootstrap/css/bootstrap-reboot.min.css">
<link rel="stylesheet" href="/bootstrap/css/bootstrap-grid.min.css">
<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Available Monsters</h1>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <tr>
            <th>Name</th>
            <th>Species</th>
        </tr>
        <?php if (empty($monsters)):?>
            <tr><td colspan="2">No monsters found</td></tr>
        <?php else: ?>
            <?php foreach ($monsters as $monster) : ?>
                <tr>
                    <td>
                        <a href="/monsters/view/<?= $monster->id()?>" title="<<?= $monster->name()?>">
                            <?= $monster->name()?>
                        </a>
                    </td>
                    <td><?= $monster->species()->name()?></td>
                </tr>
            <?php endforeach;?>
        <?php endif; ?>
    </table>

</div>
