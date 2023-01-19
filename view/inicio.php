<?= $this->layout('_template') ?>
<div style="align-items: center;">
<div class="container" style="display: flex;flex-direction: row;">
    <div class="botao" >
    <button id="btn-ministerio" data="MN" >Ministerio</button>
    </div>
    <div class="botao" style="margin-left: 10px;">
    <button id="btn-mocidade" data="MM" >Mocidade/Irmandade</button>
    </div>
    <div class="botao" style="margin-left: 10px;">
    <button id="btn-reunioesgerais" data="ADM" >Administração</button>
    </div>
</div><br>


<div id='calendario'></div>
<br />
<br />
<div class="modal fade" id="modal-list" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="width: 130%;">
            <table class="table table tb-list">
                <thead class="thead-dark">

                    <tr>
                        <th style="width: 20%;">Serviço</th>
                        <th>Dia</th>
                        <th>Hora</th>
                        <th style="width: 30%;">Comum</th>
                        <th>Atendimento</th>
                        <!-- <th>Editar</th> -->
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
</div>
<?= $this->start('js'); ?>

<script>
    $(document).ready(function() {

        carregaEventos();
        $("#teste").slideUp();
        $(".tb-list").slideUp();

    });

    function carregaEventos() {

        $.ajax({
            method: "GET",
            dataType: "json",
            url: "<?= URL ?>/evento/list_eventos",
            error: function(result) {
                //exibeAlert(result.responseJSON.message, true);

            }
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
                },
                events: result,

            });
            calendar.setOption('locale', 'pt-br');
            calendar.render();

        })
        // requicao ajax
    }




    function listaEventosDia(data_evento) {
        $(".tb-list").slideDown();
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
                    html += `<tr>`
                    html += `<td>${item.title}</td>`;
                    html += `<td>${item.start}</td>`;
                    html += `<td>${item.hora}</td>`;
                    html += `<td>${item.comum}</td>`;
                    html += `<td>${item.atendente}</td>`;
                });
            }
            $('#modal-list').modal('show');
            $(".tb-list tbody").html('');
            $(".tb-list tbody").append(html);
        })

    }
</script>
<style>
    #calendario {
        width: 70%;
        margin: 0px auto;
    }
</style>


<?= $this->stop(); ?>