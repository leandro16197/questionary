$(document).ready(function () {
    console.log("Usuario logueado:", usuario);
    $('.table-dataTable-ranking').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/ranking/datos",
            type: 'GET'
        },
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
        },
        pageLength: 10,
        responsive: true,
        columns: [
            { data: 'username', name: 'username' },
            { data: 'name', name: 'name' },
            { data: 'points', name: 'points' }
        ],
        createdRow : function(row,data,dataIndex){
            if(data.username===usuario){
                $(row).addClass('points-user'); 
            }
        }
    });
});
