<?php

if(isset($_POST['submit'])) {
    $error = array();
    str_word_count($_POST['name']) != 2 ? $error['name'] = "Nimi peab sisaldama ees- ja perekonnanime!" : $name = $_POST['name'];

    !checkIdCode($_POST['code']) ? $error['code'] = "Isikukood ei ole korrektne" : $code = intval($_POST['code']);

    $_POST['credit'] >= 1000 && $_POST['credit'] <= 10000 ? $credit = intval($_POST['credit']) : $error['credit'] = "Summa peab olema vahemikus 1000 kuni 10 000";

    $_POST['period'] >= 6 && $_POST['period'] <= 24 ? $period = intval($_POST['period']) : $error['period'] = "Periood peab olema 6-24 kuud!";

    !contains($_POST['case']) ? $error['case'] = "Kasutuseesmärk peab sisaldama ühte sõnadest: puhkus, remont, koduelektroonika, pulmad, rent, auto, kool, investeering!" : $case = $_POST['case'];
    
    if (isset($name, $code, $credit, $period, $case)) {
        $data = array(
            'Nimi' => $name,
            'Isikukood' => $code,
            'Laenu summa' => $credit,
            'Periood kuudes' => $period,
            'Kasutuseesmärk' => $case,
        );
        $success = save_data($data);
    }
}

function checkIdCode($idCode) {
    $IdCodeTrimmed = trim($idCode);    
    if (strlen($IdCodeTrimmed) != 11) return false;

    $firstStage = 1;
    $secondStage = 3;

    $firstCheck = $secondCheck = 0;
    for ($i = 0; $i < 10; $i++) {
        $firstCheck += $firstStage * $IdCodeTrimmed[$i];
        $firstStage = ($firstStage < 9) ? ++$firstStage : 1;
        $secondCheck += $secondStage * $IdCodeTrimmed[$i];
        $secondStage = ($secondStage < 9) ? ++$secondStage : 1;
    };

    $firstRemainder = $firstCheck % 11;
    $secondRemainder = $secondCheck % 11;

    $firstRemainder < 10 ? $control_number = $firstRemainder : ($secondRemainder < 10 ? $control_number = $secondRemainder : $control_number = 0);

    return $IdCodeTrimmed[10] != $control_number ? false : true;
}

function contains($user_case){
    $available_cases = ['puhkus', 'remont', 'koduelektroonika', 'pulmad', 'rent', 'auto', 'kool', 'investeering'];
    foreach($available_cases as $case) {
        if (stripos(strtolower($user_case),$case) !== false) return true;
    }
    return false;
}
function save_data($data_array) {
    $name = str_replace(" ", "_", $data_array['Nimi']);
    $file_name = 'data/' . $name . '.json';

    try {
        file_put_contents($file_name, json_encode($data_array));
        return '<small"> Andmed salvestatud </small>';
    }catch (Exception $e){
        return '<small">' .$e->getMessage(). '</small>';
    }
}