<?php
include ('../inc/config.inc');

$page_title = 'Import guest list';
include ('inc/admin_site_head.inc');

AdminUser::checkLoginStatus();

$import_dir = ABSOLUTE_PATH.'admin/import';

$validFilenames = array();
foreach (scandir($import_dir) as $filename) {
    if (!preg_match('/^.+\.csv$/', $filename)) {
        continue;
    }

    $validFilenames[] = $filename;
}

if(isset($_POST) && !empty($_POST)) {
    if(!empty($_FILES)) {
        $filename = str_replace(" ", "_", $_FILES['file_upload']['name']);
        $filename = str_replace("\'", "_", $filename);

        if (is_uploaded_file($_FILES['file_upload']['tmp_name'])) {
            move_uploaded_file($_FILES['file_upload']['tmp_name'], "$import_dir/$filename");
            $success = true;
        } else {
            $error_message = "<strong>Upload error.</strong> The selected file could not be correctly uploaded. Please report this to the site administrator.";
        }
    } else {
        $error_msg = "No File Selected";
    }
}
?>

<div class="main no-banner">
    <div class="row content">
        <div class="inner-wrap">
            <section class="twelvecol">
                <?php if($success) : ?>
                    <div class="alert alert-success">
                        <p>File uploaded successfully</p>
                    </div>
                <?php elseif ($error_msg != '') : ?>
                    <div class="alert alert-error">
                        <p><?=$error_msg?></p>
                    </div>
                <?php endif; ?>
                <form class="uploadFile" enctype="multipart/form-data" method="post">
                    <fieldset>
                        <label>Select File:</label>
                        <input type="file" name="file_upload">
                    </fieldset>

                    <fieldset>
                        <input type="submit" name="submit" value="Upload File">
                    </fieldset>
                </form>
            </section>

            <?php if(!empty($validFilenames)) :?>
                <section class="twelvecol">
                    <table class="file-list">
                        <thead>
                            <tr>
                                <th>Filename</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($validFilenames as $filename) :?>
                                <tr>
                                    <td><?=$filename?></td>
                                    <td><button value="<?=$filename?>" class="process-file">Process file</button></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </section>
            <?php endif; ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.file-list button.process-file').on('click', function(e) {
            e.preventDefault();

            var filename = jQuery(this).val();
            if(confirm('Please confirm you are about to process file '+filename)) {
                jQuery.ajax( {
                    url: 'process-file.php',
                    data: {filename : filename},
                    type: 'POST'
                }).success(function() {
                    jQuery('form.uploadFile').prepend('<div class="alert alert-success"><p>File processed successfully</p></div>');
                }).error(function(response) {
                    jQuery('form.uploadFile').prepend('<div class="alert alert-error"><p>'+response+'</p></div>');
                });
            }
        });
    });
</script>
<?php
include ('../inc/site_foot.inc');
?>
