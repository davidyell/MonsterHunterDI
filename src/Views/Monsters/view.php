<?php
/**
 * @var \App\Model\Entity\Monster $monster
 */
?>
<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">

<div class="container">
    <h1><?= $monster->name()?></h1>

    <p>Species: <strong><?= $monster->species()->name()?></strong></p>

    <p>
        <a href="/" title="Back" class="btn btn-default">Back</a>
    </p>
</div>
