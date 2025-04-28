<?php
function loadUserData() {
    if (!file_exists('../users.json')) {
        return ['users' => []];
    }
    $json = file_get_contents('../users.json');
    return json_decode($json, true);
}

function saveUserData($data) {
    file_put_contents('../users.json', json_encode($data, JSON_PRETTY_PRINT));
}
?>
