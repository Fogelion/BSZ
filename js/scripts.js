
$(document).ready(function() {
		
	/*Отображение участков согласно выборанному цеху на странице добавления/редактирования записей*/	
	var add_rec_locs = function() {
		$(".er_location").on("mouseenter", function() {
			var $id_shop = $('.er_shop').val();
			console.log($id_shop);
			$('.er_location').children().hide();
			var $locOn = $('option.id_shop_' + $id_shop);
			console.log($locOn);
			$locOn.show();
		});
	};

/*Отображение участков согласно выборанному цеху на странице списка цехов и участков*/
	var listLocsInShop = function() {
			$(".shops_list a span.list_shop").toArray().forEach(function (element) {
			$(element).on("click", function () {
				console.log(element);
				var $shopClass = $(element).parent().attr("class");
				console.log($shopClass);
				$(".locs_list > *").hide();
    		var $locOn = $(".locs_list ." + $shopClass);
    		console.log($locOn);
   			$locOn.show();
 				return false;
 			});
    });
	};

/*Изменение вида выбранного цеха*/
	var listActiveShop = function() {
		$(".shops_list a span.list_shop").toArray().forEach(function (element) {
			$(element).on("click", function () {
    		$(".shops_list a span.list_shop").removeClass("active");
   			$(element).addClass("active");
 				return false;
 			});
    });
  };


  var viewShopDeleteButtonShow = function() {
  	$("#view_shop_delete_button_show").on("click", function() {
  		$(".view_shop_delete_check").show();
  	});
  };

  var viewShopDeleteButtonHide = function() {
  	$("#view_shop_delete_button_hide").on("click", function() {
  		$(".view_shop_delete_check").hide();
  	});
  };








add_rec_locs();
listLocsInShop();
listActiveShop();
viewShopDeleteButtonShow();
viewShopDeleteButtonHide();

});





/*  var confirmation = function() {
  	$("#view_shop_form").submit(function(e) {
  		console.log("дошло до сабмита");
  		e.preventDefault();
  		if (confirm("Вы уверены, что хотите удалить?")) {
  			return true;
  		} else {
  			e.preventDefault();
  		}
  	});
  };*/