@if(count($seasons) == 0)
<div class="alert alert-info mt-3 mx-3" role="alert">There are no seasons to display!</div>
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
				<th>Season</th>
				<th>Department</th>
				<th>Category</th>
				<th>Expenses</th>
				<th>Sales</th>
				<th>Profit</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			@foreach($seasons as $row)
			<tr>
				<td>{{ $row['name'] }}</td>
				<td>{{ $row->department->category['name'] }}</td>
				<td>{{ $row->child_category['name'] }}</td>
				<td>{{ number_format($row->total_expenses($from, $to), 2) }}</td>
				<td>{{ number_format($row->total_sales($from, $to), 2) }}</td>
				<td>{{ number_format($row->total_profits($from, $to), 2) }}</td>
				<td><span class="badge badge-pill badge-{{ $row['status'] }}">{{ $row['status'] }}</span></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endif