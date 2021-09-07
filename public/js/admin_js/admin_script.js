$(document).ready(function(){
    // Check Admin Password is correct or not
    $('#current_pwd').keyup(function(){
        var current_pwd = $("#current_pwd").val();
        // alert(current_pwd);
        $.ajax({
            type: 'post',
            url: '/admin/check-current-pwd',
            data: {current_pwd:current_pwd},
            success: function(resp){
                // alert(resp);
                if(resp== "false"){
                    $("#chkcurrentPwd").html("<font color=red>Current Password is Incorrect </font>");
                }else if(resp =="true"){
                    $("#chkcurrentPwd").html("<font color=green>Current Password is Correct </font>");
                }
            }, error: function(){
                alert("Error");
            }
        });
    });

    // First Method before adding the active inactive toggle icon

    // $(".updateSectionStatus").click(function(){
    //     var status = $(this).text();
    //     var section_id= $(this).attr('section_id');
    //     // alert(status);
    //     // alert(section_id);
    //     $.ajax({
    //         type: 'post',
    //         url: '/admin/update-section-status',
    //         data: {status:status, section_id: section_id},
    //         success: function(resp){
    //             // alert(resp['status']);
    //             // alert(resp['section_id']);
    //             if(resp['status']== 0){
    //                 $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)' >Inactive");
    //             }else if(resp['status']== 1){
    //                 $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)' >Active");
    //             }
    //         }, error: function(){
    //             alert("Error");
    //         }
    //     })
    // });

    // $(".updateSectionStatus").click(function(){
       $(document).on('click', '.updateSectionStatus', function(){
        var status = $(this).children("i").attr("status");
        var section_id= $(this).attr('section_id');
        // alert(status);
        // alert(section_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-section-status',
            data: {status:status, section_id: section_id},
            success: function(resp){
                // alert(resp['status']);
                // alert(resp['section_id']);
                if(resp['status']== 0){
                    $("#section-"+section_id).html("<i class='fas fa-toggle-off' aria-hidden='true' status='Inactive'></i>");
                }else if(resp['status']== 1){
                    $("#section-"+section_id).html("<i class='fas fa-toggle-on' aria-hidden='true' status='Active'></i>");
                }
            }, error: function(){
                alert("Error");
            }
        })
    });

    // Update Brand Status
    // $(".updateBrandStatus").click(function(){
    $(document).on('click', '.updateBrandStatus', function(){
        // var status = $(this).text();
        var status = $(this).children("i").attr("status");
        // alert(status); return false;
        var brand_id= $(this).attr('brand_id');
        // alert(status);
        // alert(brand_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-brand-status',
            data: {status:status, brand_id: brand_id},
            success: function(resp){
                // alert(resp['status']);
                // alert(resp['section_id']);
                if(resp['status']== 0){
                    $("#brand-"+brand_id).html("<i class='fas fa-toggle-off' aria-hidden='true' status='Inactive'>");
                }else if(resp['status']== 1){
                    $("#brand-"+brand_id).html("<i class='fas fa-toggle-on' aria-hidden='true' status='Active'>");
                }
            }, error: function(){
                alert("Error");
            }
        })
    });

     // Update Admin Status
    // $(".updateAdminStatus").click(function(){
        $(document).on('click', '.updateAdminStatus', function(){
            // var status = $(this).text();
            var status = $(this).children("i").attr("status");
            // alert(status); return false;
            var admin_id= $(this).attr('admin_id');
            // alert(status);
            // alert(admin_id);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/update-admin-status',
                data: {status:status, admin_id: admin_id},
                success: function(resp){
                    // alert(resp['status']);
                    // alert(resp['section_id']);
                    if(resp['status']== 0){
                        $("#admin-"+admin_id).html("<i class='fas fa-toggle-off' aria-hidden='true' status='Inactive'>");
                    }else if(resp['status']== 1){
                        $("#admin-"+admin_id).html("<i class='fas fa-toggle-on' aria-hidden='true' status='Active'>");
                    }
                }, error: function(){
                    alert("Error");
                }
            })
        });

       // Update CMS Status
    // $(".updateBrandStatus").click(function(){
        $(document).on('click', '.updateCmsPageStatus', function(){
            // var status = $(this).text();
            var status = $(this).children("i").attr("status");
            // alert(status); return false;
            var page_id= $(this).attr('page_id');
            // alert(status);
            // alert(page_id);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/update-cms-page-status',
                data: {status:status, page_id: page_id},
                success: function(resp){
                    // alert(resp['status']);
                    // alert(resp['section_id']);
                    if(resp['status']== 0){
                        $("#page-"+page_id).html("<i class='fas fa-toggle-off' aria-hidden='true' status='Inactive'>");
                    }else if(resp['status']== 1){
                        $("#page-"+page_id).html("<i class='fas fa-toggle-on' aria-hidden='true' status='Active'>");
                    }
                }, error: function(){
                    alert("Error");
                }
            })
        });

     // Update User Status
    // $(".updateUserStatus").click(function(){
        $(document).on('click', '.updateUserStatus', function(){
            // var status = $(this).text();
            var status = $(this).children("i").attr("status");
            // alert(status); return false;
            var user_id= $(this).attr('user_id');
            // alert(status);
            // alert(user_id);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/update-user-status',
                data: {status:status, user_id: user_id},
                success: function(resp){
                    // alert(resp['status']);
                    // alert(resp['section_id']);
                    if(resp['status']== 0){
                        $("#user-"+user_id).html("<i class='fas fa-toggle-off' aria-hidden='true' status='Inactive'>");
                    }else if(resp['status']== 1){
                        $("#user-"+user_id).html("<i class='fas fa-toggle-on' aria-hidden='true' status='Active'>");
                    }
                }, error: function(){
                    alert("Error");
                }
            })
        });    

    // Update Category Status
    // $(".updateCategoryStatus").click(function(){
       $(document).on('click', '.updateCategoryStatus', function(){
        // var status = $(this).text();
        var status = $(this).children("i").attr("status");
        var category_id= $(this).attr('category_id');
        // alert(status);
        // alert(section_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-category-status',
            data: {status:status, category_id: category_id},
            success: function(resp){
                // alert(resp['status']);
                // alert(resp['section_id']);
                if(resp['status']== 0){
                    // $("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)' >Inactive");
                    $("#category-"+category_id).html("<i class='fas fa-toggle-off' aria-hidden='true' status='Inactive'>");
                }else if(resp['status']== 1){
                    // $("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)' >Active");
                    $("#category-"+category_id).html("<i class='fas fa-toggle-on' aria-hidden='true' status='Active'>");
                }
            }, error: function(){
                alert("Error");
            }
        })
    });

    // Append Categories Level
    $('#section_id').change(function(){
        var section_id = $(this).val();
        // alert(section_id);
        $.ajax({
            type: 'post',
            url: '/admin/append-categories-level',
            data: {section_id: section_id},
            success: function(resp){
                // alert(resp);
                $("#appendCategoriesLevel").html(resp);
            }, error: function(){
                alert("Error");
            }
        });
    });
    
    // Confirm Deletion of Record
    // $(".confirmDelete").click(function(){
    //     var name= $(this).attr("name");
    //     if(confirm("Are you sure to delete this" + name + "?")){
    //         return true;
    //     }
    //     return false;
    // })

    // Update Product Status

    // $(".updateProductStatus").click(function(){
    $(document).on('click', '.updateProductStatus', function(){
        // var status = $(this).text();
        var status = $(this).children("i").attr("status");
        var product_id= $(this).attr('product_id');
        // alert(status);
        // alert(section_id);
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },  
            type: 'post',
            url: '/admin/update-product-status',
            data: {status:status, product_id: product_id},
            success: function(resp){
                // alert(resp['status']);
                // alert(resp['product_id']);
                if(resp['status']== 0){
                    // $("#product-"+product_id).html("<a class='updateProductStatus' href='javascript:void(0)' >Inactive");
                    $("#product-"+product_id).html("<i class='fas fa-toggle-off' aria-hidden='true' status='Inactive'>");
                   
                }else if(resp['status']== 1){
                    // $("#product-"+product_id).html("<a class='updateProductStatus' href='javascript:void(0)' >Active");
                    $("#product-"+product_id).html("<i class='fas fa-toggle-on' aria-hidden='true' status='Active'>");

                }
            }, error: function(){
                alert("Error");
            }
        })
    });

    // Update Attribute Status

    // $(".updateAttributeStatus").click(function(){
    $(document).on('click', '.updateAttributeStatus', function(){
        var status = $(this).text();
        var attribute_id= $(this).attr('attribute_id');
        // alert(status);
        // alert(section_id);
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-attribute-status',
            data: {status:status, attribute_id: attribute_id},
            success: function(resp){
                // alert(resp['status']);
                // alert(resp['product_id']);
                if(resp['status']== 0){
                    $("#attribute-"+attribute_id).html("Inactive");
                }else if(resp['status']== 1){
                    $("#attribute-"+attribute_id).html("Active");
                }
            }, error: function(){
                alert("Error");
            }
        })
    });

    // $(".updateImageStatus").click(function(){
    $(document).on('click', '.updateImageStatus', function(){
        var status = $(this).text();
        var image_id= $(this).attr('image_id');
        // alert(status);
        // alert(section_id);
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-image-status',
            data: {status:status, image_id: image_id},
            success: function(resp){
                // alert(resp['status']);
                // alert(resp['product_id']);
                if(resp['status']== 0){
                    $("#image-"+image_id).html("Inactive");
                }else if(resp['status']== 1){
                    $("#image-"+image_id).html("Active");
                }
            }, error: function(){
                alert("Error");
            }
        })
    });

    // Update Banner Status

    $(document).on('click', '.updateBannerStatus', function(){
        // var status = $(this).text();
        var status = $(this).children("i").attr("status");
        // alert(status); return false;
        var banner_id= $(this).attr('banner_id');
        // alert(status);
        // alert(brand_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-banner-status',
            data: {status:status, banner_id: banner_id},
            success: function(resp){
                // alert(resp['status']);
                // alert(resp['section_id']);
                if(resp['status']== 0){
                    $("#banner-"+banner_id).html("<i class='fas fa-toggle-off' aria-hidden='true' status='Inactive'>");
                }else if(resp['status']== 1){
                    $("#banner-"+banner_id).html("<i class='fas fa-toggle-on' aria-hidden='true' status='Active'>");
                }
            }, error: function(){
                alert("Error");
            }
        })
    });

    // Update Coupon Status
    $(document).on('click', '.updateCouponStatus', function(){
        // var status = $(this).text();
        var status = $(this).children("i").attr("status");
        // alert(status); return false;
        var coupon_id= $(this).attr('coupon_id');
        // alert(status);
        // alert(brand_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-coupon-status',
            data: {status:status, coupon_id: coupon_id},
            success: function(resp){
                // alert(resp['status']);
                // alert(resp['section_id']);
                if(resp['status']== 0){
                    $("#coupon-"+coupon_id).html("<i class='fas fa-toggle-off' aria-hidden='true' status='Inactive'>");
                }else if(resp['status']== 1){
                    $("#coupon-"+coupon_id).html("<i class='fas fa-toggle-on' aria-hidden='true' status='Active'>");
                }
            }, error: function(){
                alert("Error");
            }
        })
    });

     // Update Shipping Status
    // $(".updateBrandStatus").click(function(){
        $(document).on('click', '.updateShippingStatus', function(){
            // var status = $(this).text();
            var status = $(this).children("i").attr("status");
            // alert(status); return false;
            var shipping_id= $(this).attr('shipping_id');
            // alert(status);
            // alert(shipping_id);
            $.ajax({
                type: 'post',
                url: '/admin/update-shipping-status',
                data: {status:status, shipping_id: shipping_id},
                success: function(resp){
                    // alert(resp['status']);
                    // alert(resp['section_id']);
                    if(resp['status']== 0){
                        $("#shipping-"+shipping_id).html("<i class='fas fa-toggle-off' aria-hidden='true' status='Inactive'>");
                    }else if(resp['status']== 1){
                        $("#shipping-"+shipping_id).html("<i class='fas fa-toggle-on' aria-hidden='true' status='Active'>");
                    }
                }, error: function(){
                    alert("Error");
                }
            })
        });


    // Confirm Deletion with Sweetalert
    //  $(".confirmDelete").click(function(){
    $(document).on("click", ".confirmDelete", function(){
        var record= $(this).attr("record");
        var recordid = $(this).attr("recordid");
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.value) {
              Swal.fire(
                'Deleted!',
                'Category has been deleted.',
                'success'
              )
              window.location.href ="/admin/delete-"+record+"/"+recordid;
            }
          });
        //   return false;
    });


    // Products Attributes Add/Remove Script

    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><div style="height: 10px;"></div><input type="text" name="size[]" style="width:120px;" placeholder="Size" required/>&nbsp;<input type="text" name="sku[]" style="width:120px;" placeholder="SKU" required/><input type="text" name="price[]" style="width:120px;" placeholder="Price"/ required><input type="text" name="stock[]" style="width:120px;" placeholder="Stock" required/><a href="javascript:void(0);" class="remove_button">Delete</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

     // Show/Hide Coupon Field for Manual/Automatic
     $("#ManualCoupon").click(function(){
        $("#couponField").show();
    });

    $("#AutomaticCoupon").click(function(){
        $("#couponField").hide();
    });
    
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    // Show Courier Name and Tracking Number in case of Shipped Order Status
    $("#courier_name").hide();
    $("#tracking_number").hide();
    $("#order_status").on("change", function(){
        // alert(this.value); return false;
        if(this.value == "Shipped"){
            $("#courier_name").show();
            $("#tracking_number").show();
        }else{
            $("#courier_name").hide();
            $("#tracking_number").hide();
        }
    });
});