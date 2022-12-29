function exibeAlert(mensagem, isMensagemErro = false) {
    var type = (isMensagemErro) ? 'red' : 'green';
    var title = (isMensagemErro) ? 'Atenção!!' : 'Sucesso!!';
    $.alert({
        theme: 'modern',
        title: title,
        content: mensagem,
        type: type
    });
}

/**
 * EXECUTA CHAMADA AJAX NA URL E PARAMETROS ESPECIFICADOS * 
 * @param String url 
 * @param Array dados 
 * @returns Promisse
 */
function ajaxExecute(url, dados, metodo = 'POST') {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: metodo,
            data: dados,
            url: url,
            dataType: "json",
            success: resolve,
            error: reject,
        });
    });

    //var dados = {id: campo.attr('data-id'),status: campo.attr('data-status')};
    //ajaxExecute('./path/file', dados).then((result) => {
    //    if (!result.erro) {
    //acao
    //    } else {
    // erro true
    //    }
    //});

}

