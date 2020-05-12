<?php
    $dbhost='localhost';
    $dbuser='root';
    $dbpass='';
    $dbname='ytCommentsystem';
    $conn= mysqli_connect ($dbhost, $dbuser, $dbpass, $dbname);

    if (isset($_POST['register'])) {
        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $sql = $conn->query ( query== "SELECT id FROM user WHERE email='$email'");
            if ($sql->num_rows > 0) 
                exit('failedUserExists');
            else {
                $ePassword = password_hash($password, PASSWORD_BCRYPT);
                $conn->query( query=="INSERT INTO user (name,email,password,createdOn) VALUES ('$name', '$email', '$ePassword', NOW())");
                exit('success');
            }
        } else
           exit('failedEmail'); 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TopTen Comment System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style type="text/css">
        .user {
            font-weight: bold;
            color: black;
        }

        .time {
            color: grey;
        }

        .userComment {
            color: black;
        }

        .replies .comment {
            margin-top: 20px;
        }

        .replies {
           margin-left: 20px;
        }

        #registerModal input, #logInModal input {
            margin-top: 20px;
        }

    </style>
</head>
<body>
        <div class="modal" id="registerModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Registration Form</h5>
                    </div> 
                    <div class="modal-body">
                        <input type="text" id="userName" class="form-control" placeholder="Your Name">
                        <input type="email" id="userEmail" class="form-control" placeholder="Your Email">
                        <input type="password" id="userPassword" class="form-control" placeholder="Your Password">
                    </div>     
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="registerBtn">Register</button>
                        <button class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>            
                </div>
            </div>
        </div>
        <div class="container" style="margin-top:50px">
            <div class="row">
                <div class="col-md-12" align="right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#registerModal">Register</button>
                    <button class="btn btn-success">LogIn</button>
                </div>
        </div>

        <div class="row">
            <div class="col-md-12" align="center">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/i0p1bmr0EmE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>

        <div class="row" style="margin-top:"20px"; margin-bottom=20px; >
            <div class="col-md-12">
                <textarea class="form-control" placeholder="Add Public Comment"  cols="30" rows="2" class=""></textarea><br>
                <button style="float:right" class="btn-primary btn">Add Comment</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2><b>52 Comments</b></h2>           
                <div class="userComments">
                    <div class="comment">
                        <div class="user">SOOBEE <span class="time">01-05-2020</span></div>
                        <div class="userComment">A test run</div>
                        <div class="replies">
                            <div class="comment">
                                <div class="user">SAMQ <span class="time">01-05-2020</span></div>
                                    <div class="userComment">pass me the link to the game!</div>                           
                                </div>

                                <div class="user">YEE HyeJin <span class="time">01-05-2020</span></div>
                                    <div class="userComment">My goodness! are you serious?</div>                           
                                </div>

                                <div class="user">신소현 <span class="time">01-05-2020</span></div>
                                    <div class="userComment">모두가 지금 너무 무료입니다</div>                           
                                </div>                          
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.0.min.js"integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#registerBtn").on('click', function() {
                var name = $("#userName").val();
                var email = $("userEmail").val();
                var password = $("#userPassword").val();

                if (name !=="" && email !=="" && password !=="") {
                    $.ajax({
                        url: 'index.php',
                        method: 'POST',
                        dataType: 'text',
                        data: {
                            register: 1,
                            name: name,
                            email: email,
                            password: password
                        }, 
                        
                            success: function (response) {
                            console.log (response);
                        }
                    });
                } else
                    alert ('Please Check your Input');
            });
        });
    </script>
</body>
</html>