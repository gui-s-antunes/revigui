<div class="form-revise">
    <?php require_once(VIEW_TEMPLATE_PATH . '/messages.php')?>
    <form action="#" method="post">
        <p class="form-title"><i class="icofont-book-mark"></i> Crie um novo assunto</p>
        <div class="input-group">
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
                <a href="createArea.php" class="btn-form"><i class="icofont-plus-square"></i> Criar nova área</a>
            </div>
            <?php endif ?>
            <?php if($selectedArea): ?>
            <div class="selected-area">
                <p><i class="icofont-beaker"></i> Área: <?= $selectedArea->name ?></p>
                <a href="createRevise.php" class="btn-form"><i class="icofont-exchange"></i> Selecionar outra área</a>
            </div>
            <div class="form-input form-sub-area">
                <label for="sub_areas_id"><i class="icofont-flask"></i> Sub-área</label>
                <select name="sub_areas_id" placeholder="Selecione a sub-área" class="selectSubArea">
                    <?php
                        foreach($sub_areas as $sub_area){
                            echo "<option value='{$sub_area->id}'>{$sub_area->name}</option>";
                        }
                    ?>
                </select>
                <a href="createSubArea.php" class="btn-form"><i class="icofont-plus-square"></i> Criar nova sub-área</a>
            </div>
            <div class="form-input form-assunto">
                <label for="name"><i class="icofont-electron"></i> Assunto</label>
                <input class="input-assunto" type="text" name="name" placeholder="Digite o nome do assunto...">
            </div>
            <div class="form-input form-description">
                <label for="description"><i class="icofont-paper"></i> Descrição</label>
                <input class="input-description" type="text" name="description" placeholder="Coloque a descrição do assunto">
            </div>
            <div class="form-input form-date">
                <label for="date"><i class="icofont-calendar"></i> Data de estudo (até 2 anos antes)</label>
                <input class="input-date" type="date" name="date" id="date" min="<?= $dateLimit ?>">
            </div>
            <!-- <div class="form-file">
                <label for="revise_file">Arquivo de texto (opcional; até 5MB)</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="5242880">
                <input type="file" name="revise_file" id="revise_file" accept=".doc,.docx,.txt,.md,.pdf">
                <p>Aceito tipos: doc, docx, .txt, .md, .pdf</p>
            </div> -->
            <div class="btn-submit-div">
                <button class="btn-submit" type="submit"><i class="icofont-save"></i> Enviar</button>
            </div>
            <?php endif ?>
        </div>
    </form>
</div>
<script src="assets/js/app.js"></script>
</body>