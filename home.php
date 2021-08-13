<!-- Masthead-->
<header class="masthead">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end mb-4 page-title">
                <h3 class="text-white">Welcome to
                    <?php echo $_SESSION['setting_name']; ?>
                </h3>
                <hr class="divider my-4" />
                <a class="btn btn-primary btn-xl js-scroll-trigger" href="#menu">Order Now</a>

            </div>

        </div>
    </div>
</header>

<!-- Section For Poular Dishes  -->

<section class="page-section" id="menu">
    <h3 class="heading-2">  Our Popular Dishes
    </h3>
    <hr class="hr1">
    <div id="menu-field" class="card-deck">
        <?php 
            $n=0;
         include'admin/db_connect.php';
         $qry = $conn->query("SELECT * FROM  product_list ");
         while($row = $qry->fetch_assoc()):
           if($n == 4) {
            break;
           }
           $n++;
         ?>

           <div class="col-lg-3">
            <div class="card" menu-item style="margin-top : 1rem !important;">
               <img src="assets/img/<?php echo $row['img_path'] ?>" class="card-img-top view_prod hm_img"  alt="..." data-id=<?php echo $row['id']
                            ?>>
               <h5 class="card-title text-center">
                        <?php echo $row['name'] ?> 
                        <button class="btn btn-sm view_prod" data-id=<?php echo $row['id']
                            ?>><i class="fa fa-eye"></i> View
                        </button>
                 </div>
            </div>

        <?php endwhile; ?>
    </div>
</section>

<!-- crousel -->

<div   class="carousel slide carousel-fade" data-ride="carousel">
    <div class="carousel-inner" style="margin-top:0px;">
        
        <div class="carousel-item active " data-interval="2000">
             <img src="assets/img/carousel/c.jpg" class="d-block w-100" alt="...">
        </div>
        <?php 
        //  include'admin/db_connect.php';
         $qry = $conn->query("SELECT * FROM carousel ");
         while($row = $qry->fetch_assoc()):
        ?>
        <div class="carousel-item" data-interval="2000">
        <img src="assets/img/carousel/<?php echo $row['img_path'] ?>" class="d-block w-100" alt="...">
        </div>
         <?php endwhile; ?>
    </div>       
  <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>



<!-- section -->


<section class="page-section" id="menu">
    <h3 class="heading-2" >Our Collections</h3> <span class = " lk"> <a href="index.php?page=all_product">View all  &#8694;</a></span>
    <hr class="hr1">
    <div id="menu-field" class="card-deck">
        <?php 
        //  include'admin/db_connect.php';
         $qry = $conn->query("SELECT * FROM  product_list order by rand() ");
         while($row = $qry->fetch_assoc()):
            
         ?>

           <div class="col-lg-3">
            <div class="card menu-item " style="margin-top : 1rem !important;">
               <img src="assets/img/<?php echo $row['img_path'] ?>" class="card-img-top hm_img"  alt="...">
                <div class="card-body">
                    <h5 class="card-title ">
                        <?php echo $row['name'] ?> <small class="floa_t truncate ">Price: &#8377;<?php echo $row['price']  ?>  </small>
                    </h5>
                    <p class="card-text truncate">
                        <?php echo $row['description'] ?>
                    </p>
                    <div class="text-center">
                        <button class="btn btn-sm btn-outline-primary btn-block view_prod" data-id=<?php echo $row['id']
                            ?>><i class="fa fa-eye"></i> View
                        </button>
                    </div>
                </div>
             </div>
            </div>

        <?php endwhile; ?>
    </div>
</section>


<script>

    $('.view_prod').click(function () {
        uni_modal_right('Product', 'view_prod.php?id=' + $(this).attr('data-id'))
    })

    


</script>