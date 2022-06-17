<div id="calendar"></div>
<!-- calendar modals -->
<div class="modal" id="editEvent" tabindex="-1" role="dialog" aria-labelledby="editEventLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form class="editEventForm">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editEventLabel">Edit Event</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="editEname">Event Title</label>
						<input type="text" class="form-control" id="editEname" name="editEname" placeholder="Please enter event title">
					</div>
					<div class="form-group">
						<label for="editStarts">Start</label>
						<input type="text" class="form-control datetimepicker-input" id="editStarts" name="editStarts" data-toggle="datetimepicker" data-target="#editStarts">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button class="btn btn-danger delete-event" type="submit">Delete</button>
					<button class="btn btn-success save-event" type="submit">Save</button>
				</div>
			</div>
		</form>
	</div>
</div> 

<div class="modal" id="addEvent" tabindex="-1" role="dialog" aria-labelledby="addEventLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addEventLabel">Add New Event</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form id="addEventForm">
					<div class="form-group">
						<label for="eventName">Event Title</label>
						<input type="text" class="form-control" id="eventName" name="eventName" placeholder="Please enter event title">
					</div>
					<div class="form-group">
						<label for="eventStarts">Starts</label>
						<input type="text" class="form-control datetimepicker-input" id="eventStarts" name="eventStarts" data-toggle="datetimepicker" data-target="#eventStarts">
					</div>
					<div class="form-group mb-0" id="addColor">
						<label for="colors">Choose Color</label>
						<ul class="color-selector">
							<li class="bg-aqua">
								<input type="radio" data-color="bg-aqua" checked name="colorChosen" id="addColorAqua">
								<label for="addColorAqua"></label>
							</li>
							<li class="bg-blue">
								<input type="radio" data-color="bg-blue" name="colorChosen" id="addColorBlue">
								<label for="addColorBlue"></label>
							</li>
							<li class="bg-light-blue">
								<input type="radio" data-color="bg-light-blue" name="colorChosen" id="addColorLightblue">
								<label for="addColorLightblue"></label>
							</li>
							<li class="bg-teal">
								<input type="radio" data-color="bg-teal" name="colorChosen" id="addColorTeal">
								<label for="addColorTeal"></label>
							</li>
							<li class="bg-yellow">
								<input type="radio" data-color="bg-yellow" name="colorChosen" id="addColorYellow">
								<label for="addColorYellow"></label>
							</li>
							<li class="bg-orange">
								<input type="radio" data-color="bg-orange" name="colorChosen" id="addColorOrange">
								<label for="addColorOrange"></label>
							</li>
							<li class="bg-green">
								<input type="radio" data-color="bg-green" name="colorChosen" id="addColorGreen">
								<label for="addColorGreen"></label>
							</li>
							<li class="bg-lime">
								<input type="radio" data-color="bg-lime" name="colorChosen" id="addColorLime">
								<label for="addColorLime"></label>
							</li>
							<li class="bg-red">
								<input type="radio" data-color="bg-red" name="colorChosen" id="addColorRed">
								<label for="addColorRed"></label>
							</li>
							<li class="bg-purple">
								<input type="radio" data-color="bg-purple" name="colorChosen" id="addColorPurple">
								<label for="addColorPurple"></label>
							</li>
							<li class="bg-fuchsia">
								<input type="radio" data-color="bg-fuchsia" name="colorChosen" id="addColorFuchsia">
								<label for="addColorFuchsia"></label>
							</li>
							<li class="bg-muted">
								<input type="radio" data-color="bg-muted" name="colorChosen" id="addColorMuted">
								<label for="addColorMuted"></label>
							</li>
							<li class="bg-navy">
								<input type="radio" data-color="bg-navy" name="colorChosen" id="addColorNavy">
								<label for="addColorNavy"></label>
							</li>
						</ul>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success save-event">Save</button>
				<button type="button" class="btn btn-danger delete-event" data-dismiss="modal">Delete</button>
			</div>
		</div>
	</div>
</div> 
<!-- end calendar modals -->