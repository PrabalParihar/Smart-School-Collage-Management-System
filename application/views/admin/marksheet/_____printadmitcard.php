<?php 
if(!empty($student_details)){
	foreach ($student_details as $student_key => $student_value) {
	?>
    <style type="text/css">
    	*{padding: 0; margin:0;}
    	body{}
    	.tableone{}
    	.tableone td{padding:5px 10px}
    	table.denifittable  {border: 1px solid #999;border-collapse: collapse;}
    	.denifittable th {padding: 10px 10px; font-weight: normal;  border-collapse: collapse;border-right: 1px solid #999; border-bottom: 1px solid #999;}
		.denifittable td {padding: 10px 10px; font-weight: bold;border-collapse: collapse;border-left: 1px solid #999;}

	.mark-container{
      width: 1000px;position: relative;z-index: 2; margin: 0 auto; padding: 20px 30px;padding: 0; margin:0; font-family: arial; color: #000; font-size: 14px; line-height: normal;}

 .tcmybg {
    background:top center;
    background-size: 100% 100%;
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  z-index: 1;
}
.tablemain{position: relative;z-index: 2}

    </style>

	<div class="mark-container">
	<img src="<?php echo base_url('uploads/admit_card/'.$admitcard->background_img); ?>" class="tcmybg" width="100%" height="100%" />
		<table cellpadding="0" cellspacing="0" width="100%" class="tablemain">
		  <tr>
		  	<td valign="top">
		  		<table cellpadding="0" cellspacing="0" width="100%">
		  			<tr>
		  				<td valign="top" align="center"><img src="<?php echo base_url('uploads/admit_card/'.$admitcard->left_logo); ?>" width="100" height="100"></td>
		  				<td valign="top">
		  					<table cellpadding="0" cellspacing="0" width="100%">
		  						<tr>
									<td valign="top" style="font-size: 26px; font-weight: bold; text-align: center; text-transform: uppercase; padding-top: 10px;"><?php echo $admitcard->heading; ?></td>
								</tr>
								<tr><td valign="top" height="5"></td></tr>
								<tr>
									<td valign="top" style="font-size: 20px;text-align: center; text-transform: uppercase; text-decoration: underline;">
									<?php echo $admitcard->title; ?></td>
								</tr>
		  					</table>
		  				</td>
		  				<td valign="top" align="center"><img src="<?php echo base_url('uploads/admit_card/'.$admitcard->right_logo); ?>" width="100" height="100"></td>
		  			</tr>
		  		</table>
		  	</td>
		  </tr>
		
		  <tr>
			<td valign="top" style="text-align: center; text-transform: capitalize; text-decoration: underline; font-weight: bold; padding-top: 5px;"><?php echo $admitcard->exam_name; ?></td>
		  </tr>

			<tr><td valign="top" height="10"></td></tr>
			
			<tr>
		    	<td valign="top">
				    <table cellpadding="0" cellspacing="0" width="100%" style="text-transform: uppercase;">
				    	<tr>
				    		<td valign="top">
				    			 <table cellpadding="0" cellspacing="0" width="100%" >
				    			 	<tr>
										<td valign="top" width="25%" style="padding-bottom: 10px;"><?php echo $this->lang->line('roll_no')?></td>
										<td valign="top" width="30%" style="font-weight: bold;padding-bottom: 10px;"><?php echo $student_value->roll_no; ?></td>
										<td valign="top" width="20%" style="padding-bottom: 10px;"><?php echo $this->lang->line('admission_no')?></td>
										<td valign="top" width="25%" style="font-weight: bold;padding-bottom: 10px;"><?php echo $student_value->admission_no; ?></td>
									</tr>
				    			 	<tr>
				    			 		<td valign="top" style="padding-bottom: 10px;"><?php echo $this->lang->line('name_prefix');?></td>
				    			 		<td valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;"><?php echo $student_value->firstname." ".$student_value->lastname; ?></td>
				    			 	</tr>

				    			 	<tr>
				    			 		<td valign="top" style="padding-bottom: 10px;"><?php echo $this->lang->line('d_o_b');?></td>
				    			 		<td valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;"><?php echo $student_value->dob; ?></td>
				    			 		<td valign="top" style="padding-bottom: 10px;"><?php echo $this->lang->line('gender')?></td>
				    			 		<td valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;"><?php echo $student_value->gender; ?></td>
				    			 	</tr>

				    			 	<tr>
				    			 		<td valign="top" style="padding-bottom: 10px;">Father's Name</td>
				    			 		<td valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;"><?php echo $student_value->father_name; ?></td>
				    			 	
				    			 		<td valign="top" style="padding-bottom: 10px;">Mother's Name</td>
				    			 		<td valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;"><?php echo $student_value->mother_name; ?></td>
				    			 	</tr>
				    			 	<tr>
				    			 		<td valign="top" style="padding-bottom: 10px;">Address</td>
				    			 		<td colspan="3" valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;"><?php echo $student_value->current_address; ?></td>
				    			 	</tr>
				    			 	<tr>
				    			 		<td valign="top" style="padding-bottom: 10px;">School Name</td>
				    			 		<td valign="top" colspan="3" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;"><?php echo $admitcard->school_name; ?></td>
				    			 	</tr>
				    			 	<tr>
				    			 		<td valign="top" style="padding-bottom: 10px;">Exam Centre</td>
				    			 		<td valign="top" colspan="3" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;"><?php echo $admitcard->exam_center; ?></td>
				    			 	</tr>
				    			 </table>
				    		</td>

				    		<td valign="top" width="25%" align="right">
				    		
				    			<img src="<?php echo base_url() . $student_value->image; ?>" width="100" height="130" style="border: 2px solid #fff;
    outline: 1px solid #000000;">
    			
				    		</td>
				    	</tr>
				    </table>
				</td>
			</tr>

		  <tr><td valign="top" height="10"></td></tr>
		  <tr>
		  	<td valign="top">
		  		<table cellpadding="0" cellspacing="0" width="100%" class="denifittable">

		  			<tr>
		  				<th valign="top" style="text-align: center; text-transform: uppercase;">Theory Exam Date & Time</th>
		  				<th valign="top" style="text-align: center; text-transform: uppercase;">Paper Code</th>
		  				<th valign="top" style="text-align: center; text-transform: uppercase;">Subject</th>
		  				<th valign="top" style="text-align: center; text-transform: uppercase;">Opted By Student</th>
		  			</tr>
<?php 


foreach ($exam_subjects as $subject_key => $subject_value) {
	?>
	<tr>
		  				<td valign="top" style="text-align: center;"><?php echo $subject_value->date_from." ". $subject_value->time_from; ?></td>
		  				<td style="text-align: center;text-transform: uppercase;"><?php echo $subject_value->subject_code; ?></td>
		  				<td style="text-align: left;text-transform: uppercase;"><?php echo $subject_value->subject_name; ?></td>
		  				<td style="text-align: center;text-transform: uppercase;"><?php echo $subject_value->subject_type; ?></td>
		  			</tr>
	<?php 

}
		  			 ?>

		  		
		  		</table>
		  	</td>
		 </tr> 	
		 <tr><td valign="top" height="5"></td></tr>	
		 <tr>
		 	<td valign="top">Important Note:</td>
		 </tr>
		 <tr>
		 	<td valign="top">
		 		<ol style="padding-left: 15px; padding-top: 5px; font-size: 12px; line-height: 18px;">
		 			<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</li>
		 			<li>The leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing </li>
		 			<li>Visit the official web page of the CBSE (central board of secondary education).</li>
		 			<li>Visit the official web page of the CBSE (central board of secondary education).</li>
		 			<li>Visit the official web page of the CBSE (central board of secondary education).</li>		
		 		</ol>
		 	</td>
		 </tr>		
		 <tr><td valign="top" height="20px"></td></tr>
		 <tr>
		  	 <td align="right" valign="top">
		  	 	<table cellpadding="0" cellspacing="0" width="100%" style="text-align: center;">
		  	 		<tr>
		  	 			
		  	 			<td valign="top">
		  	 				<img src="<?php echo base_url('uploads/admit_card/'.$admitcard->sign); ?>" width="100" height="38"  />
		  	 				<p>Principal</p>
		  	 			</td>

		  	 			
		  	 		</tr>
		  	 	</table>
		  	 </td>
		  </tr>

		
		</table>
	</div>

	<?php 
	}
}

 ?>