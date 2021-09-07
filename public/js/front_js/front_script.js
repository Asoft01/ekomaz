$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // alert('test');
    // $("#sort").on('change', function(){
    //     this.form.submit();
    // });
    $("#sort").on('change', function(){
        // alert('test');
        var sort = $(this).val();
        // var fabric = get_filter("fabric"); 
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');  
        var pattern = get_filter('pattern');  
        var fit = get_filter('fit');  
        var occasion = get_filter('occasion');  
        // alert(sort);
        var url = $("#url").val();
        // alert(url);
        $.ajax({
            url: url,
            method: "post",
            data: {fabric:fabric, sleeve: sleeve, pattern: pattern,fit: fit,occasion: occasion, sort: sort, url: url},
            success: function(data){
                $('.filter_products').html(data);
            }
        });
    });

    $(".fabric").on('click', function(){
        // var fabric = get_filter(this);
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');  
        var pattern = get_filter('pattern');  
        var fit = get_filter('fit');  
        var occasion = get_filter('occasion');
        var sort = $("#sort option:selected").text();
        var url = $("#url").val();
        $.ajax({
            url: url,
            method: "post",
            data: {fabric:fabric, sleeve: sleeve, pattern: pattern,fit: fit,occasion: occasion, sort: sort, url:url},
            success: function(data){
                $('.filter_products').html(data);
            }
        });
    });

    $(".sleeve").on('click', function(){
        // var fabric = get_filter(this);
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');  
        var pattern = get_filter('pattern');  
        var fit = get_filter('fit');  
        var occasion = get_filter('occasion');
        var sort = $("#sort option:selected").text();
        var url = $("#url").val();
        $.ajax({
            url: url,
            method: "post",
            data: {fabric:fabric, sleeve: sleeve, pattern: pattern,fit: fit,occasion: occasion, sort: sort, url:url},
            success: function(data){
                $('.filter_products').html(data);
            }
        });
    });


    $(".pattern").on('click', function(){
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');  
        var pattern = get_filter('pattern');  
        var fit = get_filter('fit');  
        var occasion = get_filter('occasion');
        var sort = $("#sort option:selected").text();
        var url = $("#url").val();
        $.ajax({
            url: url,
            method: "post",
            data: {fabric:fabric, sleeve: sleeve, pattern: pattern,fit: fit,occasion: occasion, sort: sort, url:url},
            success: function(data){
                $('.filter_products').html(data);
            }
        });
    });

    $(".fit").on('click', function(){
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');  
        var pattern = get_filter('pattern');  
        var fit = get_filter('fit');  
        var occasion = get_filter('occasion');
        var sort = $("#sort option:selected").text();
        var url = $("#url").val();
        $.ajax({
            url: url,
            method: "post",
            data: {fabric:fabric, sleeve: sleeve, pattern: pattern,fit: fit,occasion: occasion, sort: sort, url:url},
            success: function(data){
                $('.filter_products').html(data);
            }
        });
    });

    $(".occasion").on('click', function(){
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');  
        var pattern = get_filter('pattern');  
        var fit = get_filter('fit');  
        var occasion = get_filter('occasion');
        var sort = $("#sort option:selected").text();
        var url = $("#url").val();
        $.ajax({
            url: url,
            method: "post",
            data: {fabric:fabric, sleeve: sleeve, pattern: pattern,fit: fit,occasion: occasion, sort: sort, url:url},
            success: function(data){
                $('.filter_products').html(data);
            }
        });
    });
    
    function get_filter(class_name){
        var filter=[];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    // First method of returning prices based on the attributes

    // $("#getPrice").change(function(){
    //     // alert("test");
    //     var size = $(this).val();
    //     if(size==""){
    //         alert("Please select size");
    //         return false;
    //     }
    //     // alert(size);
    //     var product_id = $(this).attr("product-id");
    //     // alert(product_id);
    //     $.ajax({
    //         url: '/get-product-price',
    //         data: {size: size, product_id: product_id},
    //         type: 'post',
    //         success: function(resp){
    //             // alert(resp);
    //             $(".getAttrPrice").html("Rs. "+resp)
    //         }, error: function(){
    //             alert("Error");
    //         }
    //     });
    // });

    $("#getPrice").change(function(){
        // alert("test");
        var size = $(this).val();
        if(size==""){
            alert("Please select size");
            return false;
        }
        // alert(size);
        var product_id = $(this).attr("product-id");
        // alert(product_id);
        $.ajax({
            url: '/get-product-price',
            data: {size: size, product_id: product_id},
            type: 'post',
            success: function(resp){
                // alert(resp['product_price']); return false;
                // alert(resp['product_price']);
                // alert(resp['discounted_price']);
                // return false;
                // if(resp['discounted_price'] > 0){
                if(resp['discount'] > 0){
                    // $(".getAttrPrice").html("<del>Rs. "+resp['product_price'] + "</del> Rs."+resp['discounted_price']);
                    $(".getAttrPrice").html("<del>Rs. "+resp['product_price'] + "</del> Rs."+resp['final_price']);
                }else{
                    $(".getAttrPrice").html("Rs. "+resp['product_price']);
                }
                // $(".getAttrPrice").html("Rs. "+resp)
            }, error: function(){
                alert("Error");
            }
        });
    });

    // Update Cart Items 
    $(document).on('click', '.btnItemUpdate', function(){
        if($(this).hasClass('qtyMinus')){
            // The prev function is used to check the previous element which is the input element after the button been clicked
            // If qtyMinus button gets clicked by User
            var quantity = $(this).prev().val();
            // alert(quantity);
            // return false;
            if(quantity<= 1){
                alert("Item quantity must be 1 or greater!");
                return false;
            }else{
                new_qty = parseInt(quantity) -1;
                // alert(new_qty);
            }
        }
        if($(this).hasClass('qtyPlus')){
            // If qtyPlus button gets clicked by User
            var quantity= $(this).prev().prev().val();
            // alert(quantity); return false;
            new_qty = parseInt(quantity) + 1;
            // alert(new_qty);
        }
        // alert(new_qty);
        var cartid = $(this).data('cartid');
        // alert(cartid);
        $.ajax({
            data: {"cartid":cartid, "qty":new_qty},
            url: "/update-cart-item-qty",
            type: 'post',
            success: function(resp){
                // alert(resp);
                // alert(resp.status);
                if(resp.status == false){
                    // alert("Product Stock is not available");
                    alert(resp.message);
                }
                // alert(resp.totalCartItems);
                $('.totalCartItems').html(resp.totalCartItems);
                $("#AppendCartItems").html(resp.view);
            }, error: function(){
                alert("Error");
            }
        });
    });

    // Delete Cart Items

    $(document).on('click', '.btnItemDelete', function(){
        // alert(new_qty);
        var cartid = $(this).data('cartid');
        // alert(cartid); return false;
        var result = confirm("Want to delete this Cart Item");
        if(result){
            $.ajax({
                data: {"cartid":cartid},
                url: "/delete-cart-item",
                type: 'post',
                success: function(resp){
                    $('.totalCartItems').html(resp.totalCartItems);
                    $("#AppendCartItems").html(resp.view);
                }, error: function(){
                    alert("Error");
                }
            });
        }   
    });

    
		// validate register form on keyup and submit
		$("#registerForm").validate({
			rules: {
				name: "required",
				mobile: {
					required: true,
                    minlength: 10,
                    maxlength: 10,
                    digits:true
				},
				email: {
					required: true,
                    email: true,
                    remote: "check-email"
                },
                password: {
					required: true,
					minlength: 6
				}
			},
			messages: {
				name: "Please enter your Name",
				mobile: {
					required: "Please enter a Mobile",
					minlength: "Your mobile must consist of at least 10 digits",
					maxlength: "Your mobile must consist of at least 10 digits",
					digits: "Your enter a valid Mobile"
                },
                email: {
                    required: "Please enter a Email",
                    minlength: "Please enter a valid Email",
                    remote: "Email Already Exists"
                },
				password: {
					required: "Please choose your password",
					minlength: "Your password must be at least 6 characters long"
				}
			}
        });

        // validate register form on keyup and submit
		$("#loginForm").validate({
			rules: {
				email: {
					required: true,
                    email: true
                },
                password: {
					required: true,
					minlength: 6
				}
			},
			messages: {
                email: {
                    required: "Please enter a Email",
                    minlength: "Please enter a valid Email",
                    remote: "Email Already Exists"
                },
				password: {
					required: "Please enter your password",
					minlength: "Your password must be at least 6 characters long"
				}
			}
        });
        


		// propose username by combining first- and lastname
		// $("#username").focus(function() {
		// 	var firstname = $("#firstname").val();
		// 	var lastname = $("#lastname").val();
		// 	if (firstname && lastname && !this.value) {
		// 		this.value = firstname + "." + lastname;
		// 	}
		// });

		// //code to hide topic selection, disable for demo
		// var newsletter = $("#newsletter");
		// // newsletter topics are optional, hide at first
		// var inital = newsletter.is(":checked");
		// var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
		// var topicInputs = topics.find("input").attr("disabled", !inital);
		// // show when newsletter is checked
		// newsletter.click(function() {
		// 	topics[this.checked ? "removeClass" : "addClass"]("gray");
		// 	topicInputs.attr("disabled", !this.checked);
        // });
        
        	// validate account form on keyup and submit
		$("#accountForm").validate({
			rules: {
				name: {
                    required: true,
                    lettersonly: true
                },
				mobile: {
					required: true,
                    minlength: 10,
                    maxlength: 10,
                    digits:true
				}
			},
			messages: {
                name: "Please enter your Name",
                lettersonly: "Please enter valid Name",
				mobile: {
					required: "Please enter a Mobile",
					minlength: "Your mobile must consist of at least 10 digits",
					maxlength: "Your mobile must consist of at least 10 digits",
					digits: "Your enter a valid Mobile"
                }
			}
        });

        $("#passwordForm").validate({
			rules: {
				current_pwd: {
                    required: true,
                    minlength: 6,
                    maxlength: 20
                },
				new_pwd: {
					required: true,
                    minlength: 6,
                    maxlength: 10,
                },
                confirm_pwd: {
					required: true,
                    minlength: 6,
                    maxlength: 20,
                    equalTo: "#new_pwd"
                }
			},
        });

        // Check Current User Password
        $("#current_pwd").keyup(function(){
            var current_pwd= $(this).val();
            // alert(current_pwd);
            $.ajax({
                type: 'post',
                url: '/check-user-pwd',
                data: {current_pwd: current_pwd},
                success: function(resp){
                    // alert(resp);
                    if(resp=="false"){
                        $("#chkPwd").html("<font color='red'>Current Password is Incorrect</font>");
                    }else if(resp=="true"){
                        $("#chkPwd").html("<font color='green'>Current Password is Correct</font>");
                    }
                }, error: function(){
                    alert("Error");
                }
            })
        });

        // Apply Coupon
        $("#ApplyCoupon").submit(function(){
            // alert("Hello"); 
            var user = $(this).attr("user");
            if(user == 1){
                // Do Nothing
            }else{
                alert("Please login to Apply Coupon");
                return false;
            }
            var code = $("#code").val();
            // alert(code);
            $.ajax({
                type: 'post',
                data: {code: code},
                url: "/apply-coupon",
                success:function(resp){
                    // alert(resp.couponAmount);
                    if(resp.message != ""){
                        alert(resp.message);
                    }
                    $(".totalCartItems").html(resp.totalCartItems);
                    $("#AppendCartItems").html(resp.view);
                    if(resp.couponAmount >=0){
                        $(".couponAmount").text("Rs."+resp.couponAmount);
                    }else{
                        $(".couponAmount").text("Rs.0");
                    }
                    if(resp.grand_total>= 0){
                        $(".grand_total").text("Rs."+resp.grand_total);
                    }
                    // $(".grand_total").text("Rs."+resp.grand_total);
                    // $(".couponAmount").html(resp.couponAmount);
                    // alert(resp.couponAmount);
                }, error:function(){
                    alert("Error");
                }
            });
        });
    // Delete Delivery Address
    $(document).on('click', '.addressDelete', function(){
        var result = confirm("Want to delete this address");
        if(!result){
            return false;
        }
    });

    // Calculate Shipping Charges and Updated Grand Total
    $("input[name=address_id]").bind('change', function(){
        var shipping_charges = $(this).attr("shipping_charges");
        var total_price = $(this).attr("total_price");
        var coupon_amount = $(this).attr("coupon_amount");
        var codpincodeCount = $(this).attr("codpincodeCount");
        var prepaidpincodeCount = $(this).attr("prepaidpincodeCount");

        if(codpincodeCount > 0){
            // Show COD Method
            $(".codMethod").show();
        }else{
            // Hide COD Method
            $(".codMethod").hide();
        }

        if(prepaidpincodeCount>0){
            // Show Prepaid Method
            $(".prepaidMethod").show();
        }else{
            // Hide Prepaid Method
            $(".prepaidMethod").hide();
        }
        if(coupon_amount == ""){
            coupon_amount= 0;
        }
        // alert(shipping_charges);
        $(".shipping_charges").html("Rs."+shipping_charges);
        var grand_total= parseInt(total_price) + parseInt(shipping_charges) - parseInt(coupon_amount);
        // alert(grand_total);
        $(".grand_total").html("Rs."+grand_total);
    });

    $("#checkPincode").click(function(){
        var pincode = $("#pincode").val();
        // alert(pincode);
        if(pincode == ""){
            // alert("Please enter delivery pincode"); return false;
        }
        $.ajax({
            type: 'post',
            data: {pincode: pincode},
            url: '/check-pincode',
            success: function(resp){
                alert(resp);
            },error: function(){
                alert("Error");
            }
        });
    })
});