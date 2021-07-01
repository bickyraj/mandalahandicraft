<?php

namespace App\Custom;

use App\Custom\Abstracts\SocialLogin;

class NormalSignUp extends SocialLogin {
	public function verify() {
		return $this;
	}

	public function isValid() {
		return true;
	}
}