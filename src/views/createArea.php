<!-- Criar textbox para escrever a área e o botão para criar. Voltar para criar revisão -->

<div class="form-revise">
    <?php require_once(VIEW_TEMPLATE_PATH . '/messages.php')?>
    <form action="#" method="post">
        <p class="form-title"><i class="icofont-beaker"></i> Crie uma nova área</p>
        <div class="input-group">
            <div class="gather-group">
                <div class="create-area">
                    <label for="area"><i class="icofont-beaker"></i> Área</label>
                    <input type="text" name="name" placeholder="Digite o nome da área...">
                </div>
            </div>
            <div class="btn-submit-div">
                <button class="btn-submit" type="submit"><i class="icofont-plus-square"></i> Criar área</button>
            </div>
        </div>
    </form>
</div>