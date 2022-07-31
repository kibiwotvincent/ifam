<x-app-layout>
<div class="container-fluid">
	<div class="row clearfix">
		<div class="col-lg-3 col-md-6 col-sm-12">
			<div class="widget">
				<div class="widget-body">
					<div class="d-flex justify-content-between align-items-center">
						<div class="state">
							<h6>Groups</h6>
							<h2>{{ count($user->groups) }}</h2>
						</div>
						<div class="icon">
							<i class="ik ik-users"></i>
						</div>
					</div>
				</div>
				<div class="progress progress-sm">
					<div class="progress-bar bg-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-12">
			<div class="widget">
				<div class="widget-body">
					<div class="d-flex justify-content-between align-items-center">
						<div class="state">
							<h6>Farms</h6>
							<h2>{{ count($user->farms) }}</h2>
						</div>
						<div class="icon">
							<i class="ik ik-layout"></i>
						</div>
					</div>
				</div>
				<div class="progress progress-sm">
					<div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-12">
			<div class="widget">
				<div class="widget-body">
					<div class="d-flex justify-content-between align-items-center">
						<div class="state">
							<h6>Events</h6>
							<h2>410</h2>
						</div>
						<div class="icon">
							<i class="ik ik-calendar"></i>
						</div>
					</div>
				</div>
				<div class="progress progress-sm">
					<div class="progress-bar bg-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-12">
			<div class="widget">
				<div class="widget-body">
					<div class="d-flex justify-content-between align-items-center">
						<div class="state">
							<h6>Comments</h6>
							<h2>41,410</h2>
						</div>
						<div class="icon">
							<i class="ik ik-message-square"></i>
						</div>
					</div>
				</div>
				<div class="progress progress-sm">
					<div class="progress-bar bg-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-body">
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
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<div class="d-flex">
						<h4 class="card-title">Weather Report</h4>
						<select class="form-control w-25 ml-auto">
							<option selected="">Today</option>
							<option value="1">Weekly</option>
						</select>
					</div>
					<div class="d-flex align-items-center flex-row mt-30">
						<div class="p-2 f-50 text-info"><i class="wi wi-day-showers"></i> <span>23<sup>°</sup></span></div>
						<div class="p-2">
						<h3 class="mb-0">Saturday</h3><small>Banglore, India</small></div>
					</div>
					<table class="table table-borderless">
						<tbody>
							<tr>
								<td>Wind</td>
								<td class="font-medium">ESE 17 mph</td>
							</tr>
							<tr>
								<td>Humidity</td>
								<td class="font-medium">83%</td>
							</tr>
							<tr>
								<td>Pressure</td>
								<td class="font-medium">28.56 in</td>
							</tr>
						</tbody>
					</table>
					<hr>
					<ul class="list-unstyled row text-center city-weather-days mb-0 mt-20">
						<li class="col"><i class="wi wi-day-sunny mr-5"></i><span>09:30</span><h3>20<sup>°</sup></h3></li>
						<li class="col"><i class="wi wi-day-cloudy mr-5"></i><span>11:30</span><h3>22<sup>°</sup></h3></li>
						<li class="col"><i class="wi wi-day-hail mr-5"></i><span>13:30</span><h3>25<sup>°</sup></h3></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
</x-app-layout>