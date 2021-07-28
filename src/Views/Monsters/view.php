<?php
/**
 * @var \App\Model\Entity\Monster $monster
 */
?>
<link rel="stylesheet" href="/bootstrap/css/bootstrap-reboot.min.css">
<link rel="stylesheet" href="/bootstrap/css/bootstrap-grid.min.css">
<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1><?= $monster->name()?></h1>
        </div>
    </div>

    <?php if (!empty($monster->image())) :?>
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="/img/<?= $monster->image()?>" alt="<?= $monster->name()?>">
            </div>
        </div>
    <?php endif;?>

    <div class="row mt-3">
        <div class="col-md-12">
            <table class="table table-striped">
                <tr>
                    <td>Species</td>
                    <td><strong><?= $monster->species()->name()?></strong></td>
                </tr>
            </table>

            <p class="text-center">
                <a href="/" title="Back" class="btn btn-primary btn-block">&leftarrow; Back</a>
            </p>
        </div>
    </div>
</div>
