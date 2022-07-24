<?php

class IndexController extends Controller{

    private $pageTpl = "/views/home.php";

    public function __construct() {
        $this->model = new IndexModel();
        $this->view = new View();
    }

    public function index() {
        $this->pageData['users'] = $this->model->getAllUsers();
        $this->view->render($this->pageTpl, $this->pageData);
    }

    public function add()
    {
        if($_FILES) {
            if($_FILES['csv']['type'] != 'text/csv' || $_FILES['csv']['type'] == '') {
                $this->pageData['errors'] = "Ошибка! Возможно данный файл имеет некорректный формат";
            } else {
                if(move_uploaded_file($_FILES['csv']['tmp_name'],UPLOAD_FOLDER.$_FILES['csv']['name'])) {
                    $file = fopen(UPLOAD_FOLDER.$_FILES['csv']['name'], "r");
                    $row = 1;
                    while($data = fgetcsv($file, 200, ",")) {
                        if($row == 1) {
                            $row++;
                            continue;
                        } else {
                            $this->model->addFromCSV($data);
                        }
                    }
                    fclose($file);
                    $this->model->getAllUsers();
                }
            }
            header("Location: /");
        }
    }

    public function delete()
    {
        $this->model->delete();
    }

    public function download()
    {
        $var = $this->model->getAllUsers();

        function array_to_csv_download($array, $filename = "export.csv", $delimiter=",") {
            $f = fopen('php://memory', 'w');
            foreach ($array as $line) {
                fputcsv($f, $line, $delimiter);
            }
            fseek($f, 0);
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="'.$filename.'";');
            fpassthru($f);
        }

        array_to_csv_download($var);
    }

}


