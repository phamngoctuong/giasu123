
<section class="padd-top-30 padd-bot-30">
  <div class="container">
    <?php $this->load->view('headerfun');
    // pr($query);
     ?>
  </div>
          <div class="container">
            <div class="content">
            <div class="">
              <h1 style="text-align :center;font-size:16px">Các công ty tuyển dụng trên toàn quốc</h1>
            </div>
            <div class="main_cate">
            <?php if(!empty($query)){
              foreach ($query as $item) {
                $userid1=$item->usc_id;
                $sum = $this->site_model->Sumlistnew($userid1);

                 ?>
                <div class="item_cate">
                  <div class="img_cate">
                    <?php if(!empty($item->usc_logo)){?>
                        <img src="<?= gethumbnail(geturlimageAvatar(strtotime($item->usc_create_time)).$item->usc_logo,$item->usc_logo,strtotime($item->usc_create_time),174,174,100) ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' alt="<?php echo $item->usc_company?>"/>
                    <?php }else{ ?>
                     <img src="images/clgt.png" alt="no image" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                     <?php } ?>
                  </div>
                  <div class="center_cate">
                    <a href="<?php echo base_url().vn_str_filter($item->usc_company).'-ntd'.$item->usc_id.'.html' ?>"><strong><?php echo $item->usc_company?></strong></a>
                    <p><?php echo Getcitybyindex($item->usc_city)?></p>
                    <?php
                    if(!empty($sum->total_capacity)){ ?>
                      <p style="color:red">Số bài đã đăng : <?php echo $sum->total_capacity ?></p>

                    <?php }else{?>
                      <p style="color:red">Số bài đã đăng : 0</p>
                  <?php } ?>
                    </div>
                    </div>
                <?php  }} ?>
              </div>
              <div class="clearfix">
               <div class="col-md-3 col-sm-12 padd-0"></div>
                   <div class="col-md-9 col-sm-12">
                      <div class="pagation">
                      <?php echo $pagination; ?>

                      </div>
                   </div>
               </div>

               <?php
               if(!empty($linkCity)){
                 ?>
                 <div class="tit_hd headertt">
                    <h2><img src="images/ic_cn.png" alt="Nhà tuyển dụng theo tỉnh thành"><span>Nhà tuyển dụng tỉnh thành</span></h2>
                 </div>
                 <div class="main_cn">
                    <ul style="min-height:50px;list-style:none;background: white">
                      <?php
                        foreach ($linkCity as  $valuelinkclass) {
                          ?>
                          <li class="col-md-3 padd-0 col-sm-12">

                          <?php
                          echo $valuelinkclass;
                           ?>
                           </li>
                          <?php
                        }
                       ?>

                    </ul>
                  </div>
                 <?php
                   }
                   ?>
            </div>
          </div>
</section>
