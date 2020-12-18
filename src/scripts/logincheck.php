<?php

  function loginCheck() {
    if ($this->session->get('logged') === true) {
      return true;
    } else {
      return $this->redirectToRoute('login', ['failed' => 0]);
    }
  }

 ?>
