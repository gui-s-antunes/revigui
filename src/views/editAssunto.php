<div class="form-revise">
    <?php require_once(VIEW_TEMPLATE_PATH . '/messages.php')?>
    <form action="#" method="post">
        <p class="form-title"><i class="icofont-edit"></i> Editar assunto</p>
        <div class="input-group">
            <?php if($areaChange): ?>
            <?php if(!$selectedArea): ?>
                <div class="form-input form-area">
                    <label for="area"><i class="icofont-beaker"></i> Área</label>
                    <select name="area" class="selectArea">
                        <?php
                        echo "<option value=''>Selecione uma área</option>";
                        foreach($areas as $area){
                            echo "<option value='{$area->id}'>{$area->name}</option>";
                        }
                        ?>
                </select>
            </div>
            <?php endif ?>
            
            <?php if($selectedArea): ?>
            <div class="form-input form-sub-area">
                <label for="sub_areas_id"><i class="icofont-flask"></i> Editar sub-área</label>
                <select name="sub_areas_id" placeholder="Selecione a sub-área" class="selectSubArea">
                    <?php
                        echo "<option value=''>Selecione uma sub-área</option>";
                        foreach($sub_areas as $sub_area){
                            echo "<option value='{$sub_area->id}'>{$sub_area->name}</option>";
                        }
                    ?>
                </select>
            </div>
            <?php endif ?>

            <?php endif ?>
            <!--<input type="hidden" name="selectedArea" value="<?php //$selectedArea->id ?>">  não sei se precisa disso -->
            <?php if(!$areaChange): ?>
            <div class="selected-area">
                <p><i class="icofont-beaker"></i> Área: <?= $assunto->area ?></p>
                <p><i class="icofont-flask"></i> Sub-área: <?= $assunto->sub_area ?></p>
                <a href="editAssunto.php?id=<?= $id ?>&change=1" class="btn-form"><i class="icofont-exchange"></i> Alterar Área e/ou Sub-área</a>
            </div>
            <div class="form-input form-assunto">
                <label for="name"><i class="icofont-electron"></i> Assunto</label>
                <input class="input-assunto" type="text" name="name" placeholder="Digite o nome do assunto..." value="<?= $assunto->assunto ?>">
            </div>
            <div class="form-input form-description">
                <label for="description"><i class="icofont-paper"></i> Descrição</label>
                <input class="input-description" type="text" name="description" placeholder="Coloque a descrição do assunto" value="<?= $assunto->description ?>">
            </div>
            <div class="form-input form-date">
                <label for="date"><i class="icofont-calendar"></i> Data de estudo</label>
                <input class="input-date" type="date" name="date" id="date" value="<?= $assunto->date_revise ?>">
            </div>
            <div class="btn-submit-div">
                <button class="btn-submit" type="submit">Enviar</button>
            </div>
            <?php endif ?>
        </div>
    </form>
</div>
<script src="assets/js/app.js"></script>
</body>