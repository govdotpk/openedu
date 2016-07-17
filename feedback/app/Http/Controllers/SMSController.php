<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Feedback;

class SMSController extends Controller
{
    public function index()
    {
    	$msg = $this->receive_sms();

    	$msg = json_decode($msg)->status;

    	if (count($msg))
    	{
	    	$feedback = Feedback::create([
	    			'id'	=> $msg[0]->id,
	    			'sender_num'	=> $msg[0]->sender_num,
	    			'receiver_num'	=> $msg[0]->receiver_num,
	    			'gsm_network'	=> $msg[0]->gsm_network,
	    			'time'	=> $msg[0]->time,
	    			'text'	=> $msg[0]->text,
	    		]);
	    	$this->send_sms($feedback->sender_num, $feedback->receiver_num, 'Thank you for your feedback.');
    	}

    	$all = Feedback::all();

    	return view('feedback', [
    			'feedback'=>$all
    		]);

    }

    private function get_session()
	{
		$username="7";	#Put your API Username here
		$password="flowers6291862";	#Put your API Password here
			
		$data=file_get_contents("http://api.smilesn.com/session?username=".$username."&password=".$password);
		$data=json_decode($data);
		$sessionid=$data->sessionid;

		return $sessionid;
	}

	private function send_sms($receivenum, $sendernum, $textmessage)
	{
		$session_id = $this->get_session();

		$data=file_get_contents("http://api.smilesn.com/sendsms?sid=".$session_id."&receivenum=".$receivenum."&sendernum=8333&textmessage=".$textmessage);

		$data2=json_decode($data);
		$response_status=$data2->status;

		return $response_status;
	}

	private function receive_sms()
	{
		$session_id = $this->get_session();

		$data=file_get_contents("http://api.smilesn.com/receivesms?sid=".$session_id);

		return $data;
	}
}
