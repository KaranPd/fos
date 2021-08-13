 <!-- Masthead-->
        <header class="masthead">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end mb-4 page-title">
                    	<h3 class="text-white">Cart List</h3>
                        <hr class="divider my-4" />
                    </div>
                    
                </div>
            </div>
        </header>
	<section class="page-section" id="menu">
        <div class="container">
        	<div class="row">
        	<div class="col-lg-8">
        		<div class="sticky">
	        		<div class="card">
	        			<div class="card-body">
	        				<div class="row">
		        				<div class="col-md-8"><b>Card</b></div>
		        				<div class="col-md-4 text-right"><b>Total</b></div>
	        				</div>
	        			</div>
	        		</div>
	        	</div>
        		<?php 
        		if(isset($_SESSION['login_user_id'])){
					$data = "where c.user_id = '".$_SESSION['login_user_id']."' ";	
				}else{
					$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
					$data = "where c.client_ip = '".$ip."' ";	
				}
				$total = 0;
				$get = $conn->query("SELECT *,c.id as cid FROM cart c inner join product_list p on p.id = c.product_id ".$data);
				while($row= $get->fetch_assoc()):
					$total += ($row['qty'] * $row['price']);
        		?>

        		<div class="card">
	        		<div class="card-body">
		        		<div class="row">
			        		
						<div class="col-md-4" style="text-align: -webkit-center"> 
			        			 <a href="javascript:void(0)" class="rem_cart btn btn-sm btn-outline-danger kill" data-id="<?php echo $row['cid'];  ?>"><i class="fa fa-trash" >  </i></a>
			        			<img src="assets/img/<?php echo $row['img_path'] ?>" alt="">
								<input type="hidden"  value="<?php echo $row['price'] ?>"  name="tot_val" >
			        		</div>





			        		<div class="col-md-4">
			        			<p><b><large><?php echo $row['name'] ?></large></b></p>
			        			<p class='truncate'> <b><small>Desc :<?php echo $row['description'] ?></small></b></p>
			        			<p> <b><small>Unit Price :<?php echo number_format($row['price'],2) ?></small></b></p>
			        			<p><small>QTY :</small></p>

			        			<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <button class="btn btn-outline-secondary qty-minus" type="button"   data-id="<?php echo $row['cid'] ?>"><span class="fa fa-minus"></button>
								  </div>
					 
								 
								  <input type="number" readonly value="<?php echo $row['qty'] ?>" min = 1 class="form-control text-center" name="qty" >

								  <input type="hidden"  value="<?php echo $row['price'] ?>"  name="tot_val" >

								  <div class="input-group-prepend ">
								    <button class="btn btn-outline-secondary qty-plus" type="button" id=""  data-id="<?php echo $row['cid'] ?>"><span class="fa fa-plus"></span></button>
								    
								  </div>
								</div>
			        		</div>
			        		<div class="col-md-4 text-right">


								<b>	<large class="up_dt" value="<?php echo number_format($row['qty'] * $row['price'],2) ?>" id="a<?php echo $row['cid']?>" >&#8377; <?php echo number_format($row['qty'] * $row['price'],2) ?></large></b>
			        		</div>				
		        		</div>
	        		</div>
	        	</div>

	        <?php endwhile; ?>
        	</div>
        	<div class="col-md-4">
        		<div class="sticky">
        			<div style="margin-top : 0px !important;" class="card" >
        				<div class="card-body">
        					<p><large>Total Amount</large></p>
        					<hr>
        					<p class="text-right" id="tot"><b>&#8377;
							<?php echo number_format($total,2) ?></b></p>
        					<hr>
        					<div class="text-center">
        						<button class="btn btn-block btn-outline-primary" type="button" id="checkout">Proceed to Checkout</button>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        	</div>
        </div>
    </section>


	
	

    <style>
    	.card p {
    		margin: unset
    	}
    	.card img{
		    max-width: calc(100%);
		    max-height: calc(59%);
    	}
    	div.sticky {
		  position: -webkit-sticky; /* Safari */
		  position: sticky;
		  top: 4.7em;
		  z-index: 10;
		  background: white
		}
		.rem_cart{
		   position: absolute;
    	   left: 0;
		}
    </style>
    <script>
		$('.qty-minus').click(function(){
		var qty = $(this).parent().siblings('input[name="qty"]').val();
		qt1 = qty;
		qt1 = qt1-1;
		id_s = $(this).attr('data-id');
		update_qty(parseInt(qty) -1,$(this).attr('data-id'))
		if(qty == 1){
			return false;
		}else{
			 $(this).parent().siblings('input[name="qty"]').val(parseInt(qty) -1);
		}
				p = $(this).parent().siblings('input[name="tot_val"]').val();
				val = $('#tot').text();
				val= $.trim(val);
				val = val.replace(',','');
				val = val.replace('₹','');
				
				val = parseFloat(val);
				p =  parseFloat(p);

							item_tot = p*qt1;
				x = val-p;
				x=x.toString();
				
				var lastThree = x.substring(x.length-3);
				var otherNumbers = x.substring(0,x.length-3);
				if(otherNumbers != '')
					lastThree = ',' + lastThree;
				var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
				$('#tot').html("&#8377;" + res + ".00");
				$('#tot').css('font-weight','bold');

					x=item_tot.toString();
				var lastThree = x.substring(x.length-3);
				var otherNumbers = x.substring(0,x.length-3);
				if(otherNumbers != '')
					lastThree = ',' + lastThree;
				 res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
				 
					st ='a';
					id_s = st.concat(id_s);
					console.log(id_s);
				
				$('#'+id_s).html("&#8377; " + res + ".00");
				$('#'+id_s).css('font-weight','bold');
		
		})
		$('.qty-plus').click(function(){

			
			var qty =  $(this).parent().siblings('input[name="qty"]').val();
				qt1 = qty;
				qt1 = parseInt(qty) +1;
				id_s = $(this).attr('data-id');
				 $(this).parent().siblings('input[name="qty"]').val(parseInt(qty) +1);
				update_qty(parseInt(qty) +1,$(this).attr('data-id'));

				p = $(this).parent().siblings('input[name="tot_val"]').val();
				val = $('#tot').text();
				val= $.trim(val);
				val = val.replace(',','');
				val = val.replace('₹','');
				
				val = parseFloat(val);
				p =  parseFloat(p);
				
				item_tot = p*qt1;
				x = val+p;

				x=x.toString();
				var lastThree = x.substring(x.length-3);
				var otherNumbers = x.substring(0,x.length-3);
				if(otherNumbers != '')
					lastThree = ',' + lastThree;
				var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
				
			
				console.log(item_tot);	
				
				$('#tot').html("&#8377;" + res + ".00");
				// $('#tot').before("&#8377;");
				$('#tot').css('font-weight','bold');

				x=item_tot.toString();
				var lastThree = x.substring(x.length-3);
				var otherNumbers = x.substring(0,x.length-3);
				if(otherNumbers != '')
					lastThree = ',' + lastThree;
				 res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
				 
					st ='a';
					id_s = st.concat(id_s);
					
				
				$('#'+id_s).html("&#8377; " + res + ".00");
				$('#'+id_s).css('font-weight','bold');

	})
		
		
	
	

		
		$('.kill').click(function(){
			var qty = $(this).attr("data-id");	
			$(this).parent().parent().parent().parent().hide(400);
			$.ajax({
				url:'admin/ajax.php?action=del',
				type:'POST',
				data:{id:qty},
				success:function(resp) {
					if(resp==1) { 
							load_cart()
							end_load()
							console.log("Done");
					}
					else { 
							console.log("Error")
							}
				}
			})
		})


		
		
		
		function update_qty(qty,id){
			start_load()
			$.ajax({
				url:'admin/ajax.php?action=update_cart_qty',
				method:"POST",
				data:{id:id,qty},
				success:function(resp){
					if(resp == 1){
						load_cart()
						end_load()
					}
				}
			})

		}

		function update_val(id){
			start_load()
			$.ajax({
				url:'admin/ajax.php?action=update_cart_val',
				method:"POST",
				data:{id:id},
				success:function(resp){
					if(resp == 1){
						load_cart()
						end_load()
					}
				}
			})

		}




		$('#checkout').click(function(){
			if('<?php echo isset($_SESSION['login_user_id']) ?>' == 1){
				location.replace("index.php?page=checkout")
			}else{
				uni_modal("Checkout","login.php?page=checkout")
			}
		})


		
    </script>

	
	
