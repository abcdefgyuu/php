<?php

if(count($errors)>0){
  foreach ($errors as $key => $err) {
    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>$err</strong>
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
  }
}