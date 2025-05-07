<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

		<title>Laravel</title>
    
		<!-- Fonts -->
		<link rel="preconnect" href="https://fonts.bunny.net">
		<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">

		<!-- Styles / Scripts -->
		@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
			@vite(['resources/css/app.css', 'resources/js/app.js'])
		@else
			<style>
			</style>
		@endif
		<livewire:styles />
		<wireui:scripts />
		<livewire:scripts />

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
    <script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
    <script>
      var calendar = null;

      document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar')

        // Initialize the calendar
        calendar = new FullCalendar.Calendar(calendarEl, {
          events: '{{ route('booking.array') }}',
          initialView: 'dayGridMonth',
          editable: true,
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
          },
          dateClick: function(info) {
            setDefaultDate(info.date, datefns.addMinutes(info.date, 30));
            $('#event-modal').removeClass('hidden');
          },
          eventClick: function(info) {
            const event = info.event;

            $('#title').val(event.title);
            $('#eventID').val(event.id);
            $('#description').val(event.extendedProps.description);
            $('#isAllDay').prop('checked', event.allDay); 
            
            setDefaultDate(event.start, event.end, event.allDay);
            
            if (event.allDay) {
              initializeStartDateEndDateFormat('Y-m-d', true);
            } else {
              initializeStartDateEndDateFormat('Y-m-d H:i', false);
            }

            $('#deleteButtonContainer').removeClass('hidden');
            $('#event-modal').removeClass('hidden');
          },
          eventDrop: function(info) {
            updateEventOnDrop(info.event);
          },
          eventResize: function(info) {
            updateEventOnDrop(info.event);
          }
        });

        // Render the calendar
        calendar.render();

        // Initialize allDay checkbox
        $('#isAllDay').change(function() {
          let isAllDay = $(this).prop('checked');
          if (isAllDay) {
            let start = $('#startDateTime').val().slice(0, 10);
            $('startDateTime').val(start);
            let end = $('#endDateTime').val().slice(0, 10);
            $('endDateTime').val(end);
            initializeStartDateEndDateFormat('Y-m-d', isAllDay);
          } else {
            let start = $('#startDateTime').val().slice(0, 10);
            $('#startDateTime').val(start + " 00:00");
            let end = $('#endDateTime').val().slice(0, 10);
            $('#endDateTime').val(end + " 00:30");
            initializeStartDateEndDateFormat('Y-m-d H:i', isAllDay);
          }
        });
      })

      // Initialize date picker
      function initializeStartDateEndDateFormat(format, allDay) {
        let timePicker = !allDay;
        $('#startDateTime').datetimepicker({
          format: format,
          timePicker: timePicker,
        });
        $('#endDateTime').datetimepicker({
          format: format,
          timePicker: timePicker,
        });
      }

      // Set default date
      function setDefaultDate(startingDate, endingDate, allDay) {
        let startDate, endDate;
        let isAllDay = allDay ?? $('#isAllDay').prop('checked');
        if (isAllDay) {
          startDate = datefns.format(startingDate, 'yyyy-MM-dd');
          endDate = datefns.format(endingDate, 'yyyy-MM-dd');
          initializeStartDateEndDateFormat('Y-m-d', true);
        } else {
          startDate = datefns.format(startingDate, 'yyyy-MM-dd HH:mm:ss');
          endDate = datefns.format(endingDate, 'yyyy-MM-dd HH:mm:ss');
          initializeStartDateEndDateFormat('Y-m-d H:i', false);
        }
        $('#startDateTime').val(startDate);
        $('#endDateTime').val(endDate);
      }

      // Update event on drop when dragged and resized
      function updateEventOnDrop(updatedEvent) {
        let eventID = updatedEvent.id;
        let url = '/v1/api/booking/' + eventID;

        let data = {
          is_all_day: updatedEvent.extendedProps.is_all_day,
          title: updatedEvent.title,
          description: updatedEvent.extendedProps.description,
          _method: "PUT",
        }

        if (updatedEvent.extendedProps.is_all_day) {
          data.start = datefns.format(updatedEvent.start, 'yyyy-MM-dd');
          data.end = datefns.format(updatedEvent.end, 'yyyy-MM-dd');
        } else {
          data.start = datefns.format(updatedEvent.start, 'yyyy-MM-dd HH:mm:ss');
          data.end = datefns.format(updatedEvent.end, 'yyyy-MM-dd HH:mm:ss');
        }

        $.ajax({
          type: 'POST',
          url: url,
          dataType: 'json',
          data: data,
          success: function(res) {
            console.log(res)
            if (res.success) {
              calendar.refetchEvents();
              closeModal();
              resetModal();
            } else {
              alert('Something went wrong', res.message); 
            }
          }
        })
      }

    </script>
	</head>
	<body>
		<x-topbar />
		
    <div class="py-8 px-32">
      <div class="card">
        <div class="card-body">
          <div id="calendar"></div>
        </div>
      </div>
    </div>

    <div 
      id="event-modal" 
      class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden"
    >
      <div id="event-modal-content" class="bg-white rounded-lg p-6 w-full max-w-md shadow-xl relative">
        <!-- Close button -->
        <button 
          onclick="closeModal()" 
          class="absolute top-2 right-2 text-gray-500 hover:text-gray-700"
        >
          &times;
        </button>
    
        <h2 class="text-xl font-semibold mb-2">Book a schedule</h2>

        <div class="text-gray-700 flex flex-col items-start gap-2">
          <p>Fill up the form</p>
          
          <form action="/v1/api/booking" method="POST" class="w-full space-y-2">
            @csrf
            <fieldset class="fieldset w-full">
              <legend class="fieldset-legend">Title</legend>
              <input id="title" name="title" class="input w-full" type="text" placeholder="Type here" >
              @error('title')
                <x-error-message>{{ $message }}</x-error-message>
              @enderror
            </fieldset>
  
            <fieldset class="flex items-center gap-2">
              <label for="isAllDay">All day</label>
              <input type="hidden" name="isAllDay" value="0">
              <input id="isAllDay" name="isAllDay" type="checkbox" value="1"> 
              @error('isAllDay')
                <x-error-message>{{ $message }}</x-error-message>
              @enderror
            </fieldset>
  
            <fieldset class="fieldset w-full">
              <legend class="fieldset-legend">Start Date</legend>
              <input id="startDateTime" name="startDateTime" class="input w-full" type="text" placeholder="Start date" >
              @error('startDateTime')
                <x-error-message>{{ $message }}</x-error-message>
              @enderror
            </fieldset>
  
            <fieldset class="fieldset w-full">
              <legend class="fieldset-legend">End Date</legend>
              <input id="endDateTime" name="endDateTime" class="input w-full" type="text" placeholder="End date" >
              @error('endDateTime')
                <x-error-message>{{ $message }}</x-error-message>
              @enderror
            </fieldset>
  
            <fieldset class="fieldset w-full">
              <legend class="fieldset-legend">Description</legend>
              <input id="description" name="description" class="input w-full" type="text" placeholder="Type here" >
              @error('description')
              <x-error-message>{{ $message }}</x-error-message>
              @enderror
            </fieldset>

            <input id="eventID" name="eventID" class="input w-full" type="text" hidden >
            
            <div class="flex justify-end gap-3">
              <div id="deleteButtonContainer" class="hidden">
                <x-button id="deleteButton" type="button" negative label="Delete" right-icon="trash" interaction="negative" />
              </div>
              <x-button id="submitButton" type="button" primary label="Submit" />
            </div>
          </form>
        </div>
      </div>
    </div>

    <x-footer />

    <script>
      const modal = document.getElementById('event-modal');
      const modalContent = document.getElementById('event-modal-content');

      // Close modal when user clicks on backdrop
      modal.addEventListener('click', function (event) {
        // If the user clicked directly on the backdrop (not on modal content)
        if (!modalContent.contains(event.target)) {
          closeModal();
        }
      });

      // Close modal when user clicks on close button
      function closeModal() {
        document.getElementById('deleteButtonContainer').classList.add('hidden');
        document.getElementById('event-modal').classList.add('hidden');
      } 

      // Reset modal
      function resetModal() {
        document.getElementById('event-modal').classList.add('hidden');
        document.getElementById('title').value = '';
        document.getElementById('eventID').value = '';
        document.getElementById('isAllDay').checked = false;
        document.getElementById('description').value = '';
      }
    </script>

    <script type="module">
      // csrf token setup
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      // Add event
      $('#submitButton').click(function() {
        let url = '/v1/api/booking';
        let eventID = $('#eventID').val();

        let data = {
          is_all_day: $('#isAllDay').prop('checked') ? 1 : 0,
          title: $('#title').val(),
          start: $('#startDateTime').val(),
          end: $('#endDateTime').val(),
          description: $('#description').val(),
        }

        if (eventID) {
          url = '/v1/api/booking/' + eventID
          data._method = "PUT";
        }

        $.ajax({
          type: 'POST',
          url: url,
          dataType: 'json',
          data: data,
          success: function(res) {
            console.log(res)
            if (res.success) {
              calendar.refetchEvents();
              closeModal();
              resetModal();
            } else {
              alert('Something went wrong', res.message); 
            }
          }
        })
      });

      // Delete event
      $('#deleteButton').click(function() {
        const eventID = $('#eventID').val();
        $.ajax({
          type: 'DELETE',
          url: '/v1/api/booking/' + eventID,
          dataType: 'json',
          success: function(res) {
            console.log(res)
            if (res.success) {
              calendar.refetchEvents();
              closeModal();
              resetModal();
            } else {
              alert('Something went wrong', res.message); 
            }
          }
        })
      })
    </script>
	</body>
</html>
