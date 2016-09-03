/*
	Phantom by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
*/

(function($) {

	skel.breakpoints({
		xlarge:	'(max-width: 1680px)',
		large:	'(max-width: 1280px)',
		medium:	'(max-width: 980px)',
		small:	'(max-width: 736px)',
		xsmall:	'(max-width: 480px)'
	});

	$(function() {

		var	$window = $(window),
			$body = $('body');

		// Disable animations/transitions until the page has loaded.
			$body.addClass('is-loading');

			$window.on('load', function() {
				window.setTimeout(function() {
					$body.removeClass('is-loading');
				}, 100);
			});

		// Touch?
			if (skel.vars.touch)
				$body.addClass('is-touch');

		// Forms.
			var $form = $('form');

			// Auto-resizing textareas.
				$form.find('textarea').each(function() {

					var $this = $(this),
						$wrapper = $('<div class="textarea-wrapper"></div>'),
						$submits = $this.find('input[type="submit"]');

					$this
						.wrap($wrapper)
						.attr('rows', 1)
						.css('overflow', 'hidden')
						.css('resize', 'none')
						.on('keydown', function(event) {

							if (event.keyCode == 13
							&&	event.ctrlKey) {

								event.preventDefault();
								event.stopPropagation();

								$(this).blur();

							}

						})
						.on('blur focus', function() {
							$this.val($.trim($this.val()));
						})
						.on('input blur focus --init', function() {

							$wrapper
								.css('height', $this.height());

							$this
								.css('height', 'auto')
								.css('height', $this.prop('scrollHeight') + 'px');

						})
						.on('keyup', function(event) {

							if (event.keyCode == 9)
								$this
									.select();

						})
						.triggerHandler('--init');

					// Fix.
						if (skel.vars.browser == 'ie'
						||	skel.vars.mobile)
							$this
								.css('max-height', '10em')
								.css('overflow-y', 'auto');

				});

			// Fix: Placeholder polyfill.
				$form.placeholder();

		// Prioritize "important" elements on medium.
			skel.on('+medium -medium', function() {
				$.prioritize(
					'.important\\28 medium\\29',
					skel.breakpoint('medium').active
				);
			});

		// Menu.
			var $menu = $('#menu');

			$menu.wrapInner('<div class="inner"></div>');

			$menu._locked = false;

			$menu._lock = function() {

				if ($menu._locked)
					return false;

				$menu._locked = true;

				window.setTimeout(function() {
					$menu._locked = false;
				}, 350);

				return true;

			};

			$menu._show = function() {

				if ($menu._lock())
					$body.addClass('is-menu-visible');

			};

			$menu._hide = function() {

				if ($menu._lock())
					$body.removeClass('is-menu-visible');

			};

			$menu._toggle = function() {

				if ($menu._lock())
					$body.toggleClass('is-menu-visible');

			};

			$menu
				.appendTo($body)
				.on('click', function(event) {
					event.stopPropagation();
				})
				.on('click', 'a', function(event) {

					var href = $(this).attr('href');

					event.preventDefault();
					event.stopPropagation();

					// Hide.
						$menu._hide();

					// Redirect.
						if (href == '#menu')
							return;

						window.setTimeout(function() {
							window.location.href = href;
						}, 350);

				})
				.append('<a class="close" href="#menu">Close</a>');

			$body
				.on('click', 'a[href="#menu"]', function(event) {

					event.stopPropagation();
					event.preventDefault();

					// Toggle.
						$menu._toggle();

				})
				.on('click', function(event) {

					// Hide.
						$menu._hide();

				})
				.on('keydown', function(event) {

					// Hide on escape.
						if (event.keyCode == 27)
							$menu._hide();

				});

var prev = {start: 0, stop: 0},
    cont = $('.tiles article');
var Paging = $(".pagination").paging(cont.length, { // make all elements navigatable
    //format: '[ < . (qq -) ncn (- pp) > ]', // define how the navigation should look like and in which order onFormat() get's called
    //format: '[ < (q-) ncn (-p) > ]', // define how the navigation should look like and in which order onFormat() get's called
    format: '[ < nncnn > ]', // define how the navigation should look like and in which order onFormat() get's called
    perpage: 3, // show 6 elements per page
    lapping: 0, // don't overlap pages for the moment
    page: null, // start at page, can also be "null" or negative
    onSelect: function (page) {

        var data = this.slice;

				cont.slice(prev[0], prev[1]).css('display', 'none');
				cont.slice(data[0], data[1]).fadeIn("slow");

				prev = data;

				return true; // locate!
    },
    onFormat: function (type) {
        switch (type) {
	        case 'block':
						if (!this.active)
							return '<li><a>' + this.value + '</a></li>';
						else if (this.value != this.page)
							return '<li><a href="#' + this.value + '">' + this.value + '</a></li>';
						return '<li><a class="active">' + this.value + '</a></li>';

					case 'next':
						if (this.active)
							return '<li><a href="#' + this.value + '" class="next icon fa-angle-right"></a></li>';
						return '<li><a class="disabled icon fa-angle-right"></a></li>';

					case 'prev':
						if (this.active)
							return '<li><a href="#' + this.value + '" class="prev icon fa-angle-left"></a></li>';
						return '<li><a class="disabled icon fa-angle-left"></a></li>';

					case 'first':
						if (this.active)
							return '<li><a href="#' + this.value + '" class="first icon fa-angle-double-left"></a></li>';
						return '<li><a class="disabled icon fa-angle-double-left"></a></li>';

					case 'last':
						if (this.active)
							return '<li><a href="#' + this.value + '" class="last icon fa-angle-double-right"></a></li>';
						return '<li><a class="disabled icon fa-angle-double-right"></a></li>';

					case "leap":
						if (this.active)
							return '<li><a>&nbsp;</a></li>';
						return "";

					case 'fill':
						if (this.active)
							return '<li><a>...</a></li>';
						return "";
					case 'right':
 					case 'left':
						if (!this.active) {
							return '';
						}
						return '<li><a href="#' + this.value + '">' + this.value + '</a></li>';
				}
    	}
});

$(window).hashchange(function() {
	if (window.location.hash)
		Paging.setPage(window.location.hash.substr(1));
	else
		Paging.setPage(1); // we dropped the initial page selection and need to run it manually
});

$(window).hashchange();

	});

$('#login_button').click(function(){
	var username = $('#username').val();
	var password = $('#password').val();
	var encpass = btoa(btoa(btoa(password)));
	$.post("services/loginandout",{action:"login",username:username,password:encpass},function(data){
		if( data == "1"){
			// SUCCESS
			window.location.reload(true);
		} else {
			// FAIL
			$('#username').val('');
			$('#password').val('');
		}
	});
});
$('#logout_button').click(function(){
	$.post("services/loginandout",{action:"logout"},function(data){
		if( data == "1"){
			// SUCCESS
			window.location.reload(true);
		} else {
			// FAIL
		}
	});
});

$('#newBoxForm').hide();
$('#noNewBox').hide();
$('#newBox,#noNewBox').click(function(){
	$('#newBoxForm').toggle();
	$('#newBox').toggle();
	$('#noNewBox').toggle();
});

    $( document ).tooltip({
      position: {
        my: "center bottom-20",
        at: "center top",
        using: function( position, feedback ) {
          $( this ).css( position );
          $( "<div>" )
            .addClass( "arrow" )
            .addClass( feedback.vertical )
            .addClass( feedback.horizontal )
            .appendTo( this );
        }
      },
      items: "[title], [box], [face], [hair], [hand], [bodypart], [accessory], [nendoroid]",
      content: function() {
      	var element = $(this);
      	if( element.is("[title]") ){
      		return element.attr("title");
      	}
        if( element.is("[box]") ){
          var numtooltip = "";
          if( element.attr("number").length > 0 ){
            numtooltip = " #" + element.attr("number");
          }
          return "<b style='color:#F57921;'>" + element.attr("category") + "</b>" +
            numtooltip +
            "<br/>" + element.attr("name") +
            "<br/><i style='font-size:0.6em;'>" + element.attr("sortingfield") + ": " + element.attr("sortingvalue") + "</i>" ;
        }
      	if( element.is("[face]") ){
      		return "<b style='color:#F57921;'>Eyes: </b>" + element.attr("eyes") +
    				"<br/><b style='color:#F57921;'>"+"Mouth: </b>" + element.attr("mouth");
      	}
      	if( element.is("[hair]") ){
      		return "<b style='color:#F57921;'>" + element.attr("frontback") + "</b>" +
      			"<br/><b style='color:#F57921;'>Haircut: </b>" + element.attr("haircut") +
      			"<br/><b style='color:#F57921;'>Description: </b>" + element.attr("description");
      	}
      	if( element.is("[hand]") ){
      		return "<b style='color:#F57921;'>" + element.attr("leftright") + "</b>" +
      			"<br/><b style='color:#F57921;'>Posture: </b>" + element.attr("posture");
      	}
      	if( element.is("[bodypart]") ){
      		return "<b style='color:#F57921;'>" + element.attr("bodypart") + "</b>" +
      			"<br/><b style='color:#F57921;'>Description: </b>" + element.attr("description");
      	}
        if( element.is("[accessory]") ){
          return "<b style='color:#F57921;'>" + element.attr("accessory") + "</b>" +
            "<br/><b style='color:#F57921;'>Description: </b>" + element.attr("description");
        }
      	if( element.is("[nendoroid]") ){
      		return element.attr("origin") + " - " + element.attr("name");
      	}
      }
    });

    $('#new_box_submit').click(function(){
      $('#new_box_submit').prop('disabled',true);
      $('#new_box_submit').prop('value','Adding...');
      var new_box_number = $('#new_box_number').val();
      var new_box_name = $('#new_box_name').val();
      var new_box_series = $('#new_box_series').val();
      var new_box_manufacturer = $('#new_box_manufacturer').val();
      var new_box_category = $('#new_box_category').val();
      var new_box_price = $('#new_box_price').val();
      var new_box_releasedate = $('#new_box_releasedate').val();
      var new_box_specifications = $('#new_box_specifications').val();
      var new_box_sculptor = $('#new_box_sculptor').val();
      var new_box_cooperation = $('#new_box_cooperation').val();
      var new_box_officialurl = $('#new_box_officialurl').val();

      $.post("services/box/add",
        {
          new_box_number:new_box_number,
          new_box_name:new_box_name,
          new_box_series:new_box_series,
          new_box_manufacturer:new_box_manufacturer,
          new_box_category:new_box_category,
          new_box_price:new_box_price,
          new_box_releasedate:new_box_releasedate,
          new_box_specifications:new_box_specifications,
          new_box_sculptor:new_box_sculptor,
          new_box_cooperation:new_box_cooperation,
          new_box_officialurl:new_box_officialurl
        },function(data){
          if(data.result == "success"){
            window.location.assign("box/"+data.new_box_internalid+"/"+data.new_box_url+"/");
          } else {
            $('#new_box_submit').prop('disabled',false);
            $('#new_box_submit').prop('value','Add Box');
            $('#warning_message').html('<strong>Warning:</strong> Something wrong has occurred and your request was not a success, please retry...');
            $('#warning_message').fadeIn();
          }
        }
      );
    });

    $('#new_nendoroid_submit').click(function(){
      $('#new_nendoroid_submit').prop('disabled',true);
      $('#new_nendoroid_submit').prop('value','Adding...');

      if($('#new_nendoroid_box_id').val()!=""){
        var new_nendoroid_box_id = $('#new_nendoroid_box_id').val();
        var new_nendoroid_box_name = $('#new_nendoroid_box_name').val();
        var new_nendoroid_name = $('#new_nendoroid_name').val();
        var new_nendoroid_origin = $('#new_nendoroid_origin').val();
        var new_nendoroid_version = $('#new_nendoroid_version').val();
        var new_nendoroid_editor = $('#new_nendoroid_editor').val();
        var new_nendoroid_color = $('#new_nendoroid_color').val();
        $.post("services/nendoroid/add",
          {
            action:"add_nendoroid",
            new_nendoroid_box_id:new_nendoroid_box_id,
            new_nendoroid_box_name:new_nendoroid_box_name,
            new_nendoroid_name:new_nendoroid_name,
            new_nendoroid_origin:new_nendoroid_origin,
            new_nendoroid_version:new_nendoroid_version,
            new_nendoroid_editor:new_nendoroid_editor,
            new_nendoroid_color:new_nendoroid_color
          },function(data){
            if(data.result && data.result == "success"){
              window.location.assign("nendoroid/"+data.nendoroid_url+"_"+data.nendoroid_internalid+"/");
            } else {
              $('#new_nendoroid_submit').prop('disabled',false);
              $('#new_nendoroid_submit').prop('value','Add Nendoroid');
              $('#warning_message').html('<strong>Warning:</strong> Something wrong has occurred and your request was not a success, please retry...');
              $('#warning_message').fadeIn();
            }
          }
        );
      } else {
        $('#new_nendoroid_submit').prop('disabled',false);
        $('#new_nendoroid_submit').prop('value','Add Nendoroid');
        $('#warning_message').html('<strong>Warning:</strong> Please choose a box for this Nendoroid.');
        $('#warning_message').fadeIn();
      }

    });

    $('#new_face_submit').click(function(){
      $('#new_face_submit').prop('disabled',true);
      $('#new_face_submit').prop('value','Adding...');

      if($('#new_face_box_id').val()!="0"){
        var new_face_box_id = $('#new_face_box_id').val();
        var new_face_nendoroid_id = $('#new_face_nendoroid_id').val();
        var new_face_eyes = $('#new_face_eyes').val();
        var new_face_eyes_color = $('#new_face_eyes_color').val();
        var new_face_eyes_color_hex = $('#new_face_eyes_color_hex').val();
        var new_face_mouth = $('#new_face_mouth').val();
        var new_face_skin_color = $('#new_face_skin_color').val();
        var new_face_skin_color_hex = $('#new_face_skin_color_hex').val();
        var new_face_sex = $('#new_face_sex').val();
        $.post("services/face/add",
          {
            action:"add_face",
            new_face_box_id:new_face_box_id,
            new_face_nendoroid_id:new_face_nendoroid_id,
            new_face_eyes:new_face_eyes,
            new_face_eyes_color:new_face_eyes_color,
            new_face_eyes_color_hex:new_face_eyes_color_hex,
            new_face_mouth:new_face_mouth,
            new_face_skin_color:new_face_skin_color,
            new_face_skin_color_hex:new_face_skin_color_hex,
            new_face_sex:new_face_sex
          },function(data){
            if(data.result && data.result == "success"){
              window.location.assign("face/"+data.face_internalid+"/");
            } else {
              $('#new_face_submit').prop('disabled',false);
              $('#new_face_submit').prop('value','Add Face');
              $('#warning_message').html('<strong>Warning:</strong> Something wrong has occurred and your request was not a success, please retry...');
              $('#warning_message').fadeIn();
            }
          }
        );
      } else {
        $('#new_face_submit').prop('disabled',false);
        $('#new_face_submit').prop('value','Add Face');
        $('#warning_message').html('<strong>Warning:</strong> Please choose a box for this Face.');
        $('#warning_message').fadeIn();
      }
    });

    $('#new_hair_submit').click(function(){
      $('#new_hair_submit').prop('disabled',true);
      $('#new_hair_submit').prop('value','Adding...');

      if($('#new_hair_box_id').val()!="0"){
        var new_hair_box_id = $('#new_hair_box_id').val();
        var new_hair_nendoroid_id = $('#new_hair_nendoroid_id').val();
        var new_hair_main_color = $('#new_hair_main_color').val();
        var new_hair_main_color_hex = $('#new_hair_main_color_hex').val();
        var new_hair_other_color = $('#new_hair_other_color').val();
        var new_hair_other_color_hex = $('#new_hair_other_color_hex').val();
        var new_hair_haircut = $('#new_hair_haircut').val();
        var new_hair_frontback = $('#new_hair_frontback').val();
        var new_hair_description = $('#new_hair_description').val();
        $.post("services/hair/add",
          {
            action:"add_hair",
            new_hair_box_id:new_hair_box_id,
            new_hair_nendoroid_id:new_hair_nendoroid_id,
            new_hair_main_color:new_hair_main_color,
            new_hair_main_color_hex:new_hair_main_color_hex,
            new_hair_other_color:new_hair_other_color,
            new_hair_other_color_hex:new_hair_other_color_hex,
            new_hair_haircut:new_hair_haircut,
            new_hair_frontback:new_hair_frontback,
            new_hair_description:new_hair_description
          },function(data){
            if(data.result && data.result == "success"){
              window.location.assign("hair/"+data.hair_internalid+"/");
            } else {
              $('#new_hair_submit').prop('disabled',false);
              $('#new_hair_submit').prop('value','Add Hair');
              $('#warning_message').html('<strong>Warning:</strong> Something wrong has occurred and your request was not a success, please retry...');
              $('#warning_message').fadeIn();
            }
          }
        );
      } else {
        $('#new_hair_submit').prop('disabled',false);
        $('#new_hair_submit').prop('value','Add Hair');
        $('#warning_message').html('<strong>Warning:</strong> Please choose a box for this Hair.');
        $('#warning_message').fadeIn();
      }
    });

    $('#new_hand_submit').click(function(){
      $('#new_hand_submit').prop('disabled',true);
      $('#new_hand_submit').prop('value','Adding...');

      if($('#new_hand_box_id').val()!="0"){
        var new_hand_box_id = $('#new_hand_box_id').val();
        var new_hand_nendoroid_id = $('#new_hand_nendoroid_id').val();
        var new_hand_skin_color = $('#new_hand_skin_color').val();
        var new_hand_skin_color_hex = $('#new_hand_skin_color_hex').val();
        var new_hand_posture = $('#new_hand_posture').val();
        var new_hand_leftright = $('#new_hand_leftright').val();
        var new_hand_description = $('#new_hand_description').val();
        $.post("services/hand/add",
          {
            action:"add_hand",
            new_hand_box_id:new_hand_box_id,
            new_hand_nendoroid_id:new_hand_nendoroid_id,
            new_hand_skin_color:new_hand_skin_color,
            new_hand_skin_color_hex:new_hand_skin_color_hex,
            new_hand_posture:new_hand_posture,
            new_hand_leftright:new_hand_leftright,
            new_hand_description:new_hand_description
          },function(data){
            if(data.result && data.result == "success"){
              window.location.assign("hand/"+data.hand_internalid+"/");
            } else {
              $('#new_hand_submit').prop('disabled',false);
              $('#new_hand_submit').prop('value','Add Hand');
              $('#warning_message').html('<strong>Warning:</strong> Something wrong has occurred and your request was not a success, please retry...');
              $('#warning_message').fadeIn();
            }
          }
        );
      } else {
        $('#new_hand_submit').prop('disabled',false);
        $('#new_hand_submit').prop('value','Add Hair');
        $('#warning_message').html('<strong>Warning:</strong> Please choose a box for this Hand.');
        $('#warning_message').fadeIn();
      }
    });

    $('#new_bodypart_submit').click(function(){
      $('#new_bodypart_submit').prop('disabled',true);
      $('#new_bodypart_submit').prop('value','Adding...');

      if($('#new_bodypart_box_id').val()!="0"){
        var new_bodypart_box_id = $('#new_bodypart_box_id').val();
        var new_bodypart_nendoroid_id = $('#new_bodypart_nendoroid_id').val();
        var new_bodypart_main_color = $('#new_bodypart_main_color').val();
        var new_bodypart_main_color_hex = $('#new_bodypart_main_color_hex').val();
        var new_bodypart_second_color = $('#new_bodypart_second_color').val();
        var new_bodypart_second_color_hex = $('#new_bodypart_second_color_hex').val();
        var new_bodypart_part = $('#new_bodypart_part').val();
        var new_bodypart_description = $('#new_bodypart_description').val();
        $.post("services/bodypart/add",
          {
            action:"add_bodypart",
            new_bodypart_box_id:new_bodypart_box_id,
            new_bodypart_nendoroid_id:new_bodypart_nendoroid_id,
            new_bodypart_main_color:new_bodypart_main_color,
            new_bodypart_main_color_hex:new_bodypart_main_color_hex,
            new_bodypart_second_color:new_bodypart_second_color,
            new_bodypart_second_color_hex:new_bodypart_second_color_hex,
            new_bodypart_part:new_bodypart_part,
            new_bodypart_description:new_bodypart_description
          },function(data){
            if(data.result && data.result == "success"){
              window.location.assign("bodypart/"+data.bodypart_internalid+"/");
            } else {
              $('#new_bodypart_submit').prop('disabled',false);
              $('#new_bodypart_submit').prop('value','Add Bodypart');
              $('#warning_message').html('<strong>Warning:</strong> Something wrong has occurred and your request was not a success, please retry...');
              $('#warning_message').fadeIn();
            }
          }
        );
      } else {
        $('#new_bodypart_submit').prop('disabled',false);
        $('#new_bodypart_submit').prop('value','Add Bodypart');
        $('#warning_message').html('<strong>Warning:</strong> Please choose a box for this Bodypart.');
        $('#warning_message').fadeIn();
      }
    });

    $('#new_accessory_submit').click(function(){
      $('#new_accessory_submit').prop('disabled',true);
      $('#new_accessory_submit').prop('value','Adding...');

      if($('#new_accessory_box_id').val()!="0"){
        var new_accessory_box_id = $('#new_accessory_box_id').val();
        var new_accessory_nendoroid_id = $('#new_accessory_nendoroid_id').val();
        var new_accessory_type = $('#new_accessory_type').val();
        var new_accessory_main_color = $('#new_accessory_main_color').val();
        var new_accessory_main_color_hex = $('#new_accessory_main_color_hex').val();
        var new_accessory_other_color = $('#new_accessory_other_color').val();
        var new_accessory_other_color_hex = $('#new_accessory_other_color_hex').val();
        var new_accessory_description = $('#new_accessory_description').val();
        $.post("services/accessory/add",
          {
            action:"add_accessory",
            new_accessory_box_id:new_accessory_box_id,
            new_accessory_nendoroid_id:new_accessory_nendoroid_id,
            new_accessory_type:new_accessory_type,
            new_accessory_main_color:new_accessory_main_color,
            new_accessory_main_color_hex:new_accessory_main_color_hex,
            new_accessory_other_color:new_accessory_other_color,
            new_accessory_other_color_hex:new_accessory_other_color_hex,
            new_accessory_description:new_accessory_description
          },function(data){
            if(data.result && data.result == "success"){
              window.location.assign("accessory/"+data.accessory_internalid+"/");
            } else {
              $('#new_accessory_submit').prop('disabled',false);
              $('#new_accessory_submit').prop('value','Add Accessory');
              $('#warning_message').html('<strong>Warning:</strong> Something wrong has occurred and your request was not a success, please retry...');
              $('#warning_message').fadeIn();
            }
          }
        );
      } else {
        $('#new_accessory_submit').prop('disabled',false);
        $('#new_accessory_submit').prop('value','Add Accessory');
        $('#warning_message').html('<strong>Warning:</strong> Please choose a box for this Accessory.');
        $('#warning_message').fadeIn();
      }
    });

    $('.dropzone').hide();

    $('.editpic').click(function(){
      var spanZoneId = 'span_'+$(this)[0].id.split('_')[1];
      var dropZoneId = 'drop_'+$(this)[0].id.split('_')[1];
      var internalid = $(this).attr('internalid');
      var parttype = $(this).attr('part');

      $('#'+spanZoneId).hide();
      $('#'+dropZoneId).show();
      $('#'+dropZoneId).css('height',$('#'+dropZoneId).css('width'));

      var dropZone = new FileDrop(dropZoneId);
      dropZone.event('send',function(files){
        files.each(function(file){
          file.event('done',function(xhr){
            var jsonrep = $.parseJSON(xhr.response);
            if( jsonrep.result == "success" ){
              $('#span_'+jsonrep.part+jsonrep.internalid+' img').prop('src',$('#span_'+jsonrep.part+jsonrep.internalid+' img').prop('src')+'?ts='+Date.now());
              $('#'+spanZoneId).show();
              $('#'+dropZoneId).hide();
            }
          });
          file.sendTo('services/'+parttype+'/'+internalid+'/picupload');
        });
      });
    });

    $('.withadd').each(function(){
      $(this).css('height',$(this).css('width'));
      $(this).children().css('padding-top',($(this).height()-$(this).children().height())/2);
    });

    $('.select_box_id').change(function(){
      $('option.nendoroid').show();
      if($(this).val()!="0"){
        $('option.nendoroid[box!='+$(this).val()+']').hide();
        $('option.nendoroid[value=0]').show();
      }
    });

    $('.select_nendoroid_id').change(function(){
      $('option.box').show();
      if($(this).val()!="0"){
        var correspbox = $('option.nendoroid[value='+$(this).val()+']').attr('box');
        $('option.box[value!='+correspbox+']').hide();
        $('option.box[value='+correspbox+']').prop('selected',true);
      }
    });

    $('.color_to_name').change(function(){
      var id_name = $(this)[0].id.substring(0,$(this)[0].id.length-4);
      $('#'+id_name).val(ntc.name($(this).val())[1]);
    });

    $('#menu_button').click(function(){
      $('#menu_area').toggle();
      $('#menu_area .label').css('height',$('#menu_area div.select-wrapper').css('height'));
      $('#menu_area .label').css('line-height',$('#menu_area div.select-wrapper').css('height'));
    });

    $('#order,#direction').change(function(){
      window.location.assign($('#menu_area').attr('sortdest')+"/orderby/"+$('#order').val()+"_"+$('#direction').val()+"/");
    });

    $('.field_edit').click(function(){
      $('i[field='+$(this).attr('field')+']').toggle();
      $('input[field='+$(this).attr('field')+']').toggle();
      $('span[field='+$(this).attr('field')+']').toggle();
    });

    $('.field_valid').click(function(){
      if($(this).hasClass('fa-check')){ // button Validate => See if it can be better to do the test on another thing than a CSS class...
        var value = $('input[field='+$(this).attr('field')+']').val();
        var field = $(this).attr('field');
        var element = $('#info_table').attr('element');
        var internalid = $('#info_table').attr('internalid');

        $.post("services/"+element+"/"+internalid+"/edit",
          {
            field:field,
            value:value
          },function(data){
            if(data.result && data.result == "success"){
              if(data.field != 'officialurl' ){
                $('span[field='+data.field+']').html(data.value);
              } else {
                $('span[field='+data.field+']a').attr('href',data.value);
              }
              $('i[field='+data.field+']').toggle();
              $('input[field='+data.field+']').toggle();
              $('span[field='+data.field+']').toggle();
            } else {
              alert('Please correct your field...');
            }
          }
        );
      }
    });

})(jQuery);
