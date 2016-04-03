<?php 
Class User extends CI_model
{
  public function __construct()
  {
   $this->load->library('form_validation');
  }
   
  public function create_user_record($user)
  {
    $input_validation_passed = TRUE; 
    $data   = array();
    $config = array(
                    array(
                       'field' => 'first_name', 
                       'label' => 'First Name', 
                       'rules' => 'trim|required'
                    ),
                    array(
                       'field' => 'last_name', 
                       'label' => 'Last Name', 
                       'rules' => 'trim|required'
                    ),
                    array(
                       'field' => 'email', 
                       'label' => 'Email', 
                       'rules' => 'trim|required|valid_email'
                    ),
                    array(
                       'field' => 'password', 
                       'label' => 'Password', 
                       'rules' => 'trim|required|matches[password_conf]'
                    ),   
                    array(
                       'field' => 'password_conf', 
                       'label' => 'Password Confirmation', 
                       'rules' => 'trim|required'
                    )
              );

    $this->form_validation->set_rules($config);
    if ($this->form_validation->run() == FALSE)
    {
      $data["user_created"] = FALSE;
      $data["error_message"] = validation_errors();
      $input_validation_passed = FALSE;
    }

    $get_user_with_email = $this->get_user_with_email($user['email']);
    if($get_user_with_email)
    {
      $data["user_created"] = FALSE;
      $data["error_message"] = "Your record already exists..Please login!!";
      $input_validation_passed = FALSE;
    }
    else if($input_validation_passed)
    {
      $insert_query  =  "INSERT INTO users
                         (first_name, last_name, email, users.password, user_level, created_at, updated_at)
                         VALUES(?,?,?,?,?,?,?)";
      $add_user = $this->db->query($insert_query,
                                  array($user['first_name'],
                                        $user['last_name'],
                                        $user['email'],
                                        md5($user['password']),
                                        "user",
                                        date("Y-m-d H:i:s"),
                                        date("Y-m-d H:i:s")
                                  )  
                  );     
      if($add_user)
      {
        $data["user_created"] = TRUE;
        $data["success_message"] = "Successfully registered with Dojo. Please login with your credentials";
      }
      else
      {    
        $data["user_created"] = FALSE;
        $data["error_message"] = "Can't create user. DB error";
      }      
    }
    return $data;
  }
  
  function login_user($user)
  {
    $input_validation_passed = TRUE; 
    $config = array(
                   array(
                         'field' => 'username', 
                         'label' => 'User Name', 
                         'rules' => 'trim|required|valid_email'
                    ),
                   array(
                         'field' => 'password', 
                         'label' => 'Password', 
                         'rules' => 'trim|required' 
                    )        
              );

    $this->form_validation->set_rules($config);
    $check_user_present = $this->get_user_with_email($user['username']); 
    if ($this->form_validation->run() == FALSE)
    {
      $input_validation_passed = FALSE; 
      $data["error_message"] = validation_errors();
      $data["is_login"] = FALSE;
    }
    else if(!$check_user_present)
    {
      $input_validation_passed = FALSE; 
      $data["error_message"] = "User not found in records, Please register";
      $data["is_login"] = FALSE;
    }
    else
    {
      if(($check_user_present['password'] == md5($user['password'])))
      {
        $current_user = array('user_id'    => $check_user_present['id'],
                              'user_name'  => $user['username'],
                              'user_level' => $check_user_present['user_level']);

        $this->session->set_userdata("current_user",$current_user);
        $data["is_login"]        = TRUE;
        $data["success_message"] = "Successfully logged in";
      }
      else
      {
        $data["is_login"] = FALSE;
        $data["error_message"] = "Password entered is wrong. Please try again";
      }
    }
    return $data;  
  } 

  function get_user_with_email($email)
  {
    $user_email   = strtolower($email);
    $user_fetch_query = "SELECT * FROM users WHERE email = ?";
    return $this->db->query($user_fetch_query,$user_email)->row_array();
  }

  function get_user_with_id($id)
  {
    $user_fetch_query = "SELECT * FROM users WHERE id = ?";
    return $this->db->query($user_fetch_query,$id)->row_array();
  }

  function get_all_users()
  {
    $users_fetch_query = "SELECT * FROM users";
    return $this->db->query($users_fetch_query)->result_array();
  }

  function update_user($user)
  {
    $update_data =  array('first_name' => $user['first_name'], 
                          'last_name'  => $user['last_name'] ,
                          'email'      => $user['email']           
                    );
    $this->db->where('id', $user['id']);
    return $this->db->update('users', $update_data);
  }

  function delete_user($id)
  {
    $user = $this->get_user_with_id($id);
    //make sure admin is not deleted
    if($user["user_level"]!="admin")
    {
      return $this->db->delete('users', array('id' => $id));
    }
    else
    {
      return false;
    }
  }

}
 

 