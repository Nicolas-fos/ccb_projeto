<?php
$this->layout('_template') ?>



<form id="frm-dados">

    <title>Novo Evento</title>
    <br>
    <div class="form-row">
        <div class="col-12 col-lg-4">
            <label>Dia:</label>
            <input type="date" name="dia" id="dia" class="form-control" />
        </div>
        <div class="col-12 col-lg-4">
            <label>Hora:</label>
            <input type="time" name="hora" id="hora" class="form-control" />
        </div>

    </div><br>
    <div class="form-row">
        <div class="col-12 col-lg-2">
            <label>Tipo do serviço</label>
            <?php
            echo "<select id='servico' name='servico' style='border-radius:5px'>";
            foreach ($listServicos as $item) {
                echo "<option name='$'value='$item->nome'>$item->nome</option>";
            }
            echo "</select>"; ?>
        </div>
    </div><br>
    <div class="form-row">
        <div class="col-12 col-lg-12">
            <label>Comum congregação</label>
        </div>
        <?php
        echo "<select id='comum' name='comum' style='border-radius:5px'>";
        foreach ($listComuns as $item) {
            echo "<option name='$'value='$item->nome - $item->cidade'>$item->nome - $item->cidade</option>";
        }
        echo "</select>"; ?>
    </div><br>

    <div class="form-row">
        <div class="col-12 col-lg-2">
            <label>Quem irá atender</label>
            <input type="text" name="atendente" id="atendente" />
        </div>
    </div><br>
    <div class="form-row">
        <button type="button" id="bt-salvar" style="border-radius: 5px; padding: 10px;font-size: 15px;">salvar</button>
        <button type="button" id="bt-cancelar" style="border-radius: 5px; padding: 10px;font-size: 15px;margin-left: 10px;">Cancelar</button>
    </div>
</form>
<?= $this->start('js'); ?>
<script>
    $(document).ready(function() {
        $('#bt-salvar').click(function() {
            salvar();
        });

        $("#frm-dados").validate({
            // Define as regras
            rules: {
                servico: {
                    required: true
                },
                dia: {
                    required: true
                },
                hora: {
                    required: true
                },
                atendente: {
                    required: true
                },
                messages: {
                    servico: "Informe o Serviço",
                    dia: "Informe o Dia",
                    hora: "Informe a hora",
                    atendente: "Informe irmão que ira atender",
                },

                errorElement: "em",
                errorPlacement: function(error, element) {
                    //console.log(element);   
                    element.addClass("frm_error");

                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                    } else {
                        error.insertAfter(element);
                    }

                },
                success: function(label, element) {
                    $(element).removeClass("frm_error");
                }
            }
        });

    });

    function salvar() {
        var formArray = $('#frm-dados').serialize();
        if ($("#frm-dados").validate().form()) {
            $.ajax({
                method: "post",
                data: formArray,
                dataType: "json",
                url: "novo_evento/salvar",
                error: function(result) {
                    exibeAlert(result.responseJSON.message, true);
                }
            }).done(function(result) {
                if (!result.isError) {
                    alert("Evento salvo com sucesso!");
                    $("#frm-dados").reset();
                }
                exibeAlert(result.message, result.isError);
            });
        }
    }
</script>
<?= $this->stop();
