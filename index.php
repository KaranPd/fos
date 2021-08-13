<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    include('header.php');
    include('admin/db_connect.php');

	$query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
	foreach ($query as $key => $value) {
		if(!is_numeric($key))
			$_SESSION['setting_'.$key] = $value;
	}
    ?>

<style>
  header.masthead {
    background: url(assets/img/<?php echo $_SESSION['setting_cover_img'] ?>);
    background-repeat: no-repeat;
    background-size: cover;
  }
</style>

<body id="page-top">
  <!-- Navigation-->
  <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body text-white">
    </div>
  </div>
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="./">
        <?php echo $_SESSION['setting_name'] ?>
      </a>
      <button class="navbar-toggler navbar-toggler-right" type="button" -toggle="collapse"
        data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
        aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=home">Home</a></li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=cart_list"><span> <span
                  class="badge badge-danger item_count">0</span> <i class="fa fa-shopping-cart"></i> </span>Cart</a>
          </li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=about">About</a></li>
          <?php if(isset($_SESSION['login_user_id'])): ?>
          <li class="nav-item">

            <a class="nav-link js-scroll-trigger" href="admin/ajax.php?action=logout2">
              <?php echo "Welcome &nbsp". $_SESSION['login_first_name'] ?>
            </a>
          </li>
          <li class="nav-item">

            <a class="nav-link js-scroll-trigger" href="admin/ajax.php?action=logout2">
              <i class="fa fa-power-off"></i>
            </a>
          </li>
          <?php else: ?>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="javascript:void(0)" id="login_now">Login</a>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="javascript:void(0)" id="new_account">Sign Up</a>
          </li>
        
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>





 
  <?php 
        $page = isset($_GET['page']) ?$_GET['page'] : "home";
        include $page.'.php';
        ?>






<!-- Modals; -->

  <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
        </div>
        <div class="modal-body">
          <div id="delete_content"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id='submit'
            onclick="$('#uni_modal form').submit()">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="fa fa-arrow-right"></span>
          </button>
        </div>
        <div class="modal-body">
        </div>
      </div>
    </div>
  </div>


<!-- Start of footer  -->

  <footer class="bg-light py-3">

    <div class="container-fluid padding">
      <div class="row text-center">
        <div class=" border-right col-md-3">

          <h5> <span class="h_foot">Popular Searches</span></h5>

          <p><a href="#">Breakfast</a></p>
          <p><a href="#">Lunch</a></p>
          <p><a href="#">Dinner</a></p>
          <p><a href="#">Desserts</a></p>
        </div>
        <div class=" col-md-3">

          <h5> <span class="h_foot"> Food Plaza</span></h5>

          <p><i class="fas fa-phone"></i> +918864089468</p>
          <p><i class="fas fa-envelope"></i> support@fos.com</p>
          <p><i class="fas fa-map-marker-alt"></i> Piska Moar, Ratu Road Road</p>
          <p>Ranchi,Jharkhand,827005.</p>
        </div>
        <div class="border-left col-md-3">

          <h5><span class="h_foot">Working Hours</span></h5>

          <h6>Telephonic Support</h6>
          <p>Monday : 9am - 10pm</p>
          <p>saturday : 10am - 8pm</p>
          <p>Sunday : Closed</p>
          <h6>Email Support : 24X7</h6>
        </div>

        <div class="border-left col-md-3">
          <h5><span class="h_foot">Social Links</span></h5>
          <div class="container social"><a target="_blank" href="http://www.fb.com"><img src="assets/img/fb.png"
                alt="facebook"></a></div>
          <div class="container social"><a target="_blank" href="http://www.twitter.com"><img
                src="assets/img/twitter.png" alt="twitter" "></a></div>
                            <div class=" container social"><a target="_blank" href="http://www.instagram.com"><img
                  src="assets/img/insta.png" alt="instagram"></a></div>
          <div class="container social"><a target="_blank" href="https://api.whatsapp.com/send?phone=+918864089468"><img
                src="assets/img/whatsapp.png" alt="whatsapp"></a></div>

        </div>
      </div>
    </div>

    <hr id="hr_f">
    <div class="container">
      <div class="small text-center text-muted">Copyright © 2021 - Online Food Ordering system | <a href="#"
          target="_blank">MCA Sem - VI Project</a></div>
    </div>
  </footer>

  <?php include('footer.php') ?>
  
</body>

<?php $conn->close() ?>

</html>