<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file'])) {
        $content_dir = './Tools/uploads/';
        $tmp_file = $_FILES['files']['tmp_name'][0];
        if(!is_uploaded_file($tmp_file)){
            echo("Le fichier est introuvable");
        }
        $type_file = $_FILES['files']['type'][0];
        if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') && !strstr($type_file, 'png')){
            echo("Le fichier n'est pas une image");
        }
        $name_file = $_FILES['files']['name'][0];

        if(!move_uploaded_file($tmp_file, $content_dir . $name_file)){
            echo("Impossible de copier le fichier dans $content_dir");
        }

        echo "Le fichier a bien été uploadé";
        /*$errors = [];
        $path = './Tools/uploads/';
        $extensions = ['jpg', 'jpeg', 'png', 'gif'];

        $file_name = $_FILES['files']['name'][0];
        $file_tmp = $_FILES['files']['tmp_name'][0];
        $file_type = $_FILES['files']['type'][0];
        $file_size = $_FILES['files']['size'][0];
        $file_ext = strtolower(end(explode('.', $_FILES['files']['name'][0])));
        $file = $path . $file_name;
        //print_r($file_tmp . " " . $file);
        if (!in_array($file_ext, $extensions)) {
            $errors[] = 'Extension not allowed: ' . $file_name . ' ' . $file_type;
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size exceeds limit: ' . $file_name . ' ' . $file_type;
        }
        print_r($_FILES);
        if (empty($errors)) {
            $move = move_uploaded_file($file_tmp, $file);
            print_r($move);
            //print_r(move_uploaded_file($file_tmp, $file));
            /*if(move_uploaded_file($file_tmp, $file)){
                echo"okokokok";
            } else {
                echo"erreur😭😭";
            }*/
            
     //   }

      //  if ($errors) print_r($errors);
    }
}

?>