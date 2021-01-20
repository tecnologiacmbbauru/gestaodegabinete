
$('#modalExclusao').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 

    var id_exclusao = button.data('id_exclusao') 
    var modal = $(this)

    modal.find('.modal-body #id_exclusao').val(id_exclusao);
})

