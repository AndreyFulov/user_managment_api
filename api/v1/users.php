<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../models/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$request_method = $_SERVER["REQUEST_METHOD"];

switch($request_method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $user->id = intval($_GET["id"]);
            if ($user->read_single()) {
                $user_arr = array(
                    "id" => $user->id,
                    "name" => $user->name,
                    "email" => $user->email,
                    "created_at" => $user->created_at
                );
                echo json_encode($user_arr);
            } else {
                echo json_encode(array("message" => "User not found."));
            }
        } else {
            $stmt = $user->read();
            $users_arr = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $user_item = array(
                    "id" => $id,
                    "name" => $name,
                    "email" => $email,
                    "created_at" => $created_at
                );
                array_push($users_arr, $user_item);
            }
            echo json_encode($users_arr);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        if (!empty($data->email) && !empty($data->password)) {
            $user->email = $data->email;
            $user->password = $data->password;
            if ($user->authenticate()) {
                echo json_encode(array("message" => "User authenticated.", "user_id" => $user->id));
            } else {
                echo json_encode(array("message" => "Invalid credentials."));
            }
        } else {
            $user->name = $data->name;
            $user->email = $data->email;
            $user->password = $data->password;
            $user->created_at = date('Y-m-d H:i:s');
            if ($user->create()) {
                echo json_encode(array("message" => "User was created."));
            } else {
                echo json_encode(array("message" => "Unable to create user."));
            }
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"));
        $user->id = $data->id;
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = $data->password;

        if ($user->update()) {
            echo json_encode(array("message" => "User was updated."));
        } else {
            echo json_encode(array("message" => "Unable to update user."));
        }
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"));
        $user->id = $data->id;

        if ($user->delete()) {
            echo json_encode(array("message" => "User was deleted."));
        } else {
            echo json_encode(array("message" => "Unable to delete user."));
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(array("message" => "Method Not Allowed"));
        break;
}
