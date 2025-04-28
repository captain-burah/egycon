<?php
function loadProjectData() {
    if (!file_exists('../contacts.json')) {
        return ['contacts' => []];
    }
    $json = file_get_contents('../contacts.json');
    return json_decode($json, true);
}

function saveProjectData($data) {
    file_put_contents('../contacts.json', json_encode($data, JSON_PRETTY_PRINT));
}
?>
