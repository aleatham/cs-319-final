<?php
class ApplicationController extends Controller {
	public function home() {
		$this->show('application/home');
	}

	public function not_found_error() {
		$this->show('application/errors/not_found');
	}

	public function internal_service_error() {
		$this->show('application/errors/internal_service');
	}
}
