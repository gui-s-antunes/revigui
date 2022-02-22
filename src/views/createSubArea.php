<div class="form-revise">
    <?php require_once(VIEW_TEMPLATE_PATH . '/messages.php')?>
    <form action="#" method="post">
        <p class="form-title">Crie uma nova subárea</p>
        <div class="input-group">
            <div class="form-area">
                <select name="area" class="selectArea">
                    <?php
                        foreach($areas as $area){
                            echo "<option value='{$area->id}'>{$area->name}</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="gather-group sub-area-space">
                <div class="create-subarea">
                    <label for="name"><i class="icofont-flask"></i> Criar sub-área</label>
                    <input type="text" name="name" placeholder="Digite o nome da Sub-área...">
                </div>
            </div>
            <div class="btn-submit-div">
                <button class="btn-submit" type="submit">Criar Sub-área</button>
            </div>
        </div>
    </form>
</div>
</body>