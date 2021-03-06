$(document).ready(function() {

	/*Отображение участков согласно выборанному цеху на странице добавления/редактирования записей и в фильтре на главноё странице*/
	var add_rec_locs = function() {
		$(".er_location").on("mouseenter", function() {
			var $id_shop = $('.er_shop').val();
			$('.er_location').children().hide();
			var $locOn = $('option.id_shop_' + $id_shop);
      $("#selected_empty_loc").show();  /*Всегда отображать в фильтре нейтральный цчасток для адекватной фильтрации цехов*/
			$locOn.show();
		});
	};

/*Отображение участков согласно выборанному цеху на странице списка цехов и участков*/
	var listLocsInShop = function() {
			$(".shops_list a span.list_shop").toArray().forEach(function (element) {
			$(element).on("click", function () {
				var $shopClass = $(element).parent().attr("class");
				$(".locs_list > *").hide();
    		var $locOn = $(".locs_list ." + $shopClass);
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

      var whereDefault = "";
      var $where = "WHERE ";
      var $status = $(".filter_status").val();
      var $loc = $(".filter_loc").val();
      var $alert = $("[name=index_alert]:checked").val();
      /*console.log($alert);*/

      //так как в таблице записей нет цехов, то ищутся все участки, принадлежащие этому цеху
      var $shop = $(".filter_shop").val();
      var $locsInShop = [];
      $(".filter_loc option").each(function () {
        $idLoc = $(this).val();
        $isLocForShop = $idLoc.indexOf($shop);
        if ($isLocForShop === 0) {
          $locsInShop.push($idLoc);
        }
      });



      if ($alert == 1) {                                                      //фильтр по алёрту
        $where += "alert=" + $alert;
      } else if($status !=="" && $shop == "" && $loc == "") {                  //фильтр по статусу
        $where += $status;
      } else if ($status !=="" && $shop !== "" && $loc == "") {                // фильтр по статусу и цеху
        $where += $status + " AND ( ";
        $locsInShop.forEach(function(elem) {
          $where += "id_loc=" + elem + " OR ";
        });
        $where = $where.substr(0, ($where.length-4));
        $where += " )";
      } else if ($status =="" && $shop !== "" && $loc == "") {                 // фильтр по цеху
        $locsInShop.forEach(function(elem) {
          $where += "id_loc=" + elem + " OR ";
        });
        $where = $where.substr(0, ($where.length-4));
      } else if($status !=="" && $loc !== "") {                                //фильтр по статусу и участку
        $where += $status + " AND " + "id_loc=" + $loc;
      } else if($status =="" && $loc !== "") {                                 //фильтр по участку
        $where += "id_loc=" + $loc;
      } else {
        $where = whereDefault;
      }
      var $href = "index.php?index_order=" + $order + "&index_where=" + $where;
      console.log("$locsInShop=" + $locsInShop);
      console.log("$loc=" + $loc);
      console.log($href);
      $("#filter_href").attr("href", $href);
    });

  };


/*Скрыть или показать окошко фильтра и изменить надпись на кнопке*/
  var hideFilter = function() {
    var nameFilter = function() {
      var $filterStyle = $("#all_filter").attr("style");
      if ($filterStyle == "display: none;") {
        $("#filter_button").text("Показать фильтр");
      } else {
        $("#filter_button").text("Скрыть фильтр");
      }
    };
    nameFilter();
    $("#filter_button").on("click", function () {
      $("#all_filter").toggle();
      nameFilter();
    });
  };


/*Скрыть лишний знак алёрта*/
  var hideAlert = function() {
    $(".record").each(function() {
      $alertVal = $(".alert_val", this).html();
      if ($alertVal == 0) {
        $(".fa-exclamation-circle", this).hide();
      }
    });
  };

/*Скрыть пустое поле замечаний*/
  var hideNotice = function() {
    $(".record").each(function() {
      $noticeVal = $(".notice_val", this).html();
      if ($noticeVal == "") {
        $(".notice", this).hide();
      }
    });
  };

/*сброс выбранного участка в фильтре, чтобы можно было перевыбирать один лишь цех*/
  var resetSelectedLocs = function() {
    $("#filt_loc option").each(function() {
        $(this).removeAttr("selected");
      });
      $("#selected_empty_loc").attr("selected", true);
  };




add_rec_locs();
listLocsInShop();
listActiveShop();
viewShopDeleteButtonShow();
viewShopDeleteButtonHide();
indexFormTheFilter();
hideFilter();
hideAlert();
hideNotice();
resetSelectedLocs();

});

