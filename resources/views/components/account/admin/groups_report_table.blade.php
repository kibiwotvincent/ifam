@if(count($groupsStats) == 0)
<div class="alert alert-info mt-3 mx-3" role="alert">Nothing to display!</div>
@else
<div class="row">
	<div class="col my-3 mr-2 text-right">
		<div class="dropdown">
			<a style="padding: 10px 15px; border-radius: 4px;" class="border-0 dropdown-toggle bg-success text-white" href="#" id="moreDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Download <i class="ik ik-chevron-down"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="moreDropdown">
				<a class="dropdown-item" href="#">Excel</a>
				<a class="dropdown-item" href="#">PDF</a>
			</div>
		</div>
	</div>
</div>

<div class="table-responsive">
	<table class="table table-hover mb-0" id="datatable">
		<thead>
			<tr>
				<th>Group</th>
				<th>Interests</th>
				<th>Expenses</th>
				<th>Sales</th>
				<th>Profit</th>
			</tr>
		</thead>
		<tbody>
			@foreach($groupsStats as $group)
			<tr>
				<td><a href="{{ route('admin.group_report', $group['id']) }}">{{ $group['name'] }}</a></td>
				<td>{{ $group['group_child_categories'] }}</td>
				<td>{{ number_format($group['data']['expenses'], 2) }}</td>
				<td>{{ number_format($group['data']['sales'], 2) }}</td>
				<td>{{ number_format($group['data']['profit'], 2) }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endif