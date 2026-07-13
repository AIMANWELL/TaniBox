<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<!-- Chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

$(function(){

if($('#datatable').length){

$('#datatable').DataTable({

responsive:true,

pageLength:10,

language:{

search:"🔍 Cari :",

lengthMenu:"Tampilkan _MENU_ data",

info:"Menampilkan _START_ - _END_ dari _TOTAL_ data",

zeroRecords:"Data tidak ditemukan",

paginate:{

previous:"←",

next:"→"

}

}

});

}

});

</script>

</body>

</html>