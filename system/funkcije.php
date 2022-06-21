<?php
function clean($data) {
  if (is_array($data)) {
    foreach ($data as $key => $value) {
      unset($data[$key]);

      $data[clean($key)] = clean($value);
    }
  }
  else { 
    $data = htmlspecialchars($data, ENT_COMPAT, 'UTF-8');
  }
  return $data;
}
?>