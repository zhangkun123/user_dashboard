<?php 
Class Comment extends CI_model
{
   public function __construct()
   {
      $this->load->library('form_validation');
   }

   public function create_comment($comment_content)
   {
		$config = array(array('field' => 'reply', 
                            'label' => 'Post reply', 
                            'rules' => 'trim|required'
                            )
               );
      $this->form_validation->set_rules($config);
      if ($this->form_validation->run() == FALSE)
      {
		 	$data["comment_created"] = FALSE;
         $data["error_message"] = validation_errors();
      }
      else
      {
      	$comment_data = array(
							   'post_id' 	 => $comment_content['post_id'] ,
							   'created_by' => $comment_content['comment_created_by'] ,
							   'content'    => $comment_content['reply'] ,
							   'created_at' => date("Y-m-d H:i:s"),
							   'updated_at' => date("Y-m-d H:i:s")
			                 );
         if($this->db->insert('comments', $comment_data))
         {
            $data["comment_created"] = TRUE;
            $data["success_message"] = "Comment Created successfully!!!!";
         } 
      }
      return $data;   		
   }

   public function get_all_comments()
   {
   	return ( $this->db->get('comments')->result_array() );
   }
}