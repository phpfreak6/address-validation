<?php
include('validator.php');
// $var = new Validator;
// $var->uspsFunction(); die;
include('config.php'); // include database file.

$address1 = 'Suit 6100';
$address2 = '185 Berry St';
$city	  = 'San Francisco';
$state	  = 'CA';
$zip = '84604';
$request_doc_template = <<<EOT
<?xml version="1.0"?>
<AddressValidateRequest USERID="866TEST01089">
	<Revision>1</Revision>
	<Address ID="0">
		<Address1>$address1</Address1>
		<Address2>$address2</Address2>
		<City>$city</City>
		<State>$state</State>
		<Zip5>990909</Zip5>
		<Zip4/>
	</Address>
</AddressValidateRequest>
EOT;

// prepare xml doc for query string
$doc_string = preg_replace('/[\t\n]/', '', $request_doc_template);
$doc_string = urlencode($doc_string);

$url = "http://production.shippingapis.com/ShippingAPI.dll?API=Verify&XML=" . $doc_string;
// echo $url . "\n\n";

// perform the get
$response = file_get_contents($url);

$xml = simplexml_load_string($response) or die("Error: Cannot create object");
echo '<pre>';
echo 'Original Address:- ';echo '</br>';
echo $address1 . "\n";
echo $address2 . "\n";
echo $city . "\n";
echo $state . "\n";
echo $zip . "\n";
echo "===================================" ."\n";
echo 'Standardized Address:- ';echo '</br>';
echo "Address1: " . $xml->Address->Address1 . "\n";
echo "Address2: " . $xml->Address->Address2 . "\n";
echo "City: " . $xml->Address->City . "\n";
echo "State: " . $xml->Address->State . "\n";
echo "Zip5: " . $xml->Address->Zip5 . "\n";
?>
