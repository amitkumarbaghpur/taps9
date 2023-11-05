<?php include('include/header.php'); ?>


    <div class="container-fluid bn" id="page">
        <div class="container">
            <div class="bn2">
                <h3>Find a Lawyer</h3>
                <p>
                    <a href="<?=$baseurl?>">Home &nbsp; </a> / &nbsp;
                    <a href="<?=$baseurl?>/find-lawyer" style="color: #68c6ff; font-weight: normal">Find a Lawyer</a>
                </p>
            </div>
        </div>
    </div>
 
    <!-- about us-->
    <div class="section_wrapper">
    <div class="container mb-2">
        <div class="row">
            <div class="col-md-12 aboutt">
                <h3>FIND A  <span class="redcolor">LAWYER</span></h3> 
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="aboutt">
                    <span class="spn1"></span>
                    <div class="findlawyer-content">
                     <div class="list-section">  
                     <?php
             $state_list = $taps9->self_query("select * from tbl_state where status=1 order by id asc");
             $j=1;
            if(count($state_list)>0)    
            {            
            for($i=0;$i<count($state_list);$i++)
                            {
                                

                       ?>                
                           <h5><a href="<?=$baseurl?>/get-lawyer/<?=$state_list[$i]['id']?>"><?=$j++?> .<?=$state_list[$i]['title']?></a></h5>
                                     <?php } } ?>          </div>  
                                                 
                 </div> 
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
    </div>
</div>
 
<?php include('include/footer.php'); ?>
