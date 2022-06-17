<form class="ajax" id="update_{{ $position }}_form" action="{{ route('update_group_member', $group['id']) }}" method="post">
	@method('post')
	@csrf
	<input type="hidden" name="_redirect" value="{{ url()->full() }}" >
	<input type="hidden" name="group_id" value="{{ $group['id'] }}"/>
	<input type="hidden" name="position" value="{{ $position }}"/>
	<div class="form-group">
		<label for="{{ $position }}" style="width: 100%">Select New {{ ucfirst($position) }} </label>
		<select class="form-control select2" style="width: 100%" id="{{ $position }}" name="{{ $position }}" required>
			<option value="">Select new {{ $position }}</option>
			@foreach($group->members as $row)
			<option value="{{ $row['id'] }}">{{ $row->user['full_name'] }}&nbsp;&nbsp;&nbsp;&nbsp;({{ $row->user['id_number'] }})</option>
			@endforeach
		</select>
		<p class="d-none error" for="{{ $position }}"></p>
	</div>
	
	<div id="update_{{ $position }}_form_feedback"></div>
			
	<div class="text-right">
		<button type="submit" class="btn btn-success" id="update_{{ $position }}_form_submit">Update</button>
	</div>
</form>