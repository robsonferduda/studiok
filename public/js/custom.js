$(document).ready(function() {

    $('#nu_cpf_par').mask('000.000.000-00');
    $('#hr_inicio_atp').mask('00:00');
    $('#hr_fim_atp').mask('00:00');
    $('#dt_inicio_eve').mask('00/00/0000', {placeholder: "dd/mm/yyyy"});
    $('#dt_fim_eve').mask('00/00/0000', {placeholder: "dd/mm/yyyy"})
    $('#dt_inicio_atividade_ati').mask('00/00/0000 00:00');
    $('#dt_termino_atividade_ati').mask('00/00/0000 00:00');
    $('#nu_orcid_pes').mask('0000-0000-0000-0000', {placeholder: "0000-0000-0000-0000"});

    var sala = $(this).find(':selected').data('sala');
    if(sala) $(".box-sala").css("display","none"); else $(".box-sala").css("display","block");

    $("#id_tipo_atividade_tia").change(function(){

        var paralelo = $(this).find(':selected').data('paralelo');
        var palestrante = $(this).find(':selected').data('palestrante');
        var sala = $(this).find(':selected').data('sala');

        if(sala) $(".box-sala").css("display","none"); else $(".box-sala").css("display","block");
        if(paralelo) $(".box-paralelo").css("display","block"); else $(".box-paralelo").css("display","none");
        if(palestrante) $(".box-palestrante").css("display","block"); else $(".box-palestrante").css("display","none");

    });

    $('body').on("click", ".button-remove", function(e) {
        e.preventDefault();
        var form = $(this).closest("form");
        Swal.fire({
            title: "Tem certeza que deseja excluir?",
            text: "Você não poderá recuperar o registro excluído",
            type: "warning",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            confirmButtonText: "Sim, excluir!",
            cancelButtonText: "Cancelar"
        }).then(function(result) {
            if (result.value) {
                form.submit();
            }
        });
    }); 

    $('body').on("click", ".button-remove-evento", function(e) {
        e.preventDefault();
        var link = $(this).attr('href');

        Swal.fire({
            title: "Tem certeza que deseja remover a participação neste evento?",
            text: "Você não poderá recuperar o registro excluído",
            type: "warning",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            confirmButtonText: "Sim, excluir!",
            cancelButtonText: "Cancelar"
        }).then(function(result) {
            if (result.value) {
                window.location.href = link;
            }
        });
    });
    
    var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
        removeItemButton: true
    });

    //$(".ps-container").animate({ scrollTop: $('.ps-container').prop("scrollHeight")}, 200);

    //Posiciona a lista de mensagens na última mensagem enviada
    $(".ps-container").scrollTop($('.ps-container').prop("scrollHeight"));

    function atualizaChat(){

        var text = $("#text_chat").val();    
        var atividade = $("#chat-content").data("atividade");
    
        $.ajax({
            url: '../../../atividades/chat/salvar',
               type: 'POST',
               data: {
                    "mensagem_cha": text,
                    "id_atividade_ati": atividade,
                    "_token": $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(response) {

                $(".ps-container > .media-chat").remove();

                $.ajax({
                    url: '../../../atividades/'+atividade+'/chat',
                    type: 'GET',
                    success: function(response) {
                        $.each(response, function( key, value ) {
                            if(value.mensagem){
                                $(".ps-container").append('<div class="media media-chat" style="padding: 0px !important; padding-right: 8px !important;"><div class="media-body"><p class="font-12"><strong>'+value.usuario+'</strong> '+value.mensagem+'</p></div></div>');
                            }
                        });
                        $(".ps-container").scrollTop($('.ps-container').prop("scrollHeight"));
                        //$(".ps-container").animate({ scrollTop: $('.ps-container').prop("scrollHeight")}, 200);
                    }
                });
                
            },
            error: function(response){
                console.log(response);
            }
        });
       
        $("#text_chat").val("");
        $("#text_chat").focus();
    }

    var atividade_inicial = 0;
   
    function refresh(){

        var sala = $('.lbl_sala');
        var atividade = $('.lbl_atividade');
        var hora = $('.lbl_hora');
        
        var id = $("#id_sala_sal").val();

        $.ajax({
            url: '../../../sala/transmissao/atual/'+id,
            type: 'GET',
            success: function(response) {

                var ativ = $("#chat-content").data("atividade");
               
                    var data = new Date();
                    dataAtual = data.toLocaleString();

                    sala.html(response.sala);
                    atividade.html(response.atividade);
                    hora.html(response.data);
                                    
                if(atividade_inicial != response.id_atividade_ati){

                    atividade_inicial = response.id_atividade_ati;

                    $(".ps-container > .media-chat").remove();
                    $.ajax({
                        url: '../../../atividades/'+atividade_inicial+'/chat',
                        type: 'GET',
                        success: function(response) {
                            $.each(response, function( key, value ) {
                                if(value.mensagem){
                                    $(".ps-container").append('<div class="media media-chat" style="padding: 0px !important; padding-right: 8px !important;"><div class="media-body"><p class="font-12"><strong>'+value.usuario+'</strong> '+value.mensagem+'</p></div></div>');
                                }
                            });
                            $(".ps-container").scrollTop($('.ps-container').prop("scrollHeight"));
                        }
                    });
                }
            }
        });

    }

    function atualizaBatePapo(){

        var atividade = $("#chat-content").data("atividade");

        $(".ps-container > .media-chat").remove();

                $.ajax({
                    url: '../../../atividades/'+atividade+'/chat',
                    type: 'GET',
                    success: function(response) {
                        $.each(response, function( key, value ) {
                            if(value.mensagem){
                                $(".ps-container").append('<div class="media media-chat" style="padding: 0px !important; padding-right: 8px !important;"><div class="media-body"><p class="font-12"><strong>'+value.usuario+'</strong> '+value.mensagem+'</p></div></div>');
                            }
                        });
                        $(".ps-container").scrollTop($('.ps-container').prop("scrollHeight"));
                        //$(".ps-container").animate({ scrollTop: $('.ps-container').prop("scrollHeight")}, 200);
                    }
                });

    }

    setInterval(function(){
        atualizaBatePapo()
      }, 5000);

    setInterval(function(){
      refresh()
    }, 10000);

    $(document).on('keypress',function(e) {
        if(e.which == 13) {
            atualizaChat();
        }
    });

    $("body").on("click",".publisher-btn", function(e){
        atualizaChat();
    });

    $('.customer-logos').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });

});