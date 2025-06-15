<?php
function loadError($error)
{
    if (file_exists('app/errors/' . $error . '.php'));
        require_once 'app/errors/' . $error . '.php';
}

function redirect($path = 'index.php')
{
    header("Location: $path");
    exit;
}

function isPost()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
        return true;
    return false;
}

function isGet()
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
        return true;
    return false;
}

function filter() {
    $filterArr = [];
    if(isGet()) {
        if(!empty($_GET)) {
            foreach($_GET as $key => $value) {
                $key = strip_tags($key);
                if(is_array($value)) {
                    $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                } else {
                    $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }

    }
    
    if(isPost()) {
        if(!empty($_POST)) {
            foreach($_POST as $key => $value) {
                $key = strip_tags($key);
                if(is_array($value)) {
                    $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                } else {
                    $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }

    }

    return $filterArr;
}
