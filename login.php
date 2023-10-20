<?php
    session_start();
    require_once './config/path.php';
    require_once './connection.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css\style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fasthand&family=Noto+Sans+KR:wght@500&family=Noto+Serif:wght@700&family=Old+Standard+TT:wght@700&display=swap" 
        rel="stylesheet">
        

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <title> LOGIN </title>

        <style>
            img{
	            width: 100%;
            }
            body{
                overflow: hidden;
            }
            .login {
                height: 1000px;
                width: 100%;
                background: #613633;
                position: relative;
            }
            .login_box {
                width: 1050px;
                height: 600px;
                position: absolute;
                top: 53%;
                left: 50%;
                transform: translate(-50%,-50%);
                background: #fff;
                border-radius: 10px;
                box-shadow: 1px 4px 22px -8px #0004;
                display: flex;
                overflow: hidden;
            }
            .login_box .left{
                width: 41%;
                height: 100%;
                padding: 25px 25px;
            }
            .login_box .right{
            width: 59%;
            height: 100%  
            }
            .left .top_link a {
                color: #452A5A;
                font-weight: 400;
            }
            .left .top_link{
                height: 20px
            }
            .left .contact{
	            display: flex;
                align-items: center;
                justify-content: center;
                align-self: center;
                height: 100%;
                width: 73%;
                margin: auto;
            }
            .left h3{
                text-align: center;
                margin-bottom: 40px;
            }
            .left input {
                border: none;
                width: 80%;
                margin: 15px 0px;
                border-bottom: 1px solid #613633;
                padding: 7px 9px;
                width: 100%;
                overflow: hidden;
                background: transparent;
                font-weight: 600;
                font-size: 14px;
            }
            .left{
	            background: linear-gradient(-45deg, #dcd7e0, #fff);
            }
           
            .submit {
                border: none;
                padding: 15px 70px;
                border-radius: 8px;
                display: block;
                margin: auto;
                margin-top: 120px;
                background: #613633;
                color: #fff;
                font-weight: bold;
                -webkit-box-shadow: 0px 9px 15px -11px rgba(88,54,114,1);
                -moz-box-shadow: 0px 9px 15px -11px rgba(88,54,114,1);
                box-shadow: 0px 9px 15px -11px rgba(88,54,114,1);
            }
            .right {    
	            color: #fff;
	            position: relative;
            }
            .right .right-text{ 
                height: 100%;
                position: relative;
                transform: translate(0%, 45%);
            }
            .right-text h2{ 
                display: block;
                width: 100%;
                text-align: center;
                font-size: 50px;
                font-weight: 1000;
                color: #613633;
                font-family: 'Times New Roman', Times, serif;
                padding-top: -50PX;
                margin-top: 30px;
            }
            .right-text img{
                margin-top: -525px;
                max-width: 25%;
            }
            .right-text h5{
                display: block;
                width: 100%;
                text-align: center;
                font-size: 19px;
                font-weight: 400;
            }
            .right .right-inductor{
                position: absolute;
                width: 70px;
                height: 7px;
                background: #fff0;
                left: 50%;
                bottom: 70px;
                transform: translate(-50%, 0%);
            }
            .top_link img {
                width: 28px;
                padding-right: 7px;
                margin-top: -3px;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid" style="height: 667px; background: #613633; position: relative;">
            <div class="login_box">
                <div class="left">
                    <div class="contact">
                        <?php 
                            $sy="";
                            $term="";
                            $sql_1 = "SELECT * FROM school_year WHERE is_active = 1";
                            $stmt_1 = $pdo->prepare($sql_1);
                            $stmt_1->execute();
                            while($c_result = $stmt_1->fetch()) :
                                $sy=$c_result["sy"];
                                $term=($c_result["termID"] == "1") ? "First Semester" : "Second Semester";
                            endwhile;
                        ?>

                        <form id="login-form" action="index1.php" method="POST">
                            <div>
                                <h3>S.Y <?php echo $sy; ?><br \><?php echo $term; ?></h3>
                            </div>
						    <input type="text" id="studentnum" class="form-control form-control-lg" placeholder="STUDENT NUMBER" required>
						    <input type="hidden" id="deptID" name="department">
                            <input type="text" id="deptname" name="departmentname" style="margin-right: 300px;"placeholder="DEPARTMENT" disabled>
						    <select class="form-select mt-4" id="faculty" name="faculty" required disabled>
                                    <option value="0">-- SELECT FACULTY --</option>
                            </select>
						    <button class="submit" name="btnSubmit" type="submit">Start Evaluation</button>
                        </form>
                    </div>
                </div>

                <div class="right">
                    <div class="right-text">
                        <h2>FACULTY EVALUATION SYSTEM</h2>
					    <center><img src="cstalogo-removebg-preview.png"></center>
                    </div>
                </div>
            </div>
        </div>

        <script src="bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery-3.6.4.min.js"></script>
        <!-- Custom JavaScript Files -->
        <script>const baseURL = "<?=BASE_URL?>";</script>
        <script src="./js/functions.js"></script>
        <script src="./js/login.js"></script>
    </body>
</html>