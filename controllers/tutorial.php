<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/tutorial_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucwords("Cabang");

$_SESSION['menu_active'] = 28;
$_SESSION['sub_menu_active'] = 28;
$permit = get_akses_permits($_SESSION['user_type_id'],$_SESSION['sub_menu_active']);
switch ($page) {
	case 'list':
		get_header($title);
    $where = '';
		$query = select_config('tutorial', $where);
		$add_button = "tutorial.php?page=form";
		include '../views/tutorial/tutorial_list.php';
		get_footer();
	break;

	case 'form':
		get_header();

		$close_button = "tutorial.php?page=list";

		$id = (isset($_GET['id'])) ? $_GET['id'] : null;
		if($id){

      $where_tutorial_id = "WHERE tutorial_id = '$id'";
			$row = select_object_config('tutorial', $where_tutorial_id);

			$action = "tutorial.php?page=edit&id=$id";
		} else {

			//inisialisasi
			$row = new stdClass();

			$row->tutorial_name = false;
      $row->tutorial_video = false;

			$action = "tutorial.php?page=save";
		}

		include '../views/tutorial/tutorial_form.php';
		get_footer();
	break;

	case 'save':
		extract($_POST);

		$i_name = get_isset($i_name);

		$path = "../video/";
		$i_video_tmp = $_FILES['i_video']['tmp_name'];
		$i_video = ($_FILES['i_video']['name']) ? $_FILES['i_video']['name'] : "";
		$i_video = str_replace(" ","",$i_video);

		$date = time();

		if($i_video){
			$i_video_ = $date."_".$i_video;
		}else{
			$i_video_ = "";
		}
    $now_date = new_date();
		$data = "'',
					   '$now_date',
             '$i_name',
             '$i_video_',
             '".$_SESSION['user_id']."'";

			//echo $data;

		create_config('tutorial', $data);

		if($i_video){
			move_uploaded_file($i_video_tmp, $path.$i_video_);
      echo "string";
		}
		var_dump($_FILES);
		header("Location: tutorial.php?page=list&did=1");
	break;

	case 'edit':

		extract($_POST);

		$id = get_isset($_GET['id']);
		$i_name = get_isset($i_name);
    $where_tutorial_id = "WHERE tutorial_id = '$id'";
    $where_tutorial_id_ = "tutorial_id = '$id'";

    $path = "../video/";
		$i_video_tmp = $_FILES['i_video']['tmp_name'];
		$i_video = ($_FILES['i_video']['name']) ? $_FILES['i_video']['name'] : "";
		$i_video = str_replace(" ","",$i_img);

		$date = time();

	  if($i_video){
				      $i_video_ = $date."_".$i_video;
				      if(move_uploaded_file($i_video_tmp, $path.$i_video_)){
					            $get_video_old = select_config_by('tutorial', 'tutorial_name', $where_tutorial_id);
					if($get_video_old){
						if(file_exists($path.$get_img_old)){
							unlink("../video/" .$path.$get_video_old);
						}
					}

					$data = "tutorial_name = '$i_name',
							     tutorial_img = '$i_video_'";
				}
			}else{
        $data = "tutorial_name = '$i_name'";
			}
		update_config2('tutorial', $data, $where_tutorial_id_);
			header('Location: tutorial.php?page=list&did=2');



	break;

	case 'delete':
		$id = get_isset($_GET['id']);
		$path = "../video/";
    $where_tutorial_id = "WHERE tutorial_id = '$id'";
    $where_tutorial_id_ = "tutorial_id = '$id'";
    $get_video_old = select_config_by('tutorial', 'tutorial_name', $where_tutorial_id);
					if($get_video_old){
						if(file_exists($path.$get_video_old)){
							unlink("../video/" .$path.$get_video_old);
						}
					}
		delete_config('tutorial', $where_tutorial_id_);
		header('Location: tutorial.php?page=list&did=3');

	break;

  case 'play_video':
    $id = $_GET['id'];
    echo $id;
    break;
}

?>
