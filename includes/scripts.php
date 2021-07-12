<!-- jQuery 3 -->
<script src="ui-designs/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="ui-designs/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<!-- <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> -->


<script src="ui-designs/data/datatable/js/jquery.datatable.js"></script>
<script src="ui-designs/data/datatable/js/datatable.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<!-- AdminLTE App -->
<script src="ui-designs/bower_components/dist/js/adminlte.min.js"></script>
<!-- SweetAlert -->
<script src="ui-designs/sweetalert/sweetalert.min.js"></script> 

<!-- Data Table Initialize -->
<script>
  $(function () {
    $('#example1').DataTable()
  	var bookTable = $('#booklist').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : false
    })

    $('#searchBox').on('keyup', function(){
    	bookTable.search(this.value).draw();
	});

  })
</script>


<script type="text/javascript">
  /* Navbar ClockDate */

setInterval(startTime, 500);

function startTime() {
    var today = new Date();
    var hr = today.getHours();
    var min = today.getMinutes();
    var sec = today.getSeconds();
    ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
    hr = (hr == 0) ? 12 : hr;
    hr = (hr > 12) ? hr - 12 : hr;
    //Add a zero in front of numbers<10
    hr = checkTime(hr);
    min = checkTime(min);
    sec = checkTime(sec);
    document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec + " " + ap;
    
    var time = setTimeout(function(){ startTime() }, 500);
}
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
</script>

<script>
  $('#searchBox').keyup(function(){
      if(this.value.length ==8){
      $('#submit').click();
      }
  });
</script>​