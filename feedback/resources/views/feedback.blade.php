@extends('layouts.main')

@section ('content')
<section>
    <div class="container">

		<table class="table table-striped">
			<thead>
				<th>ID</th>
				<th>From</th>
				<th>Time</th>
				<th>Grade / Subject</th>
				<th>Message</th>
				<th>Comment</th>
			</thead>
			<tbody>
		@foreach ($feedback as $f)
			<tr>
				<td>{{$f->id}}</td>
				<td>{{$f->sender_num}}</td>
				<td>{{date('j F Y', $f->time)}}</td>
				<td>{{$f->subject}} ({{$f->grade}})</td>
				<td>{{$f->text}}</td>
				<td>
					<form class="form-inline">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-default">Comment</button>
						</div>
					</form>
				</td>
			</tr>
		@endforeach
		</tbody>
		</table>
	</div>
</section>
@endsection