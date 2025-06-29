

Tusers = $('#tabelaUsuarios').DataTable({
  oLanguage: {
    oPaginate: {
      sNext: "<i class='fa fa-chevron-right estilo-paginacao'></i>",
      sPrevious: "<i class='fa fa-chevron-left estilo-paginacao'></i>",
    },
    sZeroRecords: "Nenhum registro encontrado",
  },
  pagingType: "full_numbers",
  pageLength: 10,
  aaSorting: [[1, "asc"]],
});



function getData(){ 

}

$(document).ready(function() {

    
})