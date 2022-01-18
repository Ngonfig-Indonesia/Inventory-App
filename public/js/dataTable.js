$(document).ready(function () {
    // $('#dataTable').DataTable(); // ID From dataTable 
    $('#dataTableHover').DataTable({
      dom: 'Bfrtip',
         buttons: [
          { extend: 'csv', className: 'btn-primary' },
          { extend: 'excel', className: 'btn-primary' },
          { extend: 'pdf', className: 'btn-primary' },
          { extend: 'print', className: 'btn-primary' },
         ]
    }); // ID From dataTable with Hover
    $('#dataTableHovers').DataTable(); // ID From dataTable with Hover
  });