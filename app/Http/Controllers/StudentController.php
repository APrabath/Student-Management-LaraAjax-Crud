<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function store(Request $request){


      $file =$request->file('avatar');
      $fileName = time() .'.'. $file->getClientOriginalExtension();
      $file->storeAs('public/images', $fileName);

      $stuData =[

        'first_name'=> $request->fname,
        'last_name'=> $request->lname,
        'email'=> $request->email,
        'avatar'=> $fileName,

      ];

       student::create($stuData);

       return response()->json([
          'status'=>200,

       ]);

    }



    public function fetchAll(){

        $students=Student::all();
        $response ='';

        if($students->count()> 0 ){

            $response .="<table id='stuTable' class='display'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>";

            foreach($students as $student){

            $response.="<tr>
                <td>".$student->id."</td>
                <td><img src='storage/images/".$student->avatar."' width='50px' height='50px' class='img-thumbnail rounded-circle'></td>
                <td>".$student->first_name." ".$student->last_name."</td>
                <td>".$student->email."</td>
                <td><a href='#' id='".$student->id."' class='btn btn-success userEditBtn' data-bs-toggle='modal' data-bs-target='#editStudentModal'>Edit</a> |

                <a href='#' id='".$student->id."' class='btn btn-danger deleteBtn'>Delete</a>

                </td>
              </tr>";

            }

            $response.= "</tbody>
                 </table>";

     echo $response;

     } else{

         echo "<h3 align='center'> No Records in the Database</h3>";

            }
        }


  public function edit(Request $request){

   $userID=$request->id;

   $student=Student::find($userID);
   return response()->json($student);

   }


 public function update(Request $request){

    $fileName='';

     $student= Student::find($request->user_id);

     if($request->hasFile('avatar')){

    $file =$request->file('avatar');
    $fileName= time().'.'.$file->getClientOriginalExtension();
    $file->storeAs('public/images',$fileName);
    if($student->avatar){
        Storage::delete('public/images/'. $student->avatar);
    }


     }

     else{
         $fileName=$student->avatar;
     }

     $stuData =[

        'first_name'=> $request->fname,
        'last_name'=> $request->lname,
        'email'=> $request->email,
        'avatar'=> $fileName,

      ];


      $student->update($stuData);

      return response()->json([
        'status'=>200,

     ]);


 }


function delete(Request $req){

    $id=$req->id;

    $stuData=Student::find($id);

    if(Storage::delete('public/images/'. $stuData->avatar)){

        Student::destroy($id);
        return response()->json([
            'status'=>'ok',
        ]);

    }else{

        return response()->json([
            'status'=>'error',
        ]);

    }


}



    }

