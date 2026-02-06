<?php 

namespace App\Helpers;

trait PaymentTrait {
    
    public function online_payment_data($price, $reference_number, $transaction_uuid, $user)
    {
        $params = [];

        $params['access_key'] = config('payment.USD.access_key');
        
        $params['profile_id'] = config('payment.USD.profile_id');
        
        $params['transaction_uuid'] = $transaction_uuid;
        
        $params['signed_field_names'] = 'access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency,merchant_id,payer_authentication_transaction_mode,device_fingerprint_id,bill_to_forename,bill_to_surname,bill_to_email,bill_to_address_country,bill_to_address_city,bill_to_address_line1';
        
        $params['unsigned_field_names'] = '';
        
        $params['signed_date_time'] = gmdate("Y-m-d\TH:i:s\Z");
        
        $params['locale'] = 'en';
        
        $params['transaction_type'] = 'sale';
        
        $params['reference_number'] = $reference_number;
        
        $params['amount'] = $price;
        
        $params['currency'] = 'USD';
        
        $params['merchant_id'] = config('payment.USD.merchant_id');
        
        $params['payer_authentication_transaction_mode'] = 'S';
        
        $params['device_fingerprint_id'] = 'farahnilecruise';
        
        $params['bill_to_forename'] = $user->first_name;

        $params['bill_to_surname'] = $user->last_name;
        
        $params['bill_to_email'] = $user->email;
        
        $params['bill_to_address_country'] = 'EG';

        $params['bill_to_address_line1'] = 'South 90 Street, New Cairo';

        $params['bill_to_address_city'] = 'Cairo';

        return $params;
        
    }
    
    public function signature($online_payment_data)
    {
        return $this->sign($online_payment_data);
    }
    
	public function sign($params)
	{
		return $this->signData($this->buildDataToSign($params), config('payment.USD.SECRET_KEY'));
	}

	public function signData($data, $secretKey) 
	{
        return base64_encode(hash_hmac('sha256', $data, $secretKey, true));
    }

    public function buildDataToSign($params) 
    {
        $signedFieldNames = explode(",",$params["signed_field_names"]);
        
        foreach ($signedFieldNames as $field) 
        {
           $dataToSign[] = $field . "=" . $params[$field];
        }
        return $this->commaSeparate($dataToSign);
    }
    
    public function commaSeparate ($dataToSign) 
    {
        return implode(",",$dataToSign);
    }
}