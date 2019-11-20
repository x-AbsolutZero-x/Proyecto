$input_dummy = trim($_POST["dummy"]);
    if(empty($input_dummy)){
        $dummy_err = "Please enter a dummy.";
    } elseif(!filter_var($input_dummy, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $dummy_err = "Please enter a valid name.";
    } else{
        $dummy = $input_dummy;
    }