<?php
require_once "../config/constant.php";
class enrollment extends Dbh
{
  private $id;
  private $student_id;
  private $instructor_id;
  public function add_enrollment($course_id, $student_id, $instructor_id, $email, $title)
  {
    $sql = "INSERT INTO enrollments (course_id,student_id,instructor_id) VALUES (?,?,?)";
    $st = $this->connect(DNS, DB_USERNAME, PASSWORD)->prepare($sql);
    $res = $st->execute(array($course_id, $student_id, $instructor_id));
    if ($res) {

      // Send Email 
      $msg = "You enrolled in $title course" . " \n" . "We wish you more progress and knowledge";
      // use wordwrap() if lines are longer than 70 characters
      $msg = wordwrap($msg, 70);

      // send email
      self::send_email($email, "Enrollment", $msg);


      $_SESSION['email'] = "<div class='text-success'>The email sent successfully</div>";
      return true;
    }
    return false;

  }
  static public function send_email($email, $subject, $msg)
  {

    require '../mailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;
    $mail->SMTPDebug = 0;
    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'mariamehab26122003@gmail.com';                 // SMTP username
    $mail->Password = 'wiub yoij koxr axrp';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port =587 ;                                    // TCP port to connect to

    $mail->setFrom('mariamehab26122003@gmail.com', 'Mariam Ehab');
    $mail->addAddress($email, 'User');     // Add a recipient

    $mail->addReplyTo('mariamehab26122003@gmail.com', 'Information');

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $subject;
    $mail->Body = $msg;

    if (!$mail->send()) {
      return false;
    } else {

      return true;
    }
  }


  public function get_all_enrollment()
  {
    $sql = "SELECT e.id,s.name ,s.email,c.title  FROM enrollments AS e JOIN users AS s ON s.id=e.student_id   JOIN courses AS c ON c.id=e.course_id  ";
    $st = $this->connect(DNS, DB_USERNAME, PASSWORD)->prepare($sql);
    $res = $st->execute(array());
    $enroll = [];
    if ($res) {
      $enroll = $st->fetchAll(PDO::FETCH_ASSOC);


    }
    return $enroll;
  }

  public function get_enrollment($inst_id)
  {
    $sql = "SELECT name ,email,title  FROM enrollments AS e JOIN users AS s ON s.id=e.student_id   JOIN courses AS c ON c.id=e.course_id WHERE  e.instructor_id=? ";
    $st = $this->connect(DNS, DB_USERNAME, PASSWORD)->prepare($sql);
    $res = $st->execute(array($inst_id));
    $enroll = [];
    if ($res) {
      $enroll = $st->fetchAll(PDO::FETCH_ASSOC);

    }
    return $enroll;
  }

  public function get_enrollment_by_inst_id($cour_id, $inst_id)
  {
    $sql = "SELECT * FROM enrollments WHERE course_id=? AND instructor_id=?";
    $st = $this->connect(DNS, DB_USERNAME, PASSWORD)->prepare($sql);
    $res = $st->execute(array($cour_id, $inst_id));
    $enroll = [];
    if ($res) {
      $enroll = $st->fetchAll(PDO::FETCH_ASSOC);
    }
    return $enroll;

  }
  public function get_enrollment_by_student_id($student_id)
  {

    $sql = "SELECT c.id,c.title,inst.name,inst.id AS inst,c.description FROM enrollments AS  e JOIN users AS s on  e.student_id=s.id JOIN courses AS c on e.course_id=c.id JOIN users AS inst on inst.id=e.instructor_id  WHERE student_id=?";
    $st = $this->connect(DNS, DB_USERNAME, PASSWORD)->prepare($sql);
    $res = $st->execute(array($student_id));
    $enroll = [];
    if ($res) {
      $enroll = $st->fetchAll(PDO::FETCH_ASSOC);
    }
    return $enroll;
  }



  public function delete_enrollment($id)
  {

    $sql = 'DELETE FROM enrollments WHERE id=?';
    $st = $this->connect(DNS, DB_USERNAME, PASSWORD)->prepare($sql);
    $res = $st->execute(array($id));
    if ($res) {
      return true;
    }
    return false;


  }






}










?>