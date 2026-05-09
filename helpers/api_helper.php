<?php
require_once __DIR__ . '/jwt_helper.php';

class ApiHelper {
    
    /**
     * Authenticate the request using JWT from the Authorization header
     * Returns the user payload if valid, terminates request otherwise
     */
    public static function authenticate() {
        if (!function_exists('getallheaders')) {
            function getallheaders() {
                $headers = [];
                foreach ($_SERVER as $name => $value) {
                    if (substr($name, 0, 5) == 'HTTP_') {
                        $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
                    }
                }
                return $headers;
            }
        }
        $headers = getallheaders();
        $authHeader = isset($headers['Authorization']) ? $headers['Authorization'] : '';
        
        if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
            $payload = JwtHelper::validate($token);
            if ($payload) {
                return $payload;
            }
        }

        self::sendResponse(false, "Unauthorized: Invalid or missing token", null, 401);
    }

    /**
     * Standard JSON response
     */
    public static function sendResponse($success, $message, $data = null, $code = 200) {
        http_response_code($code);
        echo json_encode([
            "status" => $success,
            "message" => $message,
            "data" => $data
        ]);
        exit;
    }
}
