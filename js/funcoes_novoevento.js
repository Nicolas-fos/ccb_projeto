var url = window.location.protocol + "//" + window.location.hostname;
function carregaEventos() {

    $.ajax({
        method: "GET",
        dataType: "json",
        url: url +"/evento/list_eventos",
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
        url: url +"/evento/list_eventos?data=" + data_evento,
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
            url: url +"/novo_evento/salvar",
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