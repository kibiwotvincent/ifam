<div class="card">
	<div class="card-body">
		<div class="form-group">
			<label>Season Name</label>
			<span class="form-control pt-2 font-weight-bold">{{ $season['name'] }}</span>
		</div>
		<div class="form-group">
			<label>Season Description</label>
			<span class="form-control pt-2 font-weight-bold">{{ $season['description'] ?? '--' }}</span>
		</div>
		<div class="row mb-1">
			<div class="col-md-6">
				<div class="form-group">
					<label>Crop</label>
					<span class="form-control pt-2 font-weight-bold">{{ $season->child_category['name'] }}</span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Variety</label>
					<span class="form-control pt-2 font-weight-bold">{{ $season->child_sub_category['name'] ?? '--' }}</span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Season Start Date</label>
					<span class="form-control pt-2 font-weight-bold">{{ $season['start_date'] == "" ? "" : $season->start_date->format('Y-m-d') }}</span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Season End Date</label>
					<span class="form-control pt-2 font-weight-bold">{{ $season['end_date'] == "" ? "" : $season->end_date->format('Y-m-d') }}</span>
				</div>
			</div>
			@php
			$categoryMetadatas = $season->department->category->getMetadatas();
			@endphp
			
			@foreach($season->department->category->metadata as $metadata)
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ $categoryMetadatas[$metadata]['label'] }}</label>
					<span class="form-control pt-2 font-weight-bold">{{ $season->metadata[$metadata] ?? '--' }} </span>
				</div>
			</div>
			@endforeach
		</div>
		<div class="form-group">
			<label>Tracking Group </label>
			<span class="form-control pt-2 font-weight-bold">{{ $season->merged_group != null ? $season->merged_group->group['name'] : '--'}}</span>
		</div>
		
		<div class="text-right">
			<a class="btn btn-light" href="{{ url()->previous() }}">Back</a>
			@if($season->trashed())
				@if($canRestore)
				<button class="btn btn-success ml-2" data-toggle="modal" data-target="#restoreSeasonModal" >Restore</button>
				@endif
				@if($canDestroy)
				<button class="btn btn-warning ml-2" data-toggle="modal" data-target="#destroySeasonModal" >Delete Permanently</button>
				@endif
			@else
				@if($canDelete)
				<button class="btn btn-warning ml-2" data-toggle="modal" data-target="#deleteSeasonModal" >Delete</button>
				@endif
			@endif
		</div>
	</div>
</div>
@if($canDelete)
<!-- delete season confirmation -->
<div class="modal fade" id="deleteSeasonModal" tabindex="-1" role="dialog" aria-labelledby="deleteSeasonModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="deleteSeasonModalLabel">Delete Season</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form class="ajax" id="delete_season_form" action="{{ route('delete_season', [$season->department->farm->farmable['id'], $season->department['farm_id'], $season->department['id'], $season['id']]) }}" method="post">
					@method('post')
					@csrf
					<input type="hidden" name="_redirect" value="{{ url()->previous() }}" >
					<input type="hidden" name="season_id" value="{{ $season['id'] }}"/>
					<p>Are you sure you want to delete this season ?</p>
					<div id="delete_season_form_feedback"></div>
							
					<div class="text-right">
						<a href="#" class="btn btn-light mr-2" data-dismiss="modal">Cancel</a>
						<button type="submit" class="btn btn-danger" id="delete_season_form_submit">Delete Season</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--end delete season confirmation -->
@endif
@if($canDestroy)
<!-- destroy season confirmation -->
<div class="modal fade" id="destroySeasonModal" tabindex="-1" role="dialog" aria-labelledby="destroySeasonModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="destroySeasonModalLabel">Permanently Delete Season</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form class="ajax" id="destroy_season_form" action="{{ route('destroy_season', [$season->department->farm->farmable['id'], $season->department['farm_id'], $season->department['id'], $season['id']]) }}" method="post">
					@method('post')
					@csrf
					<input type="hidden" name="_redirect" value="{{ url()->previous() }}" >
					<input type="hidden" name="season_id" value="{{ $season['id'] }}"/>
					<p>Are you sure you want to permanently delete this season ?</p>
					<div id="destroy_season_form_feedback"></div>
							
					<div class="text-right">
						<a href="#" class="btn btn-light mr-2" data-dismiss="modal">Cancel</a>
						<button type="submit" class="btn btn-danger" id="destroy_season_form_submit">Permanently Delete Season</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--end destroy season confirmation -->
@endif
@if($canDelete)
<!-- restore deleted season confirmation -->
<div class="modal fade" id="restoreSeasonModal" tabindex="-1" role="dialog" aria-labelledby="restoreSeasonModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="restoreSeasonModalLabel">Restore Season</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form class="ajax" id="restore_season_form" action="{{ route('restore_season', [$season->department->farm->farmable['id'], $season->department['farm_id'], $season->department['id'], $season['id']]) }}" method="post">
					@method('post')
					@csrf
					<input type="hidden" name="_redirect" value="{{ url()->previous() }}" >
					<input type="hidden" name="season_id" value="{{ $season['id'] }}"/>
					<p>Are you sure you want to restore this season ?</p>
					<div id="restore_season_form_feedback"></div>
							
					<div class="text-right">
						<a href="#" class="btn btn-light mr-2" data-dismiss="modal">Cancel</a>
						<button type="submit" class="btn btn-danger" id="restore_season_form_submit">Restore Season</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--end restore deleted season confirmation -->
@endif