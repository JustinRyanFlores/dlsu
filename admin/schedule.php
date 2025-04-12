<?php 
  session_start();
  include '../config/config.php';
  class data extends Connection{ 
    public function managedata(){ 
?>
<!DOCTYPE html>
<html>
<head><?php include 'head.php'; ?>
  
 <style>
  .fc-day-header {
    padding-bottom: 15px !important;
    
}
.custom-day-header {
    background-color: #ff6a00 !important;
    border: 5px solid #000 !important;
    padding-top: 5px !important;
    padding-bottom: 15px !important; /* Adjust the spacing as needed */
}

.custom-day-header::after {
    content: ''; /* Add a pseudo-element for the white bottom border */
    display: block;
    width: 100%;
    height: 5px;
    background-color: white;
    position: absolute;
    bottom: 0;
}

td.fc-day-top {
    padding-right: 20px;
}

.fc-ltr .fc-basic-view .fc-day-top .fc-day-number{
  margin-right: 10px;
}

td.fc-event-container{
  padding: 20px !important;
}
.fc-content {
    padding: 10px !important;
    text-align: center;
}

html{
  overflow-x: none !important;
}
 </style>

<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php include 'navbar.php'; ?>
    <?php include 'profile.php'; ?>
    <?php include 'sidebar.php'; ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
           Farming Supplies
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Farming Supplies</li>
        </ol>
      </section>
      <div class="row">
        <div class="col-lg-8 col-md-12">
          <section class="content-header">
            <h1>
               Calendar Chart
            </h1>
          </section>
          <section class="content">
            <div class="row">
              <div class="col-xs-12">
                <div class="box">
                  <div class="box-header with-border">
                     <a href="#addnewschedule" data-toggle="modal" class="btn btn-success btn-sm btn-flat custom-btn"><i class="fa fa-calendar"></i> Set Schedule</a> 
                     <a href="schedulehistory.php" class="btn btn-success btn-sm btn-flat custom-btn"><i class="fa fa-eye"></i> Schedule History</a>
                     <a href="print4.php" target="_blank" class="btn btn-success btn-sm btn-flat custom-btn"><i class="fa fa-pdf"></i> Print Or Download</a> 
                  </div>
                  <div class="box-body table-responsive" style="overflow-x: hidden;">
                    <div id="calendar" style="overflow-x: none;"></div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
      
      
      
    </div>
  </div>
  <?php include 'footer.php'; ?>
  <?php include 'modal/scheduleModal.php'; ?>
  <script>
    $(document).on('click', '.edit', function(e){
      e.preventDefault();
      $('#edit').modal('show');
      var edit_schedule_id = $(this).data('edit_schedule_id');
      var edit_date = $(this).data('edit_date');

      $('#edit_schedule_id').val(edit_schedule_id)
      $('#edit_date').val(edit_date)
    });
  </script>
  <script>
    $(document).on('click', '.edit2', function(e){
      e.preventDefault();
      $('#edit2').modal('show');
      var edit_supplies_id = $(this).data('edit_supplies_id');
      var edit_name = $(this).data('edit_name');
      var edit_description = $(this).data('edit_description');
      var edit_hectare = $(this).data('edit_hectare');
      var edit_stock = $(this).data('edit_stock');

      $('#edit_supplies_id').val(edit_supplies_id)
      $('#edit_name').val(edit_name)
      $('#edit_description').val(edit_description)
      $('#edit_hectare').val(edit_hectare)
      $('#edit_stock').val(edit_stock)
    });
    

    $(document).on('click', '.delete2', function(e){
      e.preventDefault();
      $('#delete2').modal('show');
      var delete_supplies_id = $(this).data('delete_supplies_id');

      $('#delete_supplies_id').val(delete_supplies_id)
    });
  </script>
  <script>
    $(document).on('click', '.edit3', function(e){
      e.preventDefault();
      $('#edit3').modal('show');
      var edit_inventory_id = $(this).data('edit_inventory_id');
      var edit_name3 = $(this).data('edit_name3');

      $('#edit_inventory_id').val(edit_inventory_id)
      $('#edit_name3').val(edit_name3)
    });

    $(document).on('click', '.delete3', function(e){
      e.preventDefault();
      $('#delete3').modal('show');
      var delete_inventory_id = $(this).data('delete_inventory_id');

      $('#delete_inventory_id').val(delete_inventory_id)
    });
  </script>
  <script>
    $(document).on('click', '.use3', function(e){
      e.preventDefault();
      $('#use3').modal('show');
      var use_inventory_id = $(this).data('use_inventory_id');
      var use_name3 = $(this).data('use_name3');

      $('#use_inventory_id').val(use_inventory_id)
      $('#use_name3').val(use_name3)
    });
  </script>
</body>
</html>


<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
<?php include 'modal/scheduleModal2.php'; ?>

<script>
$(document).ready(function() {
  display_events();
}); // end document.ready block

function display_events() {
  var events = new Array();
  $.ajax({
    url: '../dynamic_event_calendar/display_event.php',  
    dataType: 'json',
    success: function (response) {
      var result = response.data;
      $.each(result, function (i, item) {
        events.push({
          schedule_id: result[i].schedule_id,
          title: result[i].title,
          start: result[i].start,
          end: result[i].end,
          hectare: result[i].hectare,
          type: result[i].type,
          select2: result[i].select2,
          total: result[i].total,
          color: result[i].color,
          url: result[i].url
        });   
      });



      // Initialize FullCalendar
      var calendar = $('#calendar').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        dayNamesShort: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        defaultView: 'month',
        timeZone: 'local',
        editable: true,
        selectable: true,
        selectHelper: true,

        // Handle date selection to show modal
        select: function(start, end) {
          // Clear the fields before populating
          
          // $('#addnewschedule').modal('show');
          // $('#edit_title').val('');
          // $('#edit_start_date').val('');
          // $('#edit_end_date').val('');

          // // Populate the modal with the selected dates
          // $('#edit_start_date').val(moment(start).format('YYYY-MM-DD'));
          // $('#edit_end_date').val(moment(end).format('YYYY-MM-DD'));

          // Show the modal
        },

        // Handle event click to edit event
        eventRender: function(event, element) { 
          element.bind('click', function() {
            // Populate the modal with event data
            $('#edit_schedule_id2').val(event.schedule_id);
            $('#edit_title').val(event.title);
            $('#edit_start_date').val(moment(event.start).format('YYYY-MM-DD'));
            $('#edit_end_date').val(moment(event.end).format('YYYY-MM-DD'));
            $('#edit_hectare2').val(event.hectare);
            $('#edit_type2').val(event.type);
            $('#edit_select2').val(event.select2);
            $('#edit_total').val(event.total);

        
            // Show the edit modal
            $('#editschedule').modal('show');
          });
        },

        events: events, // Load events

        // Customize the appearance of day cells
        dayRender: function (date, cell) {
          cell.css({
            'border-color': 'white',
            'outline': '5px solid #fff',
            'background-color': '#ecf0f5',
            'border': '5px solid #fff'
          });
        },

        // Customize week header
        viewRender: function(view, element) {
          var dayHeaders = $('.fc-day-header');
          dayHeaders.each(function(index) {
            $(this).addClass('custom-day-header')
              .css({
                'background-color': '#ff6a00',
                'outline': '5px solid #fff',
                'padding-top': '5px',
                'padding-bottom': '5px'
              });
          });
        }
      }); // end fullCalendar block
    }, // end success block
    error: function (xhr, status) {
      alert("Error loading events: " + status);
    }
  }); // end ajax block 
}
</script>
<?php } } $data = new data(); $data->managedata(); ?>