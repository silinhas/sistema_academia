<?php
namespace PHPMaker2020\sistema_academia;

/**
 * Captcha base class
 */
class CaptchaBase implements CaptchaInterface {

	// HTML tag
	public function getHtml() {
		return "";
	}

	// HTML tag for confirm page
	public function getConfirmHtml() {
		return "";
	}

	// Validate
	public function validate() {
		return TRUE;
	}

	// Client side validation script
	public function getScript() {
		return "";
	}
}
?>