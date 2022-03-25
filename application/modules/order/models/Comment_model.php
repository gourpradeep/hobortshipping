<?php

class Comment_model extends CI_Model{

	public function __construct(){
        parent::__construct();
    }

    function getCommentList($data,$count){

        $url_placeholder = getenv('S3_USER_PLACEHOLDER_AVATAR');
        $url_image = getenv('S3_USER_AVATAR_THUMB');

        $attechment = getenv('S3_COMMENT_ATTACHMENT_DIR');
        $attechmentThumb = getenv('S3_COMMENT_ATTACHMENT_THUMB');

        $this->db->select('tc.*,
        	IF(tc.comment IS NULL, "1","0") AS is_file,
        	IF(tc.comment IS NULL,
        		concat("'.$attechment.'",tca.attachment_file),
        		tc.comment
        	) AS comment,
            tca.attachment_file,
            IF(tc.comment IS NULL,
                concat("'.$attechmentThumb.'",tca.attachment_file),
                tc.comment
            ) AS attechmentThumb,
        	tca.file_extension,
        	IF(tc.commented_by_id IS NOT NULL,
	        	(case when(users.avatar = "" OR users.avatar IS NULL) 
	     		        THEN "'.$url_placeholder.'"
	                	ELSE
	                    concat("'.$url_image.'", users.avatar) 
	            END ) ,
	            ""
            ) as sender_image,
            users.full_name
        	');
        $this->db->from(TICKET_COMMENTS.' as tc');
        $this->db->join(TICKET_COMMENT_ATTACHMENTS.' as tca','tca.ticket_comment_id = tc.ticketCommentID','left');
        $this->db->join(USERS.' as users','users.userID = tc.commented_by_id AND tc.commented_by_id IS NOT NULL','left');
        $this->db->where(array('tc.ticket_id'=>$data['ticketId']));

        if($count){
        	return $this->db->get()->num_rows();
        }
 		
        $this->db->limit($data['limit'],$data['offset']);
        $this->db->order_by('tc.ticketCommentID','DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $rows = $query->result();
            return $rows;
        }else{
            return false;
        }
    }

    function get_admin_detail(){
    	$url_placeholder = getenv('S3_USER_PLACEHOLDER_AVATAR');
        $url_image = getenv('S3_ADMIN_AVATAR_THUMB');

    	$this->db->select('
        	(case when(admin.avatar = "" OR admin.avatar IS NULL) 
     		        THEN "'.$url_placeholder.'"
                	ELSE
                    concat("'.$url_image.'", admin.avatar) 
            END ) as admin_image,
            admin.name
        	');
        $this->db->from(ADMIN_USERS.' as admin');
        $query = $this->db->get();
        $rows = $query->row();
        return $rows;
    }

}
?>