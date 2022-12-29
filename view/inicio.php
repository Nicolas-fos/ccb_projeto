<?= $this->layout('_template') ?>

<div id='calendario'></div>
<br />
<br />
<div id="teste">

</div>
<?= $this->start('js'); ?>

<script>
    $(document).ready(function() {

        carregaEventos();
        $("#teste").slideUp();
    });

    function carregaEventos() {

        $.ajax({
            method: "GET",
            dataType: "json",
            url: "<?= URL ?>/evento/list_eventos",
            error: function(result) {
                //exibeAlert(result.responseJSON.message, true);
                console.log('Error', result);
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
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                buttonText: {
                    today: 'hoje',
                    month: 'mês',
                    week: 'semana',
                    day: 'dia',

                },
                select: function(info) {
                    $("#teste").slideDown();
                    $("#teste").html('');
                    //$("#teste").append(info.startStr);
                    var data_pesquisa = info.startStr;
                    listaEventosDia(data_pesquisa);
                },
                events: result,

            });
            console.log('eventos', result);
            calendar.setOption('locale', 'pt-br');
            calendar.render();

        })
        // requicao ajax
    }

    function listaEventosDia(data_evento) {

        var dados =[];

        $.ajax({
            method: "GET",
            dataType: "json",
            url: "<?= URL ?>/evento/list_eventos?data="+data_evento,
            error: function(result) {
                console.log('Error', result);
            }
        }).done(function(result) {

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