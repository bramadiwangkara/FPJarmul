<?php
   $destination_path = getcwd().DIRECTORY_SEPARATOR . "/upload/";
   $fi = new FilesystemIterator($destination_path, FilesystemIterator::SKIP_DOTS);

   if(iterator_count($fi)<4){
      // echo "<script>";
      // echo "console.log('".iterator_count($fi)."')";
      // echo "</script>";

      $result = 0;
 
      $target_path = $destination_path . basename( $_FILES['myfile']['name']);
   
      if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {
         $result = 1;
         echo "<script>alert('Upload berhasil!'); myFunction()</script>";
      }
   
      sleep(1);
   }
   else{
      echo "<script>alert('Jumlah maksimum file upload adalah 4!');</script>";
      return;
   }

   
 
   
?>