<?php
$errors = array();

function fieldname_as_text($fieldname){
  $fieldname = str_replace("_", " ", $fieldname);
  $fieldname = ucfirst($fieldname);
  return $fieldname;
}
  			// check presence
				// trim use to cut the spaces
				//!is_numeric($value) chech
function has_presence($value){
		return isset($value) && $value !== "";
}

function validate_presences($required_fields){
  global $errors;
  foreach ($required_fields as $field){
    $value = trim($_POST[$field]);
      if(!has_presence($value)){
        $errors[$field] = fieldname_as_text($field) . " cant be blanks ";
    }
  }
}

function has_max_length($value, $max){
	return strlen($value) <= $max;
}



function validate_max_length($fields_with_max_lengths){
  global $errors;
  foreach ($filds_with_max_lengths  as $field => $max) {
    $value = trim($_POST[$field]);
    if(!has_max_length($value,$max)){
      $errors[$field] = fieldname_as_text($field) . " is TO Long";
    }
  }
}


function has_inclusion_in($value,$set){
	return in_array($value,$set);
}

 ?>
