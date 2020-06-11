<?php
    class Error404 extends Controller {
        public function index() {
              $this->view('error/404');
        }

        public function error_method() {
              $this->view('error/404');
        }
    }
