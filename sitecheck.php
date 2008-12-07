<?php
class sitecheck{
	var $domain = ''; // 'http://www.carbonsilk.com'
	var $expected_title = ''; // 'Carbon Silk'
	var $http_response_code = null;
	var $http_response_title = null;
	
	function sitecheck($domain, $expected_title = null){
		if(isset($domain)){
			$this->domain = $domain;
		}
		
		if(isset($expected_title)){
			$this->expected_title = $expected_title;
		}
		
		$this->get_domain_response();
	}
	
	function get_domain_response(){
		$ch = curl_init($this->domain);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$output = curl_exec($ch);
		$this->http_response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$this->http_response_title = self::get_title_text($output);
		curl_close($ch);
		// If we got a response we are done here
		if($output){
			return true;
		} else {
			return false;
		}
	}
	
	function get_title_text($html){
		preg_match('/<title>(.*)<\/title>/Us', $html, $matches);
		$website_title = $matches[1];
		return $website_title;
	}
	
	function validate_title_text(){
		if(strstr($this->http_response_title, $this->expected_title)){
			return true;
		} else {
			return false;
		}
	}
	
	function status(){
		if(200 == $this->http_response_code && $this->validate_title_text()){
			return true;
		} else {
			return false;
		}
	}
	
	function status_response(){
		if($this->status()){
			$response = $this->domain . ' is up';
		} else {
			if(200 == $this->http_response_code){
				$response = $this->domain . " can be reached but the expected title '{$this->expected_title}' does not match";
			} else {
				$response = $this->domain . ' is down';	
			}
		}
		return $response;
	}
}