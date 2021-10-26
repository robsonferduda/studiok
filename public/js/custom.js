$(document).ready(function() {

    $('#nu_cpf_par').mask('000.000.000-00');
    $('#hr_inicio_atp').mask('00:00');
    $('#hr_fim_atp').mask('00:00');
    $('#dt_inicio_atividade_ati').mask('00/00/0000 00:00');
    $('#dt_termino_atividade_ati').mask('00/00/0000 00:00');
    $('#nu_orcid_pes').mask('0000-0000-0000-0000', {placeholder: "0000-0000-0000-0000"});

    $("#id_tipo_atividade_tia").change(function(){

        var paralelo = $(this).find(':selected').data('paralelo');
        var palestrante = $(this).find(':selected').data('palestrante');

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
});