/* $(function () {
 
 // Atribui evento e função para limpeza dos campos
 $('#texto').on('input', limpaCampos);
 
 // Dispara o Autocomplete a partir do segundo caracter
 $("#texto").autocomplete({
 minLength: 2,
 source: function (request, response) {
 $.ajax({
 url: "../sources/pesquisaCliente.php",
 dataType: "json",
 data: {
 acao: 'autocomplete',
 parametro: $('#texto').val()
 },
 success: function (data) {
 response(data);
 }
 });
 },
 focus: function (event, ui) {
 $("#texto").val(ui.item.nome);
 carregarDados();
 return false;
 },
 select: function (event, ui) {
 $("#texto").val(ui.item.name);
 return false;
 }
 })
 .autocomplete("instance")._renderItem = function (ul, item) {
 return $("<li>")
 .append("<a><b>Nome: </b>" + item.nome + "</a><br>")
 .appendTo(ul);
 };
 
 // Função para carregar os dados da consulta nos respectivos campos
 function carregarDados() {
 var busca = $('#texto').val();
 
 if (busca != "" && busca.length >= 2) {
 $.ajax({
 url: "../sources/pesquisaCliente.php",
 dataType: "json",
 data: {
 acao: 'consulta',
 parametro: $('#texto').val()
 },
 success: function (data) {
 $('#name').val(data[0].nome);
 $('#cod').val(data[0].cod);
 $('#tipo').val(data[0].tipo_cliente);
 }
 });
 }
 }
 
 // Função para limpar os campos caso a busca esteja vazia
 function limpaCampos() {
 var busca = $('#name').val();
 
 if (busca == "") {
 $('#name').val('');
 $('#cod').val('')
 $('#tipo').val('');
 }
 }
 }); */

$("#tipo_seguro").change(function () {
    var $this, secao, atual, campos;

    campos = $("div[data-name]");

    campos.addClass("hide");

    if (this.value !== "") {
        secao = $('option[data-section][value="' + this.value + '"]', this).attr("data-section");

        atual = campos.filter("[data-name=" + secao + "]");

        if (atual.length !== 0) {
            atual.removeClass("hide");
        }
    }
});

$("#tipo_bem").change(function () {
    var $this, secao, atual, campos;

    campos = $("div[data-name]");

    campos.addClass("hide");

    if (this.value !== "") {
        secao = $('option[data-section][value="' + this.value + '"]', this).attr("data-section");

        atual = campos.filter("[data-name=" + secao + "]");

        if (atual.length !== 0) {
            atual.removeClass("hide");
        }
    }
});


$('#select').change(function () {
    if ($('#formPF').prop('checked')) {
        $('#PF').show();
        $('#PJ').hide();
    } else {
        $('#PJ').show();
        $('#PF').hide();
    }
});

$(document).ready(function () {

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#estado").val("");

    }

    //Quando o campo cep perde o foco.
    $("#cep").blur(function () {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#rua").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#estado").val("...");


                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#rua").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#estado").val(dados.uf);

                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
});

$(document).ready(function () {

    function limpa_formulário_cep() {
        // Limpa valores do formulário de PJ cep.
        $("#ruaPJ").val("");
        $("#bairroPJ").val("");
        $("#cidadePJ").val("");
        $("#estadoPJ").val("");

    }

    //Quando o campo cep perde o foco.
    $("#cepPJ").blur(function () {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#ruaPJ").val("...");
                $("#bairroPJ").val("...");
                $("#cidadePJ").val("...");
                $("#estadoPJ").val("...");


                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#ruaPJ").val(dados.logradouro);
                        $("#bairroPJ").val(dados.bairro);
                        $("#cidadePJ").val(dados.localidade);
                        $("#estadoPJ").val(dados.uf);

                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
});

/*$(function () {
 $('#formCadBem').submit(function () {
 $("#status").html("<img src='../img/loader.gif' alt='Enviando' />");
 $("#status").slideDown();
 $.ajax({
 url: '../production/salvaBem.php',
 type: 'POST',
 data: ('#formCadBem').serialize(),
 success: function (data) {
 $("#status").html("");
 $('#resposta').html(data);
 $('#formCadBem').val("");
 }
 })
 return false;
 });
 });*/
jQuery(document).ready(function () {

    jQuery('#formCadBem').submit(function () {
        $("#status").html("<img src='../img/loader.gif' alt='Enviando' />");
        $("#status").slideDown();
        var dados = jQuery(this).serialize();

        jQuery.ajax({
            type: "POST",
            url: "../sources/salvaBem.php",
            data: dados,
            success: function (data) {
                $("#status").html("");
                $('#resposta').html(data);
                $('#formCadBem').val("");
            }
        });

        return false;
    });
});

jQuery(document).ready(function () {

    jQuery('#formCadSeguro').submit(function () {
        var dados = jQuery(this).serialize();

        jQuery.ajax({
            type: "POST",
            url: "../sources/salvaSeguro.php",
            data: dados,
            success: function (data) {
                $('#formCadSeguro').val("");
                $('#resposta').html(data);
            }
        });

        return false;
    });
});

jQuery(document).ready(function () {

    jQuery('#FormRenovaSeguro').submit(function () {
        var dados = jQuery(this).serialize();

        jQuery.ajax({
            type: "POST",
            url: "../sources/salvaSeguro.php?action=2",
            data: dados,
            success: function (data) {
                $('#resposta').html(data);
            }
        });

        return false;
    });
});

$("#cnpj").focusout(function () {
    //Início do Comando AJAX
    var cnpj = $(this).val().replace(/\D/g, '');

    $("#PJ #razao").val('Carregando...');
    $("#PJ #name").val('Carregando...');
    $("#PJ #final").val('Carregando...');
    $("#PJ #tel").val('Carregando...');
    $("#PJ #cepPJ").val('Carregando...');
    $("#PJ #ruaPJ").val('Carregando...');
    $("#PJ #num").val('Carregando...');
    $("#PJ #bairroPJ").val('Carregando...');
    $("#PJ #estadoPJ").val('Carregando...');
    $("#PJ #cidadePJ").val('Carregando...');

    $.ajax({

        //O campo URL diz o caminho de onde virá os dados
        //É importante concatenar o valor digitado no CNPJ
        url: '../sources/cnpj.php?cnpj=' + cnpj,
//Atualização: caso use java, use cnpj.jsp, usando o outro exemplo.
        //Aqui você deve preencher o tipo de dados que será lido,
        //no caso, estamos lendo JSON.
        dataType: 'json',
        //SUCESS é referente a função que será executada caso
        //ele consiga ler a fonte de dados com sucesso.
        //O parâmetro dentro da função se refere ao nome da variável
        //que você vai dar para ler esse objeto.
        success: function (resposta) {
            //Confere se houve erro e o imprime
            if (resposta.status == "ERROR") {
                alert(resposta.message + "\nPor favor, digite os dados manualmente.");
                $("#PJ #name").focus().select();
                return false;
            }
            //Agora basta definir os valores que você deseja preencher
            //automaticamente nos campos acima.
            $("#PJ #razao").val(resposta.nome);
            $("#PJ #name").val(resposta.fantasia);
            $("#PJ #final").val(resposta.atividade_principal[0].text + " (" + resposta.atividade_principal[0].code + ")");
            $("#PJ #tel").val(resposta.telefone);
            $("#PJ #cepPJ").val(resposta.cep);
            $("#PJ #ruaPJ").val(resposta.logradouro);
            $("#PJ #num").val(resposta.numero);
            $("#PJ #bairroPJ").val(resposta.bairro);
            $("#PJ #estadoPJ").val(resposta.uf);
            $("#PJ #cidadePJ").val(resposta.municipio);
        }
    });
});

$('document').ready(function () {

    $("#btn-login").click(function () {
        var data = $("#login-form").serialize();

        $.ajax({
            type: 'POST',
            url: 'sources/loginValidate.php',
            data: data,
            dataType: 'json',
            beforeSend: function ()
            {
                $("#btn-login").html('Validando ...');
            },
            success: function (response) {
                if (response.codigo == "1") {
                    $("#btn-login").html('Entrar');
                    $("#login-alert").css('display', 'none')
                    window.location.href = "production/index.php";
                } else {
                    $("#btn-login").html('Entrar');
                    $("#login-alert").css('display', 'block')
                    $("#mensagem").html('<strong>Erro! </strong>' + response.mensagem);
                }
            }
        });
        return false;
    });

});

 $('document').ready(function(){ 
     $('#login').blur(function(){ 
         var username = $(this).val(); 
         $.ajax ({ 
             url :"../sources/valida_username.php", 
             method: "POST", 
             data : {login :username }, 
             dataType : "text", 
             success:function(html) { 
                 $('#response').html(html);
                 if(html != ''){
                     $('#novo_user').prop('disabled', true);
                     $('#login').val("");
                 } else{
                     $('#novo_user').prop('disabled', false);
                 }
             } 
         }); 
     }); 
 }); 