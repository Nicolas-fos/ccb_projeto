<?php
$this->layout('_template') ?>

<div id='calendario'></div>
<div class="modal fade" id="modal-list" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <table class="table table tb-list">
                <thead>
                    <tr>
                        <th>Serviços do Dia</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <button class="btn btn-primary" type="button" id="new-evento">Adicionar Evento</button>

            <form id="frm-dados">
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

                </div>
                <div class="form-row">
                    <div class="col-5 col-lg-2">
                        <label>Tipo do serviço</label>
                        <?php
                        echo "<select id='servico' name='servico' style='border-radius:5px'>";
                        foreach ($listServicos as $item) {
                            echo "<option name='$'value='$item->nome'>$item->nome</option>";
                        }
                        echo "</select>"; ?>
                    </div>
                </div>
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
                </div>

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



        </div>

    </div>
</div>

<?= $this->start('js'); ?>
<script>
    $(document).ready(function() {

        $('#frm-dados').slideUp();

        carregaEventos();

        $('#new-evento').click(function(){
                $("#frm-dados").slideDown();
            });
       

        $('#bt-salvar').click(function() {
            salvar();
        });
        $('#bt-cancelar').click(function() {
            resetRequenteInputs();
            $('#frm-dados').slideUp();
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

    function carregaEventos() {

        $.ajax({
            method: "GET",
            dataType: "json",
            url: "<?= URL ?>/evento/list_eventos",
            error: function(result) {}
        }).done(function(result) {
            var calendarEl = document.getElementById('calendario');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                dayMaxEventRows: true, // for all non-TimeGrid views
                selectable: true,
                views: {
                    timeGrid: {
                        dayMaxEventRows: 3 // adjust to 6 only for timeGridWeek/timeGridDay
                    }
                },
                buttonText: {
                    today: 'hoje',

                },
                select: function(info) {

                    var data_pesquisa = info.startStr;
                    listaEventosDia(data_pesquisa);
                    $("#dia").val(info.startStr);
                    
                },
                events: result,

            });
            calendar.setOption('locale', 'pt-br');
            calendar.render();

        })
    }


    function listaEventosDia(data_evento) {

        var dados = [];

        $.ajax({
            method: "GET",
            dataType: "json",
            url: "<?= URL ?>/evento/list_eventos?data=" + data_evento,
            error: function(result) {
                console.log(result);
            }
        }).done(function(result) {
            console.log(result);
            var html = ``;
            if (result.length == 0) {
                html += `<tr >`
                html += `<td colspan="4" style="text-align:center;">Nenhum registro encontrado</td>`;
                html += `</tr>`
            } else {

                result.map(function(item) {
                    html += `<tr style="background-color:#F0F8FF;">`
                    html += `<td>${item.title}</td>`;
                    html += `<td>${item.start}</td>`;
                    html += `<td>${item.hora}</td>`;
                    html += `<td>${item.comum}</td>`;
                    html += `<td>${item.atendente}</td>`;
                    html += `<td>${item.id}</td>`;
                    html += `<td>${item.id}</td>`;
                  
                });
            }
            $('#frm-dados').slideUp();
            $('#modal-list').modal('show');
            $(".tb-list tbody").html('');
            $(".tb-list tbody").append(html);
        })

    }
    function resetRequenteInputs(){
        $("#dia").val("");
        $("#hora").val("");
        $("#servico").val("");
        $("#comum").val("");
        $("#atendente").val("");

    }

    function salvar() {
        var formArray = $('#frm-dados').serialize();
        if ($("#frm-dados").validate().form()) {
            $.ajax({
                method: "POST",
                data: formArray,
                dataType: "json",
                url: "<?= URL ?>/novo_evento/salvar",
                error: function(result) {
                    exibeAlert(result.responseJSON.message, true);
                }
            }).done(function(result) {
                if (!result.isError) {
                    alert("Evento salvo com sucesso!");
                    $("#frm-dados").reset();
                    $('#frm-dados').slideUp();
                }
                exibeAlert(result.message, result.isError);
            });
        }
    }
</script>
<?= $this->stop();
