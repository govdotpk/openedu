<table>
	<thead>
		<th>ID</th>
		<th>From</th>
		<th>Time</th>
		<th>Message</th>
	</thead>
	<tbody>
@foreach ($feedback as $f)
	<tr>
		<td>{{$f->id}}</td>
		<td>{{$f->sender_num}}</td>
		<td>{{date('j F Y', strtotime($f->time))}}</td>
		<td>{{$f->text}}</td>
	</tr>
@endforeach
</tbody>
</table>