<?php 
Class Post extends CI_model
{
  public function __construct()
  {
    $this->load->library('form_validation');
  }
  public function create_post($post_content)
  {
    $config = array(array(
                         'field' => 'comment', 
                         'label' => 'Post Comment', 
                         'rules' => 'trim|required'
                        )
                 );
    $this->form_validation->set_rules($config);
    if ($this->form_validation->run() == FALSE)
    {
      $data["post_created"] = FALSE;
      $data["error_message"] = validation_errors();
    }
    else
    {
      $post_data = array(
          						   'user_id'  	=> $post_content['post_created_for'],
          						   'created_by' => $post_content['post_created_by'],
          						   'content'    => $post_content['comment'],
          						   'created_at' => date("Y-m-d H:i:s"),
          						   'updated_at' => date("Y-m-d H:i:s")
                        );
      if($this->db->insert('posts', $post_data))
      {
        $data["post_created"] = TRUE;
        $data["success_message"] = "Post created successfully!";
      } 
		}
    return $data;	
  }

  function get_post_details_by_id($id)
  {
    $user_fetch_query = "SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC";
    return $this->db->query($user_fetch_query, $id)->result_array();
  }

  function get_user_id_with_post_id($post_id)
  {
    return($this->db->query("SELECT user_id FROM posts WHERE id = ?", $post_id )->row_array());
  }  
}
?>