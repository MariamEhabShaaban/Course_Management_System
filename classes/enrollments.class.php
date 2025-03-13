<?php
require_once "../config/constant.php";
class enrollment extends Dbh{
  private $id;
  private $student_id;
  private $instructor_id;
  public function add_enrollment($course_id,$student_id,$instructor_id){
    $sql="INSERT INTO enrollments (course_id,student_id,instructor_id) VALUES (?,?,?)";
    $st= $this->connect(DNS,DB_USERNAME,PASSWORD)->prepare($sql);
    $res=$st->execute(array($course_id,$student_id,$instructor_id));
    if($res){
      return true;
    }
    return false;

  }
  public function get_enrollment($inst_id){
    $sql="SELECT name ,email,title  FROM enrollments AS e JOIN users AS s ON s.id=e.student_id   JOIN courses AS c ON c.id=e.course_id WHERE  e.instructor_id=? ";
    $st= $this->connect(DNS,DB_USERNAME,PASSWORD)->prepare($sql);
    $res=$st->execute(array($inst_id));
    $enroll=[];
    if($res){
        $enroll=$st->fetchAll(PDO::FETCH_ASSOC);
      
    }
  return $enroll;
  }

  public function get_enrollment_by_inst_id($cour_id,$inst_id){
     $sql= "SELECT * FROM enrollments WHERE course_id=? AND instructor_id=?";
     $st= $this->connect(DNS,DB_USERNAME,PASSWORD)->prepare($sql);
     $res=$st->execute(array($cour_id,$inst_id));
     $enroll=[];
     if($res){
      $enroll=$st->fetchAll(PDO::FETCH_ASSOC);  
     }
     return $enroll;

  }
  public function get_enrollment_by_student_id($student_id){
  
    $sql= "SELECT c.id,c.title,inst.name,inst.id AS inst,c.description FROM enrollments AS  e JOIN users AS s on  e.student_id=s.id JOIN courses AS c on e.course_id=c.id JOIN users AS inst on inst.id=e.instructor_id  WHERE student_id=?";
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