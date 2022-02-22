<h1 class="revise-title">Belo novo dia de revisões!</h1>
<?php if(count($todayAssuntos) > 0): ?>
    <p class="p-title">As revisões de hoje, <?= $_SESSION['user']->name ?>, <?= isset($date) ? $date : '' ?> são:</p>
<?php else: ?>
    <p class="p-title"><?= $_SESSION['user']->name ?>, não há revisões marcadas para hoje, dia <?= isset($date) ? $date : '' ?> :) </p>
<?php endif ?>

<?php foreach($todayAssuntos as $keyAssunto => $assuntosArea): ?>
    <div class="table__revise">
    <h1 class="table_revise__area-title">Área: <?= $keyAssunto ?></h1>

    <?php foreach($assuntosArea as $assuntosSubArea): ?>
        <table class="revises-show" cellspacing="0">
            <tr>
                <th>Área</th>
                <th>Sub-área</th>
                <th>Assunto</th>
                <th>Descrição</th>
            </tr>
            <tr>
                <?php foreach($assuntosSubArea as $assunto): ?>
                <td><?= $assunto->area ?></td>
                <td><?= $assunto->sub_area ?></td>
                <td><?= $assunto->assunto ?></td>
                <td><?= $assunto->description ?></td>
            </tr>
            <?php endforeach ?>
        </table>
    <?php endforeach ?>

    </div>
<?php endforeach ?>

