<?php
function loadProjectData() {
    if (!file_exists('../projects.json')) {
        return ['projects' => []];
    }
    $json = file_get_contents('../projects.json');
    return json_decode($json, true);
}

function saveProjectData($data) {
    file_put_contents('../projects.json', json_encode($data, JSON_PRETTY_PRINT));
}
?>
