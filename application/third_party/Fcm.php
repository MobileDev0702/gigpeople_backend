<?php 
class Fcm {

    function sendNotification($senderId,$type,$title,$body,$status) {
        
        //$to_whom=1-facility
        //$to_whom=2-promotion
        //$to_whom=3-facilitymyorders
        //$to_whom=3-customerappointments

    	
		if($type == "Android") {
			
			$fcmApiKey = 'AAAArWhV7_A:APA91bF0jNW0IyUJ6NITyb_ew6wybQuxOhaB2hgzHu_ZtzWZEg3rVSK10u9FwFs55ZTr1K2CuWdSOGqdh9i1W1KuJB2tFXKI6geJtchv4fLIX91peY1iMbneV8VN9VNRqBpX2SHs-9k-';
			
		} else {
			
			//iOS goes here
			$fcmApiKey = '';
		}
    	
        $url = 'https://fcm.googleapis.com/fcm/send';

        $headers = array(
            'Authorization: key=' . $fcmApiKey,
            'Content-Type: application/json'
        );
 
		$fcmMsg = array(
			'body' => $body,
			'title' => $title,
			'status' => $status,
			'sound' => "default",
			'color' => "#203E78" 
		); 
		
		//Make your array here
		
		$dataMsg = array(
			'title' => $title,
			'body' => $body,
			'status' => $status,
			//'tag'=>$to_whom
		);
		
		//$out=$dataMsg."#".$to_whom;

		$fcmFields = array (
			'to' => $senderId,
			'priority' => 'high',
			'data' => $dataMsg,
			//'to_whom'=>$to_whom
		);

		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
		return $result;
	}
}