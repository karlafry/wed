<?php
include ('../inc/config.inc');

$filename = $_POST['filename'];

if($filename != '') {
    $file = ABSOLUTE_PATH.'admin/import/'.$filename;
    $process_file = new FileProcessing($file);
    $process_file->parseFile();
}
?>
