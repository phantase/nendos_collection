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
	$.post("loginandout",{action:"login",username:username,password:encpass},function(data){
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
	$.post("loginandout",{action:"logout"},function(data){
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
      items: "[title], [face], [hair], [hand], [bodypart], [accessory], [nendoroid]",
      content: function() {
      	var element = $(this);
      	if( element.is("[title]") ){
      		return element.attr("title");
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

    function addBox() {
      var new_box_name = $('#new_box_name').val();
      var new_box_type = $('#new_box_type').val();
      $.post("box/add",{action:"add_box",new_box_name:new_box_name,new_box_type:new_box_type},function(data){
        if(data.result == "success"){
          window.location.replace("box/"+data.box_name+"_"+data.box_internalid+"/");
        } else {
          dialog_new_box.dialog("open");
        }
        console.log(data);
      });
      dialog_new_box.dialog("close");
      return true;
    }

    var dialog_new_box = $('#dialog_new_box').dialog({
      autoOpen: false,
      height: 400,
      width: 350,
      modal: true,
      buttons: {
        "Create a box": addBox,
        Cancel: function() {
          dialog_new_box.dialog("close");
        }
      },
      close: function() {
        // do nothing
      }
    });

    $('#button_new_box').click(function(){
      dialog_new_box.dialog("open");
    });

    $('.dropzone').hide();

    $('.editpic').click(function(){
      var spanZoneId = 'span_'+$(this)[0].id.split('_')[1];
      var dropZoneId = 'drop_'+$(this)[0].id.split('_')[1];
      var boxInternalid = $(this)[0].id.split('_')[1].substring(3);

      $('#'+spanZoneId).hide();
      $('#'+dropZoneId).show();
      $('#'+dropZoneId).css('height',$('#'+dropZoneId).css('width'));

      var dropZone = new FileDrop(dropZoneId);
      dropZone.event('send',function(files){
        files.each(function(file){
          file.event('done',function(xhr){
            console.log('HEREHEREHEREHERE');
            console.log(xhr);
            console.log('EREHEREHEREHEREH');
          });
          file.sendTo('box/'+boxInternalid+'/picupload');
        });
      });
    });

})(jQuery);
