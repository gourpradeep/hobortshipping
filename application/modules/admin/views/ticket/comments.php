
<?php if($comment_list):  $comment_list = array_reverse ($comment_list); ?>
						                                    
		<?php foreach ($comment_list as $key => $value):?>

			<div class="msg <?php echo ($value->commented_by_id == NULL)? "right-msg" : "left-msg"; ?>">
			  <div class="msg-img" style="display: <?php echo ($value->commented_by_id == NULL)? "none" : "block"; ?>">
			     <img src="<?php echo $value->sender_image; ?>">
			  </div>
			  <div class="msg-bubble">
			     <div class="msg-info">
			        <div class="msg-info-name"><?php echo $value->full_name; ?></div>
			        <div class="msg-info-time"><?php echo date('d M Y h:i:a',strtotime($value->created_at)); ?></div>
			     </div>

			    <?php if($value->is_file == '0'): ?>
                	<div class="msg-text"><?php echo $value->comment; ?></div>
                <?php elseif($value->is_file == '1' && in_array($value->file_extension,array('png','jpeg','jpg','gif')) ): ?>
                	<div class="msg-text chat-img fancybox" rel="ligthbox" href="<?php echo $value->comment; ?>">
                    	<img id="myImg" src="<?php echo $value->attechmentThumb; ?>">
                    </div>
                <?php elseif($value->is_file == '1' && in_array($value->file_extension,array('docx','pdf','txt','doc','csv','xls')) ): ?>
                	<div class="msg-text chat-doc">
                		<div class="docSent">
	                        <a target="_blank" href="<?php echo $value->comment; ?>">
	                            <img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>content/doc.png">
	                         
	                        <h5><?php echo $value->attachment_file; ?></h5>
	                        </a>
	                    </div>
                        
                    </div>
                <?php endif; ?>

			  </div>
			</div>

		<?php endforeach; ?>

<?php else: ?>
    <div class="noCmtFound">
        <h4>No comments yet</h4>
    </div>
<?php endif ?>