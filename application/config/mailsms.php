<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


// Config variables

$config['mailsms'] = array(
    'student_admission' => 'student_admission',
    'exam_result' => 'exam_result',
    'fee_submission' => 'fee_submission',
    'absent_attendence' => 'absent_attendence',
    'login_credential' => 'login_credential',
    'fees_reminder' => 'fees_reminder',
    'homework' => 'homework',
);



$config['attendence'] = array(
    'present' => 1,
    'late_with_excuse' => 2,
    'late' => 3,
    'absent' => 4,
    'holiday' => 5,
    'half_day' => 6
);


$config['attendence_exam'] = array(
  
    'absent' => 'absent'
    
);
$config['perm_category'] = array('can_view', 'can_add', 'can_edit', 'can_delete');

$config['bloodgroup'] = array('1' => 'O+', '2' => 'A+', '3' => 'B+', '4' => 'AB+', '5' => 'O-', '6' => 'A-', '7' => 'B-', '8' => 'AB-');
