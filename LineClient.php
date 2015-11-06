<?php
class LineClient
{
  private $token;
  private $BASE_API_URL = "https://api.line.me/v1/";

  private function getToken() {
    return $this->token;
  }

  public function setToken($newToken) {
    $this->token = $newToken;
  }

  private function request($api, $params = null) {
    $headers = [
      "Content-Type: application/json",
      "Authorization: Bearer ".$this->token
    ];
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, $this->BASE_API_URL.$api);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
    
    $res = curl_exec($c);
    curl_close($c);
    $res = json_decode($res);
    foreach ($res as $key => $value) {
      $arr[$key] = $value;
    }
    return $arr;
  }

  public function getUserProfile() {
    return $this->request("/profile");
  }

  public function getFriends() {
    return $this->request("/friends");
   }

}
?>
