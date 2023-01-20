<?php
include('config.php'); // include database file.
class Validator{
	function __construct($servername, $username, $password, $dbName) {
		$this->servernamee = $servername;
		$this->usernamee = $username;
		$this->passwordd = $password;
		$this->db = $dbName;
	}
	public function uspsFunction(){
		if(isset($_POST['actions']) && $_POST['actions'] == 'nonvalidate'){
		$address1 = $_POST['address_1'];
		$address2 = $_POST['address_2'];
		$country  = $_POST['country'];
		$state	  = $_POST['state'];
		$city	  = $_POST['city'];
		$zip 	  = $_POST['zip'];
		$request_doc_template = <<<EOT
<?xml version="1.0"?>
<AddressValidateRequest USERID="866TEST01089">
	<Revision>1</Revision>
	<Address ID="0">
		<Address1>$address1</Address1>
		<Address2>$address2</Address2>
		<City>$city</City>
		<State>$state</State>
		<Zip5>$zip</Zip5>
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
			// echo '<pre>'; print_r($xml->Address->Error->Description); die;
			if($xml->Address->Error){
				echo json_encode(array('status' => false, 'message'=>$xml->Address->Error->Description));
			}else{
				echo json_encode(array('status' => true, 'originaldata'=>$xml->Address));
			}
			exit;
		}else{
			$alldata = serialize($_POST);
			$sql = "INSERT INTO `tbl_addresses` (`address`) VALUES ('$alldata')";
			$mysqli = new mysqli($this->servernamee, $this->usernamee, $this->passwordd, $this->db);
			$result = mysqli_query($mysqli, $sql);
			if($result){
				echo json_encode(array('status' => true, 'message'=>'Thanks your address are saved successfully.'));
			}
		}
	}
}

?>