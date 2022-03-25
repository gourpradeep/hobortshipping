<?php if($comment_list):  $comment_list = array_reverse ($comment_list); ?>
<?php foreach ($comment_list as $key => $value):?>
<div class=" <?php echo ($value->commented_by_id == NULL)? "message-main-receiver" : "message-main-sender"; ?> ">
   <div class="adminCmt">
      <?php if($value->commented_by_id == NULL): ?>
      <h5><?php echo $admin->name; ?></h5>
      <?php endif; ?>
      <div class=" <?php echo ($value->commented_by_id == NULL)? "receiver" : "sender"; ?> ">
         <?php if($value->is_file == '0'): ?>
         <div class="message-text">
            <?php echo $value->comment; ?>
         </div>
         <span class="message-time">
         <?php echo date('d M Y h:i:a',strtotime($value->created_at)); ?>
      </div>
      </span>
         <?php elseif($value->is_file == '1' && in_array($value->file_extension,array('png','jpeg','jpg','gif')) ): ?>
         <div class="sender imgSend">
            <div class="message-text imgZoom">
               <a href="<?php echo $value->comment; ?>">
               <img src="<?php echo $value->attechmentThumb; ?>">
               </a>
            </div>
             <span class="message-time">
         <?php echo date('d M Y h:i:a',strtotime($value->created_at)); ?>
      </div>
      </span>
         </div>
         <?php elseif($value->is_file == '1' && in_array($value->file_extension,array('docx','pdf','txt','doc','csv','xls')) ): ?>
         <div class="sender imgSend">
            <div class="message-text imgZoom">
               <a href="<?php echo $value->comment; ?>">
                  <img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>content/doc.png">
                  <h5><?php echo $value->attachment_file; ?></h5>
               </a>
            </div>
         </div>
          <span class="message-time">
         <?php echo date('d M Y h:i:a',strtotime($value->created_at)); ?>
      </div>
      </span>
         <?php endif; ?>
        
   </div>
</div>
</div>
<?php endforeach; ?>
<?php else: ?>
    <div class="noCmtFound">
        <h4>No comments yet</h4>
    </div>
<?php endif; ?>
<style type="text/css">
    .noCmtFound {
    display: flex;
    align-items: center;
    height: 100%;
    justify-content: center;
}
.noCmtFound h4 {
    color: #9e9e9e;
    font-size: 22px;
    margin-top: 250px;

}
</style>