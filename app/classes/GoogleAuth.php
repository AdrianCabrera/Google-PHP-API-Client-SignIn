<?php

class GoogleAuth
{
	public function __construct(Google_Client $googleClient = null)
	{
		$this->client = $googleClient;
		if ($this->client) {
			$this->client->setClientId('CLIENT_ID');
			$this->client->setClientSecret('CLIENT_SECRET');
			$this->client->setRedirectUri('http://localhost');
			$this->client->setScopes('email');
		}
	}

	public function isLoggedIn()
	{
		return isset($_SESSION['access_token']);
	}	

	public function getAuthUrl()
	{
		return $this->client->createAuthUrl();
	}

	public function checkRedirectCode()
	{
		if (isset($_GET['code'])) {
			$this->client->authenticate($_GET['code']);

			$this->setToken($this->client->getAccessToken());

			$payload = $this->getPayLoad();
			return true;

		}
		return false;
	}

	public function setToken($token)
	{
		$_SESSION['access_token']=$token;

		$this->client->setAccessToken($token);
	}

	public function logout()
	{
		unset($_SESSION['access_token']);
	}

	public function getPayLoad()
	{
		$payload=$this->client->verifyIdToken();

		return $payload;

	}
}