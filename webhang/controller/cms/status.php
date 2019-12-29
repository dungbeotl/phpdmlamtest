<?php
session_start();
include_once('../../model/db.php');
include_once('../../model/status.php');
$target_dir = "../../upload/product/";
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $action = $_REQUEST['action'];
  if ($action == 'add') {
    $status = new status(null, $_REQUEST['content'], $_REQUEST['user_post']);
    status::add($status);
    //image::add(new image(null, $product->id, $url_target . $file_name_image));
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  } else if ($action == "delete") {
    status::delete($_REQUEST['id']);
  } else if ($action == "edit") {
    $status = status::getStatusById($_REQUEST['id']);

    $status->content = $_REQUEST['content'];
    $status->user_post = $_REQUEST['user_post'];

    status::update($status);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  } else if ($action == "view-edit") {
    $status = status::getStatusById($_REQUEST['id']);
    //$status = status::getList();

    echo '<form method="POST" action="http://localhost:90/projectsphp/webbanhang/webhang/controller/cms/status.php" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addStatusModal">Add Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id" value="' . $status->id . '">
        <div class="form-group">
            <label for="content">Content</label>
            <input type="text" class="form-control" value="' . $status->content . '" id="content" name="content" placeholder="Enter Content">
          </div>
          <div class="form-group">
            <label for="user_post">User post</label>
            <input type="text" class="form-control" value="' . $status->user_post . '" id="user_post" name="user_post" placeholder="Enter user Post">
          </div>
    
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </form>';
  }
}
