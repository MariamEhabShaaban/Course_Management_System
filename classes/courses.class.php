<?php
require_once "../config/constant.php";
class course extends Dbh{

private $id;
private $title;
private $description;
private $instructor_id;

    public function all_courses($role ,$id){
        if($role=='admin'){
            $sql = "SELECT c.*,inst.name as inst_name FROM courses c JOIN users inst ON inst.id=c.instructor_id";
            $st=$this->connect(DNS,DB_USERNAME,PASSWORD)->prepare($sql);
            $st->execute();
            $courses=$st->fetchAll(PDO::FETCH_ASSOC);
            if($courses){
                return $courses;
            }


        }
        else if($role== 'instructor'){
            $sql = "SELECT * FROM courses WHERE instructor_id=?";
            $st=$this->connect(DNS,DB_USERNAME,PASSWORD)->prepare($sql);
            $st->execute(array($id));
            $courses=$st->fetchAll(PDO::FETCH_ASSOC);
            if($courses){
                return $courses;
            }

        }
        else if($role== 'student'){
            $sql = "SELECT * FROM courses WHERE studnet_id=?";
            $st=$this->connect(DNS,DB_USERNAME,PASSWORD)->prepare($sql);
            $st->execute(array($id));
            $courses=$st->fetchAll(PDO::FETCH_ASSOC);
            if($courses){
                return $courses;
            }
        }
        return false;
}
public function delete_course($id){
    $sql = 'DELETE FROM courses WHERE id=?';
    $st=$this->connect(DNS,DB_USERNAME,PASSWORD)->prepare($sql);
    $res=$st->execute(array($id));
    if($res){
        return true;
    }
    return false;

}

public function get_course($id){


}

public function create_course($title,$description,$instructor_id){
    $title=trim($title);
    if($title==""){
         return false;
    }
    $sql="INSERT INTO courses (title,description,instructor_id) VALUES (?,?,?)";
    $st=$this->connect(DNS,DB_USERNAME,PASSWORD)->prepare($sql);
    $res=$st->execute(array($title,$description,$instructor_id));
    if($res){
        return true;
    }
    return false;

}

public function update_course($title,$description,$id,$inst_id){
    $title=trim($title);
    if($title== "")
    {
        return false;
    }
    $sql= "UPDATE courses SET title=?,description=? WHERE id=? AND instructor_id=?";
    $st=$this->connect(DNS,DB_USERNAME,PASSWORD)->prepare($sql);
    $res=$st->execute(array($title,$description,$id,$inst_id));
    if($res){
        return true;
    }
    return false;




}

private function InputEmpty($title){
    $result=true;
    if(empty($title) ){
        $result=false;
    }
    
    return $result;
   }




public function get_available_corses_by_student_id($student_id){
  
    $sql= "WITH enroll AS ( SELECT * FROM enrollments WHERE student_id = ? ) SELECT c.*, inst.name as inst_name
     FROM courses AS c LEFT JOIN enroll AS e ON c.id = e.course_id LEFT JOIN users AS inst ON inst.id = c.instructor_id WHERE e.course_id IS NULL;;
    ";
    $st= $this->connect(DNS,DB_USERNAME,PASSWORD)->prepare($sql);
    $res=$st->execute(array($student_id));
    $enroll=[];
    if($res){
       
     $enroll=$st->fetchAll(PDO::FETCH_ASSOC);
    }
    return $enroll;
  }
}

?>