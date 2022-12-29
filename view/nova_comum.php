<?php
$this->layout('_template') ?>

<title>Nova Comum</title>

<form>
    <br>
    <div class="form-collun">
        <div class="col-12 col-lg-12">
            <label>Cidade</label>
        </div>
        <?php
        echo "<select style='border-radius:10px'>";
        foreach ($listCidade as $item) {
            echo "<option name='$' value='$item->nome'>$item->nome</option>";
        }
        echo "</select>"; ?>
    </div><br>
    <div class="form-collun">
        <div class="col-12 col-lg-2">
            <label>Nome</label>
            <input type="text" name="nome_comum" id="nome_comum" />
        </div>
    </div><br>
    <div class="form-collun">
        <div class="col-12 col-lg-2">
            <label>Endereço</label>
            <input type="text" name="endereco_comum" id="endereco_comum" />
        </div>
    </div><br>
</form>