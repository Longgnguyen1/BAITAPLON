<!-- Base controller -->
<?php
 class Controller{
    //goi model
    function model($model){
        if (file_exists('app/models/' . $model . '.php'))//kiểm tra xem có tồn tại file model trong thư mục app/models ko
        {//nếu có
            require_once 'app/models/' . $model . '.php';//gọi file 
            if (class_exists($model))//Kiểm tra class của model
            {
                $model = new $model();
                return $model;
            }
        }
        return false;
    }

    //goi view
    function view($view, $data)
    {
        if (!empty($data)) extract($data);
        if (file_exists('app/views/' . $view . '.php'))
        {
            require_once 'app/views/' . $view . '.php';
        }
    }
}