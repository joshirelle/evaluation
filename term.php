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

    <title>Term | Faculty Evaluation</title>

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
                <div class='container-fluid'>
                    <!-- Page Heading -->
                    <div class='d-sm-flex align-items-center justify-content-between mb-4'>
                        <h3 class=' mb-0 text-gray-800'>Settings</h3>
                    </div>

                    <div class='card shadow mb-4'>
                        <div class='card card-body'>
                            <div id="collapseExample">
                                <div class="card card-body">
                                    <div>
                                         
                                    </div>
                                    <form method="get">
                                        <div class='form-group row'>
                                            <div class='col-sm-6 mb-3 mb-sm-0'>
                                                <?php 
                                                    $sql_1 = 'SELECT * FROM school_year';
                                                    $stmt_1 = $pdo->prepare($sql_1);
                                                    $stmt_1->execute();
                                                ?>
                                                <p style='font-weight:bold; text-align: left; position: relative;'>ACADEMIC YEAR: <a href="#addStudentsModal" onclick="addModal()" class="btn btn-primary mb-2" data-toggle="modal" style="float: right; "><i class="fas fa-plus"></i> <span>Academic Year</span></a>
                                                <select class='form-control form-control-user' id='sy-option' name='sy'>
                                                <?php 
                                                    while($c_result = $stmt_1->fetch()) {
                                                     ?>
                                                       <option value="<?php echo $c_result['sy']; ?>" selected="<?php if($c_result['is_active'] == 1) { 'selected'; } ?> "><?php echo $c_result['sy']; ?></option>";
                                                     <?php
                                                    }
                                                ?>
                                                </select>
                                                </p>
                                       
                                            </div>
                                            <div class='col-sm-6'>
                                                <?php 
                                                    $sql_1 = 'SELECT termID, term FROM terms';
                                                    $stmt_1 = $pdo->prepare($sql_1);
                                                    $stmt_1->execute();
                                                    
                                                ?>
                                                <p style='font-weight:bold; text-align: left; margin-top: 22px;'>SEMESTER: 
                                                    <select class='form-control form-control-user' id='term-option' name='term'>
                                                    <?php 
                                                        while($c_result = $stmt_1->fetch()) {
                                                         ?>
                                                           <option value="<?php echo $c_result['term']; ?>"><?php echo $c_result['term']; ?></option>";
                                                         <?php
                                                        }
                                                    ?>
                                                    </select>
                                                </p>
                                            <button type="submit" class="btn btn-secondary" data-target="#collapseExample1" style="float: right;"><i class="fa fa-search" aria-hidden="true"></i> <span>Search</span></button>

                                            <!--  <a href="#addStudentsModal" onclick="addModal()" class="btn btn-primary" data-toggle="modal" style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i> <span>Add New</span></a>

                                             <a href="#" class="btn btn-info" style="float: right;"><i class="fa fa-check" aria-hidden="true"></i> <span>Set as active</span></a> -->

                                            <!-- <a href="#" class="btn btn-primary" data-toggle="collapse" data-target="#collapseExample1" style="float: right;"><i class="fa fa-search" aria-hidden="true"></i> <span>Search</span></a> -->
                                            </div>


                                        </div>
                                    </form>

                                     <!-- Add Modal HTML -->
                                    <div id="addStudentsModal" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <form method="POST" autocomplete="off">
                                            <div class="modal-header">
                                            <h4 class="modal-title">New Academic Year</h4>
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
                                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                            <input type="submit" class="btn btn-success btn-submit" id="btn-submit" name="btn-submit" value="Save">
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <!-- Add Modal HTML -->
                               <!--  <div id="addStudentsModal" class="modal fade">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <form action="addacadyear.php" method="POST">
                                        <div class="modal-header">
                                          <h4 class="modal-title">Add Students</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Academic Year</label>
                                                <input id="studnum" type="text" name="sy" placeholder="e.g. 0000-0000" class="form-control" required>
                                            </div>

                                            <div class="form-group">
                                               <?php 
                                                    $sql_1 = 'SELECT termID, term FROM terms';
                                                    $stmt_1 = $pdo->prepare($sql_1);
                                                    $stmt_1->execute();
                                                    
                                                ?>
                                                <label>Semester</label> 
                                                <select class='form-control form-control-user' id='term-option' name='termID'>
                                                <?php 
                                                    while($c_result = $stmt_1->fetch()) {
                                                     ?>
                                                       <option value="<?php echo $c_result['termID']; ?>"><?php echo $c_result['term']; ?></option>";
                                                     <?php
                                                    }
                                                ?>
                                                </select>
                                        </div>
                                        <div class="modal-footer">
                                          <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                          <input type="submit" class="btn btn-success" name="create" value="Save">
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>

                                <br /> -->
                                <?php
                                    $value = "";
                                    if (!isset($_GET["sy"]) && !isset($_GET["term"])) {
                                        $value = "collapse";
                                    }
                                ?>
                                <div class="<?php echo $value; ?>" id="collapseExample1">
                                    <div class="card card-body">
                                        <table class="table table-bordered table-striped" style="font-weight:bold;" id="result-table" width="100%" cellspacing="0">
                                <?php
                                    // Include config file
                                    require_once "connection.php";

                                    $sy = $_GET["sy"];
                                    $term = $_GET["term"];
                                    
                                    // Attempt select query execution
                                    $sql = "SELECT a.facNum, a.facID, CONCAT(a.fname, ' ', a.lname, ' ', IFNULL(a.mi, '')) fullname,
                                    a.deptID, b.deptcode
                                    FROM vw_faculties a
                                    INNER JOIN department b ON
                                    b.deptID = a.deptID
                                    INNER JOIN vweva c ON
                                    c.facID = a.facID
                                    WHERE c.sy = '$sy' AND
                                    c.term = '$term' AND
                                    a.is_deleted = 0
                                    AND EXISTS (SELECT * FROM vweva WHERE c.facNum = a.facNum)
                                    GROUP BY a.facNum, a.facID, fullname, a.deptID, b.deptcode
                                    ORDER BY fullname;
                                    ";

                                    //echo $sql;

                                    if ($result = $pdo->query($sql)) {
                                        if ($result->rowCount() > 0) {
                                            echo "<thead style='background:#A0B0E4; text-align:center; color:white'>";
                                            echo "<tr>";
                                            echo "<th>Faculty Name</th>";
                                            echo "<th>Department</th>";
                                            echo "<th>Action</th>";
                                            echo "</tr>";
                                            echo "</thead>";
                                            echo "<tbody>";
                                            while ($row = $result->fetch()) {
                                            echo "<tr>";
                                            echo "<td>" . $row['fullname'] . "</td>";
                                            echo "<td>" . $row['deptcode'] . "</td>";
                                            echo "<td>";
                                            echo "<a href='overallsum.php?faculty={$row['facNum']}&department={$row['deptID']}' class='btn btn-success mr-1'  title='View Result'  data-toggle='tooltip'>View Result</a>";
                                            echo "</td>";
                                            echo "</tr>";
                                            }
                                        echo "</tbody>";
                                        echo "</table>";
                                        // Free result set
                                        unset($result);
                                        } else {
                                         echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                        }
                                        } else {
                                        echo "Oops! Something went wrong. Please try again later.";
                                        }

                                        // Close connection
                                        unset($pdo);
                                ?>
                                    
                                </table>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class='row'>
                        <div cass='col'>
                            <div class='card border-primary ml-3' style='width: 230%;'>
                                <div class='card-header bg-primary text-white'> Current Term </div>
                                <div class='card-body'>
                                    <h5 class='card-title'>Special title treatment</h5>
                                    <p class='card-text'>With supporting text below as a natural lead-in to additional content.</p>
                                </div>
                            </div>
                        </div>
                            </div> -->
                        </div><!-- /.container-fluid -->
                    </div><!-- End of Main Content -->
                    <!-- Footer -->
                    <footer class='sticky-footer bg-white'>
                        <div class='container my-auto'>
                            <div class='copyright text-center my-auto'>
                                <span>Copyright &copy; FACULTY PERFORMANCE EVALUATION SYSTEM 2023</span>
                            </div>
                        </div>
                    </footer>
                    <!-- End of Footer -->
                </div>
                <!-- End of Content Wrapper -->
        </div><!-- End of Main Content -->


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



    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <!-- <script src="vendor/chart.js/Chart.min.js"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script> -->
    
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
        });

        $("#btn-submit").on("click", function(e) {
            e.preventDefault();

            var acadYear = document.querySelector('#acad-year');
            var termID = document.querySelector('#add_term');
            var isActiveChecked = $('#isActiveChecked').is(":checked")

            var isActive = 0;
            if (isActiveChecked == true) {
                isActive = 1;
            }
            
            if ($(acadYear).val() != "") {
                if ($(termID).val() != 0) {
                    $.ajax({
                        type: "POST",
                        url: 'addterm.php',
                        data: {acadYear: $(acadYear).val(), termID: $(termID).val(), isActive: isActive},
                        success: function(succ) {
                            if (succ == "success") {
                                location.reload();
                            }else{
                                alert(succ);
                                $(acadYear).focus();
                            }
                        },
                        error: function(err){
                            alert(err);
                        }
                    });
                }else{
                    alert("Semester is required");
                    $(termID).focus();
                }
            }else{
                alert("Academic Year is required");
                $(acadYear).focus();
            }
        });

    </script>                                   
</body>

</html>