<?php
Class pagSeguro {
	public function pay(){
		$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/pre-approvals/request';
				
		$data['email'] = 'EMAIL';
		$data['token'] = 'TOKEN';
		$data['currency'] = 'BRL';
		
		$data['preApprovalCharge'] = 'auto';
		$data['preApprovalName'] = 'Assinatura';
		$data['preApprovalAmountPerPayment'] = '10.00';
		$data['preApprovalPeriod'] = 'Monthly';
		$data['preApprovalFinalDate'] = '2017-04-25T00:00:000-03:00';
		$data['preApprovalMaxTotalAmount'] = '120.00';
		
		
		$data['reference'] = 'REF1234';
		$data['senderName'] = 'Jose Comprador';
		$data['senderAreaCode'] = '11';
		$data['senderPhone'] = '56273440';
		$data['senderEmail'] = 'COMPRADOR@SITE.COM.BR';
		$data['redirectURL'] = 'HTTP://';
		
		$data = http_build_query($data);
		
		$curl = curl_init($url);
		
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		$xml= curl_exec($curl);
		
		if($xml == 'Unauthorized'){
			print 'Assinatura nao autorizada.';
			exit(0);
		}
		curl_close($curl);
		
		$xml= simplexml_load_string($xml);
		if(count($xml -> error) > 0){
			print 'Erro:<pre>';
			print_r($xml);
			exit(0);
		}
		header('Location: https://sandbox.pagseguro.uol.com.br/v2/pre-approvals/request.html?code='.$xml->code);
	}
}
