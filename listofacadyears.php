<?php 
  require_once "php/core.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="img/csta-logo.ico" type="image/x-icon">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Active Faculty | Faculty Evaluation</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include_once "includes/sidebar.php" ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php include_once "includes/header.php" ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-flex justify-content-between mb-2 align-items-center" >
                        <h1 class="h3 mb-2 text-gray-800">Academic Years</h1>
                        <div class="mb-2">
                            <a href="#AcadYearModal" onclick="addModal()" class="btn btn-primary" id="btn-add" name="btn-add" data-toggle="modal">
                                <i class="fas fa-plus"></i> Academic Year<span></span></a>                  
                        </div>
                    </div>
                    
                    <!-- Academic Years DataTales-->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered font-weight-bold text-gray-800" id="activefaculty-table" width="100%" cellspacing="0">
                                    <?php
                                        // Attempt select query execution
                                        $sql = "SELECT syID, sy, termID, is_active FROM school_year WHERE is_deleted = 0";
                                        try {
                                            $stmt = $pdo->query($sql);
                                            $output = "";
                                            if ($stmt->rowCount() > 0) {
                                                $output .= "<thead style='background:#C37C4D; font-weight:bold; text-align:center; color:white'>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Academic Year</th>
                                                                    <th>Semester</th>
                                                                    <th>Active</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>";
                                                            $i = 1;
                                                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                                $semester = ($row['termID'] == 1) ? "First Semester" : "Second Semester";
                                                                $isActive = ($row['is_active'] == 1) ? "Yes" : "No";
                                                                $output .= "<tr>
                                                                                <td class='text-center'>{$i}</td>
                                                                                <td class='text-center col-md-4'>{$row['sy']}</td>
                                                                                <td class='text-center col-md-4'>{$semester}</td>
                                                                                <td class='text-center'>{$isActive}</td>
                                                                                <td class='text-center'>
                                                                                    <a href='#AcadYearModal' data-toggle='modal' class='btn btn-info mr-1' id='btn-update' title='Update Record' 
                                                                                    data-toggle='tooltip' data-id=".$row['syID']."><i class='fas fa-edit'></i> Update</a>
                                                                                    <a href='deleteacadyear.php?syID={$row['syID']}' class='btn btn-danger mr-1' 
                                                                                    title='Update Record'><i class='fas fa-trash'></i> Delete</a>
                                                                                </td>
                                                                            </tr>";
                                                                $i++;
                                                            }
                                                $output .= "</tbody>";

                                                echo $output;
                                            } else {
                                                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                            }
                                        } catch (PDOException $e) {
                                            echo "Error: " . $e->getMessage();
                                        }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Add Academic Year Modal HTML -->
                    <div id="AcadYearModal" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" id="acad-year-form" autocomplete="off">
                                    <div class="modal-header">
                                        <h4 class="modal-title"></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Academic Year:</label>
                                            <input id="acad-year" type="text" name="acad-year" placeholder="e.g 2000-20001" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Semester</label><br>
                                            <select id="add_term" name="term" class="form-control"></select>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="isActiveChecked" checked>
                                            <label class="form-check-label" for="isActiveChecked">
                                                Is Active
                                            </label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="button" class="btn btn-default" data-dismiss="modal" id="btn-cancel" name="btn-cancel" value="Cancel">
                                        <input type="submit" class="btn btn-success btn-submit" id="btn-submit" name="btn-submit" value="Save">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                      <span>Copyright &copy; FACULTY PERFORMANCE EVALUATION SYSTEM 2023</span>                    
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

  <!-- ajax -->
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <!-- <script src="js/demo/datatables-demo.js"></script> -->
    <script src="js/function.js"></script>

    
    <!-- ajax -->
  <script>
    $(document).ready(function() {
        $.ajax({
            type: "GET",
            url: 'getterm.php',
            data: {},
        }).done(function(response) {
            //clear deptcode combobox
            $('#add_term').html('');

            //add all to combobox
            let data = "<option value='0'>Select Semester</option>";
            let info = data+response;
            $('#add_term').html(info);
        });

        $("#btn-add").on("click", function(e) {
            $("#AcadYearModal").attr("action-name", "add");
        });

        $("#btn-submit").on("click", function(e) {
            e.preventDefault();

            var acadYear = document.querySelector('#acad-year');
            var termID = document.querySelector('#add_term');
            var isActiveChecked = $('#isActiveChecked').is(":checked")
            var actionName = $("#AcadYearModal").attr("action-name");
            
            var isActive = 0;
            if (isActiveChecked == true) {
                isActive = 1;
            }

            // if ($(acadYear).val() != "") {
            //     if ($(termID).val() != 0) {
            //         $.ajax({
            //             type: "POST",
            //             url: 'addterm.php',
            //             data: {acadYear: $(acadYear).val(), termID: $(termID).val(), isActive: isActive},
            //             success: function(succ) {
            //                 if (succ == "success") {
            //                     location.reload();
            //                 }else{
            //                     alert(succ);
            //                     $(acadYear).focus();
            //                 }
            //             },
            //             error: function(err){
            //                 alert(err);
            //             }
            //         });
            //     }else{
            //         alert("Semester is required");
            //         $(termID).focus();
            //     }
            // }else{
            //     alert("Academic Year is required");
            //     $(acadYear).focus();
            // }
        });

        $("#btn-update").on("click", function(e) {
            $("#AcadYearModal").attr("action-name", "edit");
        });

        $(document).delegate("[href='#AcadYearModal']", "click", function() {
            var syID = $(this).attr('data-id');

            $.ajax({
                type: "POST",
                url: 'getacadyear.php',
                data: {syID: syID}, 
                success: function(data) {
                    data = JSON.parse(data);

                    $("#AcadYearModal [name=\"acad-year\"]").val(data.sy);
                    $("#AcadYearModal [name=\"term\"]").val(data.termID);
                }
            });
        });

        $("#btn-cancel").on("click", function(e) {
            $("#AcadYearModal").removeAttr("action-name");
        });
    })
  </script>
</body>
</html>