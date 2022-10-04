<div class="card">
	<div class="card-body">
		<div class="form-group">
			<label>Farm Name</label>
			<span class="form-control pt-2 font-weight-bold">{{ $farm['name'] }}</span>
		</div>
		<div class="form-group">
			<label>Farm Description</label>
			<span class="form-control pt-2 font-weight-bold">{{ $farm['description'] ?? '--' }}</span>
		</div>
		<label>Farm Departments</label>
		<div class="form-group">
			@foreach($farm->departments as $department)
				<span class="font-weight-bold text-muted mr-4">{{ $department->category['name'] }}</span>
			@endforeach
		</div>
		<div class="form-group">
			<label>Acreage (in acres)</label>
			<span class="form-control pt-2 font-weight-bold">{{ $farm['acreage'] ?? '--'}}</span>
		</div>
		<div class="form-group">
			<label>Location Cordinates</label>
			<span class="form-control pt-2 font-weight-bold">{{ $farm['location'] ?? '--'}}</span>
		</div>
		
		<div class="text-right">
			<a class="btn btn-light" href="{{ url()->previous() }}">Back</a>
			@if($farm->trashed())
				@if($canRestore)
				<button class="btn btn-success ml-2" data-toggle="modal" data-target="#restoreFarmModal" >Restore</button>
				@endif
				@if($canDestroy)
				<button class="btn btn-warning ml-2" data-toggle="modal" data-target="#destroyFarmModal" >Delete Permanently</button>
				@endif
			@else
				@if($canDelete)
				<button class="btn btn-warning ml-2" data-toggle="modal" data-target="#deleteFarmModal" >Delete</button>
				@endif
			@endif
		</div>
	</div>
</div>
@if($canDelete)
<!-- delete farm confirmation -->
<div class="modal fade" id="deleteFarmModal" tabindex="-1" role="dialog" aria-labelledby="deleteFarmModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="deleteFarmModalLabel">Delete Farm</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form class="ajax" id="delete_farm_form" action="{{ route('delete_farm', [$farm['id']]) }}" method="post">
					@method('post')
					@csrf
					<input type="hidden" name="_redirect" value="{{ url()->previous() }}" >
					<input type="hidden" name="farm_id" value="{{ $farm['id'] }}"/>
					<p>Are you sure you want to delete this farm ?</p>
					<div id="delete_farm_form_feedback"></div>
							
					<div class="text-right">
						<a href="#" class="btn btn-light mr-2" data-dismiss="modal">Cancel</a>
						<button type="submit" class="btn btn-danger" id="delete_farm_form_submit">Delete Farm</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--end delete farm confirmation -->
@endif
@if($canDestroy)
<!-- destroy farm confirmation -->
<div class="modal fade" id="destroyFarmModal" tabindex="-1" role="dialog" aria-labelledby="destroyFarmModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="destroyFarmModalLabel">Permanently Delete Farm</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form class="ajax" id="destroy_farm_form" action="{{ route('destroy_farm', [$farm['id']]) }}" method="post">
					@method('post')
					@csrf
					<input type="hidden" name="_redirect" value="{{ url()->previous() }}" >
					<input type="hidden" name="farm_id" value="{{ $farm['id'] }}"/>
					<p>Are you sure you want to permanently delete this farm ?</p>
					<div id="destroy_farm_form_feedback"></div>
							
					<div class="text-right">
						<a href="#" class="btn btn-light mr-2" data-dismiss="modal">Cancel</a>
						<button type="submit" class="btn btn-danger" id="destroy_farm_form_submit">Permanently Delete Farm</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--end destroy farm confirmation -->
@endif
@if($canDelete)
<!-- restore deleted farm confirmation -->
<div class="modal fade" id="restoreFarmModal" tabindex="-1" role="dialog" aria-labelledby="restoreFarmModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="restoreFarmModalLabel">Restore Farm</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form class="ajax" id="restore_farm_form" action="{{ route('restore_farm', [$farm['id']]) }}" method="post">
					@method('post')
					@csrf
					<input type="hidden" name="_redirect" value="{{ url()->previous() }}" >
					<input type="hidden" name="farm_id" value="{{ $farm['id'] }}"/>
					<p>Are you sure you want to restore this farm ?</p>
					<div id="restore_farm_form_feedback"></div>
							
					<div class="text-right">
						<a href="#" class="btn btn-light mr-2" data-dismiss="modal">Cancel</a>
						<button type="submit" class="btn btn-danger" id="restore_farm_form_submit">Restore Farm</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--end restore deleted farm confirmation -->
@endif