<?php
class App
{
    public function __construct()
    {
        $this->handleRequest();
    }

    private function handleRequest()
    {
        $url = !empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
        $urlArr = array_values(array_filter(explode('/', $url)));
        $method = $_SERVER['REQUEST_METHOD'];

        // Nếu là API
        if (!empty($urlArr) && $urlArr[0] === 'api') {
            unset($urlArr[0]); // remove 'api'
            $group = array_shift($urlArr); // admin hoặc user
            $controller = ucfirst(array_shift($urlArr));
            $params = $urlArr;

            $controllerFile = "app/controllers/api/$group/$controller.php";
            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                if (class_exists($controller)) {
                    $controllerInstance = new $controller();

                    // Xác định action theo RESTful
                    switch ($method) {
                        case 'GET':
                            if (isset($params[0]) && $params[0] !== '') {
                                $action = 'show';
                                $actionParams = [$params[0]];
                            } else {
                                $action = 'index';
                                $actionParams = [];
                            }
                            break;
                        case 'POST':
                            $action = 'store';
                            $actionParams = [];
                            break;
                        case 'PUT':
                            if (isset($params[0]) && $params[0] !== '') {
                                $action = 'update';
                                $actionParams = [$params[0]];
                            } else {
                                $this->response404("Thiếu mã để cập nhật.");
                                return;
                            }
                            break;
                        case 'DELETE':
                            if (isset($params[0]) && $params[0] !== '') {
                                $action = 'destroy';
                                $actionParams = [$params[0]];
                            } else {
                                $this->response404("Thiếu mã để xóa.");
                                return;
                            }
                            break;
                        default:
                            $this->response404("Phương thức không hỗ trợ.");
                            return;
                    }

                    if (method_exists($controllerInstance, $action)) {
                        call_user_func_array([$controllerInstance, $action], $actionParams);
                    } else {
                        $this->response404("Method '$action' not found in controller '$controller'.");
                    }
                } else {
                    $this->response404("Controller class '$controller' not found.");
                }
            } else {
                $this->response404("Controller file '$controllerFile' not found.");
            }
        } else {
            // Nếu là truy cập trang web (/, /login)
            if ($url === '/' || $url === '' || $url === '/login') {
                $file = 'app/controllers/web/login.php';
                if (file_exists($file)) {
                    require_once $file;
                } else {
                    $this->response404("File $file not found.");
                }
                exit;
            }
            if ($url === '/HSnhansu') {
                $file = 'app/controllers/web/HSnhansu.php';
                if (file_exists($file)) {
                    require_once $file;
                } else {
                    $this->response404("File $file not found.");
                }
                exit;
            }
            if (preg_match('#^/HSnhansu(?:/(ThemHSnhansu|SuaHSnhansu)(?:/([^/]+))?)?#', $url, $matches)) {
                $_GET['action'] = $matches[1] ?? '';
                $_GET['id'] = $matches[2] ?? '';
                $file = 'app/controllers/web/HSnhansu.php';
                if (file_exists($file)) {
                    require_once $file;
                } else {
                    $this->response404("File $file not found.");
                }
                exit;
            }
            // Route cho Lichsucongtac (web)
            if ($url === '/Lichsucongtac') {
                $file = 'app/controllers/web/Lichsucongtac.php';
                if (file_exists($file)) {
                    require_once $file;
                } else {
                    $this->response404("File $file not found.");
                }
                exit;
            }
            if (preg_match('#^/Lichsucongtac(?:/(ThemLichsucongtac|SuaLichsucongtac|XoaLichsucongtac)(?:/([^/]+))?)?#', $url, $matches)) {
                $_GET['action'] = $matches[1] ?? '';
                $_GET['id'] = $matches[2] ?? '';
                $file = 'app/controllers/web/Lichsucongtac.php';
                if (file_exists($file)) {
                    require_once $file;
                } else {
                    $this->response404("File $file not found.");
                }
                exit;
            }
            // Thêm các route khác nếu cần

            // Không khớp, trả về 404
            $this->response404("Trang không tồn tại.");
        }
    }

    private function response404($message)
    {
        // Nếu là API thì trả về JSON, còn lại trả về HTML
        if (
            isset($_SERVER['PATH_INFO']) &&
            strpos($_SERVER['PATH_INFO'], '/api/') === 0
        ) {
            http_response_code(404);
            echo json_encode(["error" => $message]);
        } else {
            http_response_code(404);
            echo "<h1>404 Not Found</h1><p>$message</p>";
        }
        exit;
    }
}