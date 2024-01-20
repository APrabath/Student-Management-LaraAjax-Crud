<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.23/dist/sweetalert2.min.css" rel="stylesheet">

    <title>Lara Ajax</title>
  </head>
  <body style="background-image: url('{{ asset('https://www.itl.cat/pngfile/big/250-2507513_teacher-with-students-hd.jpg')}}');">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Logo</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
            </ul>

          </div>
        </div>
      </nav>


<div class="container">
    <div class="row">

        <div class="col-md-12">

            <div class="card mt-4 shadow">

                <div class="card-header d-flex justify-content-between">

                    <h5>Student Management</h5>

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                        <i class="bi bi-plus-circle-dotted"></i> Add New Student
                    </button>

                </div>

                <div class="card-body">
                    <div id="show_all_data"></div>
                </div>
              </div>



  <!--Add New Student Modal -->
  <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>


        <form action="#" method="POST" id="add_student_form" enctype="multipart/form-data">

        <div class="modal-body">
              @csrf

              <div class="row">
                <div class="col-lg">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" class="form-control" required>
                </div>

                <div class="col-lg">
                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" class="form-control" required>
                </div>
              </div>


              <div class="row">
                <div class="col-lg">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
              </div>

              <div class="row">

                <div class="col-lg">
                    <label for="avatar">Avatar</label>
                    <input type="file" name="avatar" class="form-control" required>
                </div>

              </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="add_student_btn">Add Student</button>
        </div>

    </form>


      </div>
    </div>
  </div>


<!--Edit Student Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>


        <form action="#" method="POST" id="update_student_form" enctype="multipart/form-data">

        <div class="modal-body">
              @csrf

              <input type="hidden" name="user_id" id="user_id">

              <div class="row">
                <div class="col-lg">
                    <label for="fname">First Name</label>
                    <input type="text" id="fname" name="fname" class="form-control" required>
                </div>

                <div class="col-lg">
                    <label for="lname">Last Name</label>
                    <input type="text" id="lname" name="lname" class="form-control" required>
                </div>
              </div>


              <div class="row">
                <div class="col-lg">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
              </div>

              <div class="row">

                <div id="avatar"></div>

                <div class="col-lg">
                    <label for="avatar">Avatar</label>
                    <input type="file" name="avatar" class="form-control" >
                </div>

              </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="update_student_btn">Update Student</button>
        </div>

    </form>


      </div>
    </div>
  </div>


        </div>

    </div>
</div>







    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.23/dist/sweetalert2.all.min.js"></script>




    <script src="js/home.js"></script>





</body>

</html>
