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

<!-- section -->


<section class="page-section" id="menu">
    <h3 class="heading-2" >Our Collections</h3>
    <hr class="hr1">
    <div id="menu-field" class="card-deck">
        <?php 
         include'admin/db_connect.php';
         $qry = $conn->query("SELECT * FROM  product_list order by rand() ");
         while($row = $qry->fetch_assoc()):
            
         ?>

           <div class="col-lg-3">
            <div class="card menu-item ">
               <img src="assets/img/<?php echo $row['img_path'] ?>" class="card-img-top" alt="...">
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