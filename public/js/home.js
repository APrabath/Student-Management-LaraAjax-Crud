$(document).ready( function () {


    //new student add process

            $('#add_student_form' ).submit(function(e){

            e.preventDefault();
            const fd= new FormData(this);

            $('#add_student_btn').text('Adding...');

            $.ajax({

                url: '/store',
                method:'post',
                data:fd,
                cache:false,
                contentType:false,
                processData:false,
                dataType:'json',
                success:function(response){

                    if(response.status==200){

                      Swal.fire(
                        'Added !',
                        'Student Added Successfully !',
                        'Success'
                    )

                $('#add_student_btn').text('Add Student');
                $('#add_student_form' )[0].reset();
                $('#addStudentModal').modal('hide');
                fetchAllStudents();

                    }

                }
            });

            });





    //student edit process

            $(document).on('click', '.userEditBtn', function(e){
                e.preventDefault();
                var id=$(this).attr('id');

                $.ajax({
                   url:'/edit',
                   method: 'get',
                   data: {
                    id:id,_token:'{{ csrf_token() }}'
                },
                success: function(response){

                    $("#fname").val(response.first_name);
                    $("#lname").val(response.last_name);
                    $("#email").val(response.email);
                    $("#avatar").html(
                        `<img src="storage/images/${response.avatar}" width="100px" height="100px" class="img-fluid img thumbnail">`
                    );

                    $('#user_id').val(response.id)
                }

                });


            });




    //student update process

        $('#update_student_form' ).submit(function(e){

           e.preventDefault();
           const fd= new FormData(this);

           $('#update_student_btn').text('Updating...');

           $.ajax({

           url: '/update',
           method:'post',
           data:fd,
           cache:false,
           contentType:false,
           processData:false,
           dataType:'json',
           success:function(response){

            if(response.status==200){

              Swal.fire(
                'Updated !',
                'Student Updated Successfully !',
                'Success'
            )

        $('#update_student_btn').text('Update Student');
        $('#update_student_form' )[0].reset();
        $('#editStudentModal').modal('hide');
        fetchAllStudents();

            }

        }
    });

    });


            fetchAllStudents();

            function fetchAllStudents(){

             $.ajax({

             url:'/fetchall',
             method:'get',
             success: function(response){
                $('#show_all_data').html(response);
                $('#stuTable').DataTable();


               }

           });
            }




    //student delete process

    $(document).on('click','.deleteBtn', function(e){
    e.preventDefault();

    let id=$(this).attr('id');
    let csrf='{{ csrf_token() }}';


    Swal.fire({
    title:'Are you sure?',
    text:"You won't be able to revet this !",
    icon:"warning",
    showCancelButton:true,
    confirmButtonColor:'red',
    confirmButtonText:'Yes, Delete it!',
    cancelButtonColor:'green',

    }).then((result=>{
      if(result.isConfirmed){

        $.ajax({
            url:'/delete',
            method:'delete',
            data: {
                id:id         },

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(response){
                console.log(response);
                Swal.fire(
                    'Deleted!',
                    'Student has been deleted!',
                    'success',
                );

                fetchAllStudents();
            }

        });

      }

    }));

    });

        });
