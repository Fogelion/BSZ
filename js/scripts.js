$(document).ready(function() {

	/*Отображение участков согласно выборанному цеху на странице добавления/редактирования записей и в фильтре на главноё странице*/
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

//Показать окно подтверждения удаления цеха
  var viewShopDeleteButtonShow = function() {
  	$("#view_shop_delete_button_show").on("click", function() {
  		$(".view_shop_delete_check").show();
  	});
  };
//Скрыть окно подтверждения удаления цеха
  var viewShopDeleteButtonHide = function() {
  	$("#view_shop_delete_button_hide").on("click", function() {
  		$(".view_shop_delete_check").hide();
  	});
  };

 /* Фильтр - формирование href в кнопке на основе выбранных пунтков для последующеё отправки GET-зароса с неё*/
  var indexFormTheFilter = function() {
    var hrefFilterDefault = "#";
    $("#apply_filter").on("mouseenter", function() {
      var orderDefault = "ORDER BY time DESC, id_rec DESC";
      var $order =  "ORDER BY ";
      var $time = $(".filter_time").val();
      var $id = $(".filter_id").val();
      if (($time == "") && ($id !== "")) {
         $order += $id;
      } else if (($time !== "") && ($id == "")) {
        $order += $time;
      } else if (($time !== "" ) && ($id !== "")) {
        $order += $time + ", " + $id;
      } else {
        $order = orderDefault;
      }
      console.log($order);

      var whereDefault = "";
      var $where = "WHERE ";
      var $status = $(".filter_status").val();
      if ($status !=="") {
        $where += $status;
      } else {
        $where = whereDefault;
      }
      var $href = "index.php?index_order=" + $order + "&index_where=" + $where;
      console.log($href);
      $("#filter_href").attr("href", $href);
    });

  };






add_rec_locs();
listLocsInShop();
listActiveShop();
viewShopDeleteButtonShow();
viewShopDeleteButtonHide();
indexFormTheFilter();

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