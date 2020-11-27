<?php
// https://filext.com/faq/office_mime_types.html
// https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Complete_list_of_MIME_types
 
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

$config['adm_digit_length'] = 6;
$config['exam_type']        = array(
    'basic_system'        => lang('basic_system'),
    'school_grade_system' => lang('school_grade_system'),
    'coll_grade_system'   => lang('coll_grade_system'),
    'gpa'                 => lang('gpa'),
); 

$config['image_validate'] = array(
    'allowed_mime_type' => array('image/jpeg', 'image/jpg', 'image/png'), //mime_type
    'allowed_extension' => array('jpg', 'jpeg', 'png','gif','bmp','svg','JPG', 'JPEG', 'PNG','GIF','BMP','SVG','Jpg', 'Jpeg', 'Png','Gif','Bmp','Svg'), // image extensions
    'upload_size'       => 1048576, // bytes
);

$config['csv_validate'] = array(
    'allowed_mime_type' => array('application/vnd.ms-excel',
                                'text/plain',
                                'text/csv',
                                'text/tsv'), //mime_type
    'allowed_extension' => array('csv'), // image extensions
    'upload_size'       => 1048576, // bytes
);

$config['file_validate'] = array(
    'allowed_mime_type' => array(
        'application/pdf',
        'application/msword',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'image/jpeg',
        'image/jpg',
        'image/png'
    ), //mime_type
    'allowed_extension' => array('pdf', 'doc', 'xls', 'docx', 'xlsx','jpg', 'jpeg', 'png','gif','bmp','svg','PDF', 'DOC', 'XLS', 'DOCX', 'XLSX','JPG', 'JPEG', 'PNG','GIF','BMP','SVG','Pdf', 'Doc', 'Xls', 'Docx', 'Xlsx','Jpg', 'Jpeg', 'Png','Gif','Bmp','Svg'), // image extensions
    'upload_size'       => 1048576, // bytes
);
