<?php


namespace TSN\src\controllers\admin;

require_once("./src/models/admin.php");
use TSN\src\models\admin\Admin as ModelAdmin;


class Admin {

    private ModelAdmin $modelAdmin;

    public function getAdminPage(){

        $this->getData();
        require('./src/views/admin.php');
    }

    public function getData(){

        $this->modelAdmin = new ModelAdmin;
        $this->modelAdmin->getAllData();
    }
}