<?php
include_once('../layout/cms-header.php');
include_once('../layout/cms-sidebar.php');
include_once('../layout/cms-topbar.php');
include_once('../../../model/status.php');
$list = status::getList();
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 d-sm-flex align-items-center justify-content-between mb-4">
        Tables status
        <button data-toggle="modal" data-target="#addStatus" class="btn btn-primary btn-icon-split">
            <span class="text">Add New</span>
        </button>
        <!-- Modal -->
        <div class="modal fade" id="addStatus" tabindex="-1" role="dialog" aria-labelledby="addStatusModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <!-- Form add new    -->
                <form method="POST" action="http://localhost:90/projectsphp/webbanhang/webhang/controller/cms/status.php" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addStatusModal">Add Status</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="action" value="add">
                            <div class="form-group">
                                <label for="content">Content</label>
                                <input type="text" class="form-control" id="content" name="content" placeholder="Enter content">
                            </div>
                            <div class="form-group">
                                <label for="user_post">User post</label>
                                <input type="text" class="form-control" id="user_post" name="user_post" placeholder="Enter user post">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Status</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Content</th>
                            <th>User post</th>
                            <th width="120px">Action</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Content</th>
                            <th>User post</th>
                            <th width="120px">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($list as $value) { ?>
                            <tr>
                                <td><?= $value->id ?></td>
                                <td><?= $value->content ?></td>
                                <td><?= $value->user_post ?></td>
                                <td>
                                    <button class="btn btn-danger" onclick="confirm('aaa')?deleteStatus(<?= $value->id ?>):alert('xxx')" data-id="<?= $value->id ?>"><i class="fa fa-trash"></i>Delete</button>
                                    <button class="btn btn-warning" onclick="editStatus(<?= $value->id ?>)" data-id="<?= $value->id ?>"><i class="fa fa-pencil-alt"></i> Edit</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editStatus" tabindex="-1" role="dialog" aria-labelledby="editStatusModal" aria-hidden="true">
        <div class="modal-dialog" role="document">

        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php
include_once('../layout/cms-footer.php');
?>
<script>
    function deleteStatus(id) {
        $.post("http://localhost:90/projectsphp/webbanhang/webhang/controller/cms/status.php", {
            id: id,
            action: "delete"
        }, function(data) {
            // console.log(data);
            alert("delete success");
            location.reload();
        });
    }

    function editStatus(id) {
        $.post("http://localhost:90/projectsphp/webbanhang/webhang/controller/cms/status.php", {
            id: id,
            action: "view-edit"
        }, function(data) {

            $("#editStatus .modal-dialog").html(data);
            $("#editStatus").modal('show');
        });
    }
    $(document).ready(function() {
        console.log("asdasdasd");
    });
</script>
</body>

</html>