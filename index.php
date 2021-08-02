<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>REGISTRATION FORM</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>  
</head>
<body>
    <div class="container" style="margin-top: 50px;">
        <h4 class="text-center"><u>REGISTRATION FORM</u></h4><br>
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="home" href="#">HOME</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/user.php">REGISTRATION LIST</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">SIGN IN</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">UPDATES</a>
      </li>
    </ul>
  </div>
</nav>
        <br>
        <h5><u>HOME</u></h5>
        <div class="card card-default">
            <div class="card-body">
                <form id="addUser"  method="POST" action="">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group mb-2">
                                <label for="name" class="sr-only">Name</label>
                                <input id="fname" type="text" class="form-control" name="fname" placeholder="First name"
                                required autofocus>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group mb-2">
                                <label for="name" class="sr-only">Name</label>
                                <input id="lname" type="text" class="form-control" name="lname" placeholder="Lastname"
                                required autofocus>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group mb-2">
                                <label for="name" class="sr-only">Phone number</label>
                                <input id="mobile" type="text" class="form-control" name="mobile" placeholder="Enter mobile"
                                required autofocus>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-group mb-2">
                                <label for="name" class="sr-only">Email</label>
                                <input id="email" type="text" class="form-control" name="email" placeholder="Enter email"
                                required autofocus>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group mb-2">
                                <label for="name" class="sr-only">Address</label>
                                <textarea class="form-control" name="adddress" placeholder="Enter address.." required autofocus></textarea>
                            </div>
                        </div>
                    </div>   
                    <button id="submitUser" type="button" class="btn btn-primary mb-2">Submit</button>
                </form>
            </div>
        </div>
        <br>
       
    </div>

    

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
         https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-database.js"></script>

    <script>

        // Initialize Firebase
        var config = {
            apiKey: "AIzaSyD3ylfu0mxzyFMXm5tZq6d-IOIv-arbZ1g",
            authDomain: "form-efb8a.firebaseapp.com",
            databaseURL:"https://form-efb8a-default-rtdb.firebaseio.com",
            projectId: "form-efb8a",
            storageBucket: "form-efb8a.appspot.com",
            messagingSenderId: "577988287906",
            appId: "1:577988287906:web:25daa6622b32278eace6fb",
            measurementId: "G-BBZ76G7L4T"
        };
        firebase.initializeApp(config);
        firebase.analytics();

        var database = firebase.database();

        var lastIndex = 0;

        // Get Data
        firebase.database().ref('Users/').on('value', function (snapshot) {
            var value = snapshot.val();
            var htmls = [];
            $.each(value, function (index, value) {
                if (value) {
                    htmls.push('<tr>\
                    <td>' + value.name + '</td>\
                    <td>' + value.email + '</td>\
                    <td><button data-toggle="modal" data-target="#update-modal" class="btn btn-info updateData" data-id="' + index + '">Update</button>\
                    <button data-toggle="modal" data-target="#remove-modal" class="btn btn-danger removeData" data-id="' + index + '">Delete</button></td>\
                </tr>');
                }
                lastIndex = index;
            });
            $('#tbody').html(htmls);
            $("#submitUser").removeClass('desabled');
        });

        // Add Data
        $('#submitUser').on('click', function () {
            var values = $("#addUser").serializeArray();
            var fname = values[0].value;
            var lname = values[1].value;
            var mobile = values[2].value;
            var email = values[3].value;
            var address = values[4].value;

            var userID = lastIndex + 1;

            firebase.database().ref('Users/' + userID).set({
                name: fname + " " + lname,
                email: email,
                mobile : mobile,
                address : address
            });

            // Reassign lastID value
            lastIndex = userID;
            $("#addUser input textarea").val("");
            // Send to user route
            window.location.href = "/user.php";
        });

        
    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>