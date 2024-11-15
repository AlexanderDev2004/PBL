<!-- ini untuk controller dosen -->
<?php

include_once '../models/dosen.php';

class controllersDosen
{
    public function index()
    {
        include "views/dosen/index.php";
        

    }

}