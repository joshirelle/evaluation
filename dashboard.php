<?php
    require_once "php/core.php";
    
    $sql = '
        SELECT
            (SELECT COUNT(DISTINCT studnum) FROM vweva WHERE EXISTS (SELECT * FROM students WHERE students.studnum = vweva.studnum AND is_deleted = 0)) AS student_finished_evaluating,
            (SELECT COUNT(DISTINCT facID) FROM vweva WHERE EXISTS (SELECT * FROM faculty WHERE faculty.facID = vweva.facID AND is_deleted = 0)) AS faculty_evaluated,
            (SELECT COUNT(*) FROM students) AS total_students,
            (SELECT COUNT(*) FROM faculty WHERE is_deleted = 0) AS active_faculty,
            (SELECT COUNT(*) FROM faculty WHERE is_deleted = 1) AS inactive_faculty;
    ';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
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

    <title>Faculty Evaluation</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h3 class=" mb-0 font-weight-bold text-gray-800">Dashboard</h3>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card shadow">
                                <div class="card border-dark-brown text-gray-800">
                                    <div class="card-body">
                                        <?php 
                                            $sy="";
                                            $term="";
                                            $sql_1 = "SELECT * FROM school_year WHERE is_active = 1";
                                            $stmt_1 = $pdo->prepare($sql_1);
                                            $stmt_1->execute();
                                            while($c_result = $stmt_1->fetch()) :
                                                $sy=$c_result["sy"];
                                                $term= ($c_result["termID"] == 1) ? "First Semester" : "Second Semester";
                                            endwhile;
                                        ?>
                                        <p style="font-weight:bold; text-align: left;">ACADEMIC YEAR: <?=$sy?>
                                        <span style="float:right; margin-right: 200px"> SEMESTER: <?=$term?> </span></p>
                                        <p class="pt-2"style="font-weight:bold;">Evaluation Status: - </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-dark-brown shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-large font-weight-bold text-dark-brown text-uppercase mb-1"><i class="fas fa-light fa-users nav-icon mr-3"></i> Total no. of Students</div>
                                                <div class="h5 mb-0 font-weight-bold text-right text-gray-900"><?php echo $result['student_finished_evaluating'] . '/' . $result['total_students']; ?></div>
                                        </div>
                                        <div class="col-auto">
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-large font-weight-bold text-success text-uppercase mb-1"><i class="fas fa-light fa-check nav-icon mr-3"></i> Evaluated Faculty </div>
                                            <div class="h5 mb-0 font-weight-bold text-right text-gray-900"><?php echo $result['faculty_evaluated'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <!--image-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-large font-weight-bold text-info text-uppercase mb-1"><i class="fas fa-light fa-users nav-icon mr-2"></i> Active Faculty </div>
                                            <div class="h5 mb-0 font-weight-bold text-right text-gray-900"><?php echo $result['active_faculty'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <!--image-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-large font-weight-bold text-warning text-uppercase mb-1"><i class="fas fa-user-slash nav-icon mr-2"></i> Inactive Faculties </div>
                                                <div class="h5 mb-0 font-weight-bold text-right text-gray-900"><?php echo $result['inactive_faculty'] ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                            $sql = 'SELECT * FROM department WHERE EXISTS (SELECT * FROM vweva WHERE department.deptID = vweva.deptID) AND is_deleted = 0;';
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();
                            $departments = $stmt->fetchAll();
                            if (!empty($departments)) {
                                foreach ($departments as $department) {
                        ?>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <h5 class="card-title font-weight-bold text-gray-800">Top Result - <?php echo $department['deptcode']; ?></h5>
                                        <table class="table table-striped table-bordered font-weight-bold text-gray-800">
                                            <thead class="text-white"style="background:#C37C4D; text-align:center;">
                                                <tr>
                                                    <th style="width: 80px;">Rank</th>
                                                    <th style="width: 500px;">Faculty</th>
                                                    <th>Rating</th>
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql = "
                                                    SELECT 
                                                    CONCAT(faculty.fname, ' ', faculty.lname) AS faculty, AVG(c.choices) AS rating 
                                                    FROM eva 
                                                    INNER JOIN faculty ON 
                                                    faculty.facNum  = eva.fmID
                                                    INNER JOIN choice c ON
                                                    c.choicesID = eva.choicesID
                                                    WHERE faculty.deptID = ?
                                                    GROUP BY eva.fmID
                                                    ORDER BY rating DESC
                                                    LIMIT 3;
                                                    ";  

                                                    $stmt = $pdo->prepare($sql);
                                                    $stmt->execute([$department['deptID']]);
                                                    $faculties = $stmt->fetchAll();
                                                    if (!empty($faculties)) {
                                                        $rank = 1;
                                                        foreach ($faculties as $faculty) {
                                                            $sql = "SELECT * FROM choice WHERE choices=ROUND(?);";
                                                            $stmt = $pdo->prepare($sql);
                                                            $stmt->execute([$faculty['rating']]);
                                                            $remarksResult = $stmt->fetch();
                                                ?>
                                                <tr>
                                                    <td><?php echo $rank; ?></td>
                                                    <td><?php echo $faculty['faculty']; ?></td>
                                                    <td><?php echo number_format($faculty['rating'], 2); ?></td>
                                                    <td><?php echo $remarksResult['description']; ?></td>
                                                </tr>
                                                <?php $rank++; }} ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }} ?>
                </div><!-- /.container-fluid -->
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
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script src="js/function.js"></script>
</body>

</html>