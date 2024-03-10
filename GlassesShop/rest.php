<?php
require './vendor/autoload.php';

use App\Webservice;

$urlParts = explode('/', $_SERVER['REQUEST_URI']);

$resource = $urlParts[4];
$resourceId = (isset($urlParts[5]) && is_numeric($urlParts[5])) ? (int) $urlParts[5] : 0;

$webservice = new Webservice();

/**
 * 1- Define METHOD
 * 2- Define RESOURCE
 * 3- Define Resource_ID
 */
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $data = handleGet($resource, $resourceId, $webservice);
        break;
    case 'POST':
        $postData = json_decode(file_get_contents("php://input"), true);
        $data = handlePost($resource, $postData, $webservice);
        break;
    case 'PUT':
        echo "Will update";
        break;
    case 'DELETE':
        echo "Will delete";
        break;

    default:
        echo 'not supported';
        break;
}

$statusCode = is_null($data) ? 404 : 200;
http_response_code($statusCode);
header('Content-Type: application/json');

if (!empty($data)) {
    echo json_encode($data);
}

/**
 * 
 * Get with no glass id (glass id = 0) => List all glasses
 * Get with glass id => get only single glass by id
 * 
 * @param type $resource
 * @param type $resourceId
 * @return type
 */
function handleGet($resource, $resourceId, $webservice) {
    if ($resource == 'glasses') {
        if ($resourceId != 0) {
            return $webservice->getSingleGlass($resourceId);
        }

        return $webservice->getGlasses();
    }

    return null;
}

function handlePost($resource, $postData, $webservice) {
    switch ($resource) {
        case 'glasses':
            if ($postData) {
                $result = $webservice->createGlass($postData);
                if ($result) {
                    return ["message" => "Glass created successfully"];
                } else {
                    return ["error" => "Failed to create glass"];
                }
            } else {
                return ["error" => "Invalid JSON data"];
            }
            break;

        default:
            return ["error" => "Invalid resource"];
    }
}
