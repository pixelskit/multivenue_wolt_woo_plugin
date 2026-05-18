(function( $ ) {
	'use strict';

	jQuery(function($){
		$('.webexpert-wolt-inventory-settings-wrap select').select2({width: '350px'});

		$(document).ready(function(){
			$('.we-wolt-inventory-smart-switch').on('click',function(e){
				e.preventDefault();

				if ($(this).attr('data-action')==="include") {
					$(this).attr('data-action',"exclude");
					$(this).text($(this).data('lang-exclude'));
					$(this).parent().parent().next().find('input[type="checkbox"]').prop('checked', false);
				}else {
					$(this).attr('data-action',"include");
					$(this).text($(this).data('lang-include'));
					$(this).parent().parent().next().find('input[type="checkbox"]').prop('checked', true);
				}
			})

			$('#wolt-inventory-update').on("click",function (e) {
				var $this=$(this);
				e.preventDefault();
				$this.addClass('disabled').addClass('is-active');
				jQuery.ajax({
					type : "post",
					dataType : "json",
					url : webexpert_wolt_inv_ajax_object.ajax_url,
					data : {action: "webexpert_webexpert_wolt_inventory_force_inventory_update", nonce: webexpert_wolt_inv_ajax_object.nonce},
					success: function(response) {
						$this.removeClass('disabled').removeClass('is-active');
						console.log(response);
						if(response.success) {
							$('#wolt-inventory-update-inventory-label').text(response.data);
							alert("Success");
						}
						else {
							alert(response.data);
						}
					}
				})
			});

			$('#wolt-xml-fetch_order').on("click",function (e) {
				var $this=$(this);
				e.preventDefault();
				$this.addClass('disabled').addClass('is-active');
				jQuery.ajax({
					type : "post",
					dataType : "json",
					url : webexpert_wolt_inv_ajax_object.ajax_url,
					data : {action: "webexpert_webexpert_wolt_inventory_fetch_order", order_id: $('#webexpert_wolt_inventory_order_id').val(), nonce: webexpert_wolt_inv_ajax_object.nonce},
					success: function(response) {
						$this.removeClass('disabled').removeClass('is-active');
						console.log(response);
						if(response.success) {
							alert($this.data('success')+' '+response.data.order_id);
						}
						else {
							alert(response.data);
						}
					}
				})
			});

			$('#wolt-items-update').on("click",function (e) {
				var $this=$(this);
				e.preventDefault();
				$this.addClass('disabled').addClass('is-active');
				jQuery.ajax({
					type : "post",
					dataType : "json",
					url : webexpert_wolt_inv_ajax_object.ajax_url,
					data : {action: "webexpert_webexpert_wolt_inventory_force_item_update", nonce: webexpert_wolt_inv_ajax_object.nonce},
					success: function(response) {
						$this.removeClass('disabled').removeClass('is-active');
						console.log(response);
						if(response.success) {
							$('#wolt-inventory-update-label').text(response.data);
							alert("Success");
						}
						else {
							alert(response.data);
						}
					}
				})
			});

			$('#wolt-csv-generate').on("click",function (e) {
				var $this=$(this);
				e.preventDefault();
				$this.addClass('disabled').addClass('is-active');
				jQuery.ajax({
					type : "post",
					dataType : "json",
					url : webexpert_wolt_inv_ajax_object.ajax_url,
					data : {action: "webexpert_webexpert_wolt_inventory_csv_generate", nonce: webexpert_wolt_inv_ajax_object.nonce},
					success: function(response) {
						$this.removeClass('disabled').removeClass('is-active');
						console.log(response);
						if(response.success) {
							var link = document.createElement('a');
							link.href = response.data.url;
							link.download = 'products.csv';
							link.target = '_blank';
							link.click();
						}
						else {
							alert(response.data);
						}
					}
				})
			});

			$('#wolt-xml-generate').on("click",function (e) {
				var $this=$(this);
				e.preventDefault();
				$this.addClass('disabled').addClass('is-active');
				jQuery.ajax({
					type : "post",
					dataType : "json",
					url : webexpert_wolt_inv_ajax_object.ajax_url,
					data : {action: "webexpert_webexpert_wolt_inventory_xml_generate", nonce: webexpert_wolt_inv_ajax_object.nonce},
					success: function(response) {
						$this.removeClass('disabled').removeClass('is-active');
						console.log(response);
						if(response.success) {
							var link = document.createElement("a")
							link.href = response.data.url;
							link.target = "_blank";
							link.click()
						}
						else {
							alert(response.data);
						}
					}
				})
			});
		});

		// Copy webhook URL
		$('#wolt_inventory_copy_webhook_url').on('click', function() {
			var $input = $('#wolt_inventory_webhook_url_field');
			$input[0].select();
			navigator.clipboard.writeText($input.val()).then(function() {
				var $btn = $('#wolt_inventory_copy_webhook_url');
				var orig = $btn.text();
				$btn.text('✓');
				setTimeout(function() { $btn.text(orig); }, 1500);
			});
		});
	});

})( jQuery );
