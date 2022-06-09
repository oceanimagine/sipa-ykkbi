<?php
$array_password_label = array(
    "password",
    "pass",
    "pwd"
);
$array_email_label = array(
    "email",
    "mail"
);
$array_google_drive_label = array(
    "google_drive_pdf",
    "google_drive",
    "google"
);
$array_jam_label = array(
    "jam",
    "hour",
    "clock"
);
$array_photo_label = array(
    "photo",
    "foto",
    "picture",
    "gambar",
    "pic",
    "picture"
);
function is_alphabet($param){
    $huruf = array(
        "a" => true,
        "b" => true,
        "c" => true,
        "d" => true,
        "e" => true,
        "f" => true,
        "g" => true,
        "h" => true,
        "i" => true,
        "j" => true,
        "k" => true,
        "l" => true,
        "m" => true,
        "n" => true,
        "o" => true,
        "p" => true,
        "q" => true,
        "r" => true,
        "s" => true,
        "t" => true,
        "u" => true,
        "v" => true,
        "w" => true,
        "x" => true,
        "y" => true,
        "z" => true
    );
    return isset($huruf[strtolower($param)]) ? true : false;
}
function is_vocal_alphabet($param){
    $huruf = array(
        "a" => true,
        "i" => true,
        "u" => true,
        "e" => true,
        "o" => true
    );
    return isset($huruf[strtolower($param)]) ? true : false;
}
function is_consonant_alphabet($param){
    $huruf = array(
        "b" => true,
        "c" => true,
        "d" => true,
        "f" => true,
        "g" => true,
        "h" => true,
        "j" => true,
        "k" => true,
        "l" => true,
        "m" => true,
        "n" => true,
        "p" => true,
        "q" => true,
        "r" => true,
        "s" => true,
        "t" => true,
        "v" => true,
        "w" => true,
        "x" => true,
        "y" => true,
        "z" => true
    );
    return isset($huruf[strtolower($param)]) ? true : false;
}
function contain_name($strlower_name, $array_contain){
    $address = 0;
    $returns = false;
    $i = 0;
    while(isset($strlower_name{$address})){
        if(isset($array_contain[$i]) && substr($strlower_name, $address, strlen($array_contain[$i])) == $array_contain[$i]){
            $final_check = 0;
            if(isset($strlower_name{$address + strlen($array_contain[$i])})){
                if(is_consonant_alphabet($strlower_name{($address + strlen($array_contain[$i])) - 1})){
                    if(is_vocal_alphabet($strlower_name{($address + strlen($array_contain[$i]))})){
                        $final_check = 1;
                    }
                    if(is_consonant_alphabet($strlower_name{($address + strlen($array_contain[$i]))})){
                        if(isset($strlower_name{($address + strlen($array_contain[$i])) + 1})){
                            if(is_vocal_alphabet($strlower_name{($address + strlen($array_contain[$i])) + 1})){
                                $final_check = 1;
                            }
                        }
                    }
                }
                if(is_vocal_alphabet($strlower_name{($address + strlen($array_contain[$i])) - 1})){
                    if($strlower_name{($address + strlen($array_contain[$i])) - 1} != $strlower_name{($address + strlen($array_contain[$i]))}){
                        if(is_alphabet($strlower_name{($address + strlen($array_contain[$i]))}) && is_consonant_alphabet($strlower_name{($address + strlen($array_contain[$i]))})){
                            if(isset($strlower_name{($address + strlen($array_contain[$i])) + 1}) && isset($strlower_name{($address + strlen($array_contain[$i])) + 2})){
                                if(is_vocal_alphabet($strlower_name{($address + strlen($array_contain[$i])) + 1}) && is_consonant_alphabet($strlower_name{($address + strlen($array_contain[$i])) + 2})){
                                    $final_check = 1;
                                }
                            }
                        } else {
                            $final_check = 1;
                        }
                    }
                }
            }
            if($final_check || (isset($strlower_name{$address + strlen($array_contain[$i])}) && !is_alphabet($strlower_name{$address + strlen($array_contain[$i])}))){
                $returns = true;
            } else {
                if(!isset($strlower_name{$address + strlen($array_contain[$i])})){
                    $returns = true;
                }
            }
            break;
        }
        if($i < sizeof($array_contain)){
            $i++;
        } else {
            $i = 0;
            $address++;
        }
    }
    return $returns;
}

if(contain_name("photosaya", $array_photo_label)){
    echo "COCOK\n";
} else {
    echo "TIDAK COCOK\n";
}
echo "\n";