<?php
    require_once('../core/init.php');
    ob_start();
    if(($user_role_id_session !== 1)) {
        header('location: login.php?error=accessdenied');
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../public/assets/images/qcplLogo.png" type="image/x-icon">
    <title>Clients</title>
    <?php
        require_once 'includes/sidebar.php';
        $file_destination = '';
        if(isset($_POST['add_emoji'])){
            $add_unicode_name = mysqli_real_escape_string($conn, $_POST['add_unicode_name']);

            //validate profile picture
            $file = $_FILES['add_image'];
            $file_name = $_FILES['add_image']['name'];
            $file_tmp_name = $_FILES['add_image']['tmp_name'];
            $file_size = $_FILES['add_image']['size'];
            $file_error = $_FILES['add_image']['error'];
            $file_type = $_FILES['add_image']['type'];

            $file_ext = explode('.', $file_name);
            $file_actual_ext = strtolower(end($file_ext));

            $allowed = array('jpg', 'jpeg', 'png',);

            if($_FILES["add_image"]["error"] == 4) {
                //means there is no file uploaded
                $error_message = "Emoji Image is required.";
                echo "<script type='text/javascript'>alert('$error_message');</script>";
                $file_destination = '';
            }
            if(empty($add_unicode_name)){
                $error_message = "Unicode Name is required.";
                echo "<script type='text/javascript'>alert('$error_message');</script>";
            }

            //if all condition is met, update the profile
            if(!empty($add_unicode_name)){
                if(in_array($file_actual_ext, $allowed)) {
                    if($file_error === 0) {
                        if($file_size < 5000000) {
                            $file_name_new = $add_unicode_name. "." .$file_actual_ext;
                            $file_destination = '../../public/assets/images/emojis/' .$file_name_new;
                            move_uploaded_file($file_tmp_name, $file_destination);

                            // Read JSON file
                            $jsonData = file_get_contents('../web-scraping/emoji.json');

                            // Decode JSON data
                            $data = json_decode($jsonData, true);

                            // Loop through each emoji object
                            foreach ($data['emoji'] as $key => $emoji) {
                                if ($emoji['Unicode name'] == $add_unicode_name) {
                                    $add_char = $emoji['Char'];
                                    $add_image = $emoji['Image[twemoji]'];
                                    $add_unicode_codepoint = $emoji['Unicodecodepoint'];
                                    $add_occurrences = $emoji['Occurrences[5...max]'];
                                    $add_position = $emoji['Position[0...1]'];
                                    $add_negative = $emoji['Neg[0...1]'];
                                    $add_neutral = $emoji['Neut[0...1]'];
                                    $add_positive = $emoji['Pos[0...1]'];
                                    $add_sentiment_score = $emoji['Sentiment score[-1...+1]'];
                                    $add_unicode_name = $emoji['Unicode name'];
                                    $add_unicode_block = $emoji['Unicode block'];
                                    $add_remarks = '';

                                    $sql = "INSERT INTO emoji (image_path, _char, image, unicode_codepoint, occurrences, _position, negative, neutral, positive, sentiment_score, unicode_name, unicode_block, remarks) VALUES ('$file_destination', '$add_char', '$add_image', '$add_unicode_codepoint', $add_occurrences, $add_position, $add_negative, $add_neutral, $add_positive, $add_sentiment_score, '$add_unicode_name', '$add_unicode_block', '$add_remarks');";
                            
                                    if(mysqli_query($conn, $sql)){
                                        // echo '../web-scraping/remarks-html-dom.php?remarks=' .$url_unicode_name;
                                        // header('location: emoji.php?add=successful');
                                        $hypen_unicode = str_replace(' ', '-', $add_unicode_name);
                                        $small_caps_unicode = strtolower($hypen_unicode);
                                        $emoji_id = mysqli_insert_id($conn);
                                        echo $small_caps_unicode;
                                        // header('location: ../web-scraping/remarks-html-dom.php');
                                        // header('location: ../web-scraping/remarks-html-dom.php');
                                        header('location: ../web-scraping/remarks-html-dom.php?remarks=' .$small_caps_unicode. '&emoji_id=' .$emoji_id);
                                        // die();

                                    }
                                }
                            }
                            
                        }else {
                            $error_message = "Your file is too big.";
                            echo "<script type='text/javascript'>alert('$error_message');</script>";
                        }
                    }else {
                        $error_message = "There was an error uploading your file.";
                        echo "<script type='text/javascript'>alert('$error_message');</script>";
                    }
                }else{
                    $error_message = "You cannot upload file of this type.";
                    echo "<script type='text/javascript'>alert('$error_message');</script>";
                }
            }
        }
    ?>
    <!-- start of main section container -->
    <div class="container-fluid mt-3">
        <!-- start of add service modal button -->
        <button type="button" class="btn btn-primary mb-3 mt-3" data-bs-toggle="modal" data-bs-target="#add_emoji_modal">Add Client</button>
        <!-- end of add service modal button -->
        <!-- start of first row -->
        <div class="row">
            <!-- start of second container -->
            <div class="container">
                <!-- start of second row -->
                <div class="row">
                    <!-- start of div on center -->
                    <div class="col-md-12">
                        <!-- start of table -->
                        <table class="table table-bordered table-striped" id="datatable">
                            <!-- start of table header -->
                            <thead>
                                <tr>
                                    <th class="table-light text-uppercase text-center">client id</th>
                                    <th class="table-light text-uppercase text-center">first name</th>
                                    <th class="table-light text-uppercase text-center">middle name</th>
                                    <th class="table-light text-uppercase text-center">last name</th>
                                    <th class="table-light text-uppercase text-center">suffix</th>
                                    <th class="table-light text-uppercase text-center">age range</th>
                                    <th class="table-light text-uppercase text-center">gender</th>
                                    <th class="table-light text-uppercase text-center">education</th>
                                    <th class="table-light text-uppercase text-center">occupation</th>
                                    <th class="table-light text-uppercase text-center">status</th>
                                    <th class="table-light text-uppercase text-center">date added</th>
                                    <th class="table-light text-uppercase text-center">last updated</th>
                                </tr>
                            </thead>
                            <!-- end of table header -->
                            <!-- start of table body -->
                            <tbody>
                            <?php
                                $sql_select = "SELECT * FROM client ORDER BY client_id DESC;";
                                $result_select = mysqli_query($conn, $sql_select);
                                if(mysqli_num_rows($result_select) > 0){
                                    while($row_select = mysqli_fetch_assoc($result_select)){
                                        $client_id = $row_select['client_id'];
                                        $f_name = $row_select['f_name'];
                                        $m_name = $row_select['m_name'];
                                        $l_name = $row_select['l_name'];
                                        $suffix = $row_select['suffix'];
                                        $age_id = $row_select['age_id'];
                                        $gender = $row_select['gender'];
                                        $education = $row_select['education'];
                                        $occupation = $row_select['occupation'];
                                        $status = $row_select['status'];
                                        $created_at = $row_select['created_at'];
                                        $updated_at = $row_select['updated_at'];
                            ?>
                                        <tr>
                                            <td class="text-center"><?= $client_id ?></td>
                                            <td class="text-center"><?= $f_name ?></td>
                                            <td class="text-center"><?= $m_name ?></td>
                                            <td class="text-center"><?= $l_name ?></td>
                                            <td class="text-center"><?= $suffix ?></td>
                                            <td class="text-center"><?= $age_id ?></td>
                                            <td class="text-center"><?= $gender ?></td>
                                            <td class="text-center"><?= $education ?></td>
                                            <td class="text-center"><?= $occupation ?></td>
                                            <td class="text-center"><?= $status ?></td>
                                            <td class="text-center"><?= $created_at ?></td>
                                            <td class="text-center"><?= $updated_at ?></td>
                                        </tr>
                            <?php
                                    }
                                }else{
                            ?>
                                <tr>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="" class="text-center d-none"></td>
                                    <td colspan="11" class="text-center">No records found.</td>
                                </tr>
                            <?php
                                }
                            ?>
                            </tbody>
                            <!-- end of table body -->
                        </table>
                        <!-- end of table -->
                    </div>
                    <!-- end of div on center -->
                </div>
                <!-- end of second row -->
            </div>
            <!-- end of second container -->
        </div>
        <!-- end of first row -->
    </div>
    <!-- end of main section container -->
</div>
<!-- end of main container -->
<?php
    require_once 'js/scripts.php';
?>
    <script src="js/question-scripts.js"></script>
</body>
</html>