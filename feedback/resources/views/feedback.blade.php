@foreach ($feedback as $f)
	<p>
		<span>{{$f->id}}</span>
		<span>{{$f->sender_num}}</span>
		<span>{{$f->receiver_num}}</span>
		<span>{{$f->gsm_network}}</span>
		<span>{{$f->time}}</span>
		<span>{{$f->text}}</span>
	</p>
@endforeach