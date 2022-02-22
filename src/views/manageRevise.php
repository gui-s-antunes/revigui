<div class="table__revise">
    <?php require_once(VIEW_TEMPLATE_PATH . '/messages.php')?>
    <h1><i class="icofont-ebook"></i> Gerenciar assuntos</h1>

    <table cellspacing="0">
        <tr>
            <th>Área</th>
            <th>Sub-área</th>
            <th>Assunto</th>
            <th>Descrição</th>
            <th>Próx. revisão</th>
            <th>Editar</th>
            <th>Desativar</th>
        </tr>
        <?php foreach($assuntos as $assunto): ?>
        <tr class="<?= $assunto->is_disabled === '1' ? 'blue' : ''?>">
            <td><?= $assunto->area ?></td>
            <td><?= $assunto->sub_area ?></td>
            <td><?= $assunto->assunto ?></td>
            <td><?= $assunto->description ?></td>
            <td><?= $assunto->date_revise ?></td>
            <td><a class="a_edit" href="editAssunto.php?id=<?= $assunto->id ?>">Editar</a></td>
            <?php if($assunto->is_disabled === '0'): ?>
            <td><a class="a_disable" href="toggleAssunto.php?id=<?= $assunto->id ?>&toggle=disable">Desativar</a></td>
            <?php else: ?>
            <td><a class="a_enable" href="toggleAssunto.php?id=<?= $assunto->id ?>&toggle=enable">Ativar</a></td>
            <?php endif ?>
        </tr>
        <?php endforeach ?>
    </table>
</div>
