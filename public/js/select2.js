$(document).ready(function () {
// Select2 Single  with Placeholder
$('.select2-single-placeholder').select2({
    placeholder: "Pencarian..",
    allowClear: true,
    ajax: {
      url: '/admin/barangmasuk/select2',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
                return {
                    text: item.nama_barang,
                    id: item.id
                }
            })
        };
      },
      cache: true
    } 
  });

  $('.select-user').select2({
    allowClear: true,
    width: 'resolve',
    ajax: {
      url: '/user/listbarang/listbarangkeluar/select3',
      dataType: 'JSON',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
                return {
                    text: item.nama_barang,
                    id: item.id
                }
            })
        };
      },
    } 
  });
    var count = 0;
    if (count == 0) {
        $('.BtnSave').hide();
    }
    $(".BtnAdd").on('change', function(){
      var daftar = $("#daftar_id").val();
      var qty = $("#Qty").val();
      count +=1;
      $("#krimData").append(
        `<tr>
            <td>`+ count +`</td>
            <td>
              <div class="form-group">
                <input type="text" name="daftar_id[]" class="form-control" value="`+daftar+`">
              </div>
              </td>
              <td>
                <div class="form-group">
                   <input type="number" name="qty[]" value="`+qty+`" class="form-control" width="100%" style="width: 80px;">
                 </div>
               </td>
               <td>
                  <button type="button" class="btn btn-danger btn-sm btnRemove"><i class="fas fa-trash"></i></button>
               </td>
          </tr>
      `);
    if(count > 0){
        $('.BtnSave').show();
    }
      $('.btnRemove').on('click', function(){
       $(this).parents('tr').remove();
    })

    $.ajax({
        url: '/user/listbarang/listbarangkeluar/select3',
        type: 'GET',
        dataType: 'JSON',
        success: function (data){
            $("#showData").val(data);
        }
    });
  });

  $('#simple-date1 .input-group.date').datepicker({
    format: 'dd-mm-yyyy',
    todayBtn: 'linked',
    todayHighlight: true,
    autoclose: true,        
  });

  $('#simple-date4 .input-daterange').datepicker({        
    format: 'yyyy-mm-dd',        
    autoclose: true,     
    todayHighlight: true,   
    todayBtn: 'linked',
  });    
});     