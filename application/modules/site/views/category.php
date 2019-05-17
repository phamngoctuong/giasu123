<?php 
?>
</header>
<section>

<div class="tintuc">
	<div class="bg-blue">
        <div class="ctr container">
            			<h1><?php echo $item->name; ?></h1>
            		</div>
            	</div>
	<div class="ctr">
		<div class="container maincontent">
            <div class="rowaddon2 colmd7">
                <div class="col-md-8 news">
                    <?php $news_cat = $this->db->query('SELECT id,alias,title,image FROM tbl_baiviet WHERE status=1 AND vip=1 AND cid='.$item->id.' ORDER BY id DESC LIMIT 5'); 
            		if($news_cat->num_rows()>0){
            		?>
            		<div class="box-new-01">
            			<ul>				
            				<?php foreach ($news_cat->result() as $nc) { ?>
            					<li><a href="<?php echo site_url($nc->alias.'-b'.$nc->id.'.html'); ?>" title="<?php echo $nc->title; ?>">
            						<p><?php echo $nc->title; ?></p>
            					</a></li>
            				<?php } ?>
            			</ul>
            			<div class="clr" style="height:25px;"></div>				
            		</div>
            		<?php } ?>
            		
            		<?php $news_cat = $this->db->query('SELECT id,alias,title,image,sapo,created_day FROM tbl_baiviet WHERE status=1 AND vip!=1 AND cid='.$item->id.' ORDER BY id DESC'); 
            		if($news_cat->num_rows()>0){
            		$i=0;
            		?>
            		<div class="box-new-02">	
            			<?php foreach ($news_cat->result() as $nc) {
            				$i++;
            				if($i==1){
            			?>		
            			<div class="new-vip">
            				<div class="title"><a href="<?php echo site_url($nc->alias.'-b'.$nc->id.'.html'); ?>" ><?php echo $nc->title; ?></a></div>
            				
            				<?php echo $nc->sapo; ?>
            				
            			</div>
            			
            			<div class="clr" style="height:25px;"></div>
            			<div class="news">
            			<?php }else{ ?>
            				<div class="item">
            					<div class="title"><a href="<?php echo site_url($nc->alias.'-b'.$nc->id.'.html'); ?>" ><?php echo $nc->title; ?></a></div>
            				
            					<div class="sapo"><?php echo $nc->sapo; ?></div>
            				
            					<div class="clr" style="height:25px;"></div>
            				</div>
            				<?php } 
            			if($i==$news_cat->num_rows()){
            			?>				
            				
            			</div>
            		
            			<div class="clr" style="height:25px;"></div>		
            			<?php } } ?>
            		</div>
            		<?php } ?>
                </div>
                <div class="col-md-4 news">
            <div class="ads">
                <?php $custom = $this->db->query('SELECT html FROM tbl_custom_html WHERE status=1 AND sort="1" AND id=11 ORDER BY id DESC LIMIT 1'); 
                	if($custom->num_rows()>0){
                		$cus = $custom->row();
                		echo strip_tags($cus->html,'<img>'); 
                	} ?>
                    </div>
                    <div class="title2">
                        Tin liên quan tiền lương
                    </div>
                    <div class="listitemnewright">
                        <?php $news = $this->db->query('SELECT b.id,b.alias,b.title,b.image,b.created_day,c.`name`,c.alias as aliascat,c.id as idcat FROM tbl_baiviet as b inner join tbl_chuyenmuc as c on b.cid=c.id WHERE b.cid=2 and b.status=1 ORDER BY b.id DESC LIMIT 12'); 
                            if($news->num_rows()>0){
                            ?>
                            <?php foreach ($news->result() as $n) { ?>
                                        <div class="itemright">
                                            <div class="imgitem">
                                                <img src="upload/news/thumb/<?php echo $n->image==''?'images-09.jpg':$n->image; ?>" alt="<?php echo $n->title; ?>" title="<?php echo $n->title; ?>"/>
                                            </div>
                                            <div class="introitem">
                                                <a class="titleitem" href="<?php echo site_url($n->alias.'-b'.$n->id.'.html'); ?>" title="<?php echo $n->title; ?>><i class="fa fa-newspaper-o"></i> <?php echo $n->title; ?></a>
                                                <div class="timeitem">
                                                    <span class="itemcat"><?php echo $n->name; ?></span>
                                                    <span class="itemdate"><?php echo date("d/m/Y",strtotime($n->created_day)); ?></span>
                                                </div>
                                            </div>
                                        </div>
                            		
                            		<?php } ?>				
                            
                            <?php } ?>
                    </div>
        </div>
            </div>
        </div>
			
	</div>

</div>
</section>