$(function(){

// Login button
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
// Logout button
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

// JQuery UI Tooltips
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
        var box_number_tooltip = "";
        if( element.attr("box_number").length > 0 ){
          box_number_tooltip = " #" + element.attr("box_number");
        }
        var sorting_tooltip = "";
        if( element.attr("sortingfield").length > 0 ){
          sorting_tooltip = "<br/><i style='font-size:0.6em;'>" + element.attr("sortingfield") + ": " + element.attr("sortingvalue") + "</i>";
        }
        return "<b style='color:#F57921;'>" + element.attr("box_category") + "</b>" +
          box_number_tooltip +
          "<br/>" + element.attr("box_name") +
          sorting_tooltip;
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
        var box_number_tooltip = "";
        if( element.attr("box_number").length > 0 ){
          box_number_tooltip = " #" + element.attr("box_number");
        }
        var sorting_tooltip = "";
        if( element.attr("sortingfield").length > 0 ){
          sorting_tooltip = "<br/><i style='font-size:0.6em;'>" + element.attr("sortingfield") + ": " + element.attr("sortingvalue") + "</i>";
        }
        return "<b style='color:#F57921;'>" + element.attr("box_category") + "</b>" +
          box_number_tooltip +
          "<br/>" + element.attr("nendoroid_name") +
          sorting_tooltip;
      }
    }
  });

// New Box form submit button
  $('#new_box_submit').click(function(){
    $('#new_box_submit').prop('disabled',true);
    $('#new_box_submit').prop('value','Adding...');
    var new_box_number          = $('#new_box_number').val();
    var new_box_name            = $('#new_box_name').val();
    var new_box_series          = $('#new_box_series').val();
    var new_box_manufacturer    = $('#new_box_manufacturer').val();
    var new_box_category        = $('#new_box_category').val();
    var new_box_price           = $('#new_box_price').val();
    var new_box_releasedate     = $('#new_box_releasedate').val();
    var new_box_specifications  = $('#new_box_specifications').val();
    var new_box_sculptor        = $('#new_box_sculptor').val();
    var new_box_cooperation     = $('#new_box_cooperation').val();
    var new_box_officialurl     = $('#new_box_officialurl').val();

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
// New Nendoroid form submit button
  $('#new_nendoroid_submit').click(function(){
    $('#new_nendoroid_submit').prop('disabled',true);
    $('#new_nendoroid_submit').prop('value','Adding...');

    if($('#new_nendoroid_box_id').val()!=""){
      var new_nendoroid_box_id    = $('#new_nendoroid_box_id').val();
      var new_nendoroid_box_name  = $('#new_nendoroid_box_name').val();
      var new_nendoroid_name      = $('#new_nendoroid_name').val();
      var new_nendoroid_origin    = $('#new_nendoroid_origin').val();
      var new_nendoroid_version   = $('#new_nendoroid_version').val();
      var new_nendoroid_editor    = $('#new_nendoroid_editor').val();
      var new_nendoroid_color     = $('#new_nendoroid_color').val();
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
// New Face form submit button
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
// New Hair form submit button
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
// New Hand form submit button
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
// New Bodypart form submit button
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
// New Accessory form submit button
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

// Edit picture button
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

// Resizing empty image .withadd
  $('.withadd').each(function(){
    $(this).css('height',$(this).css('width'));
    $(this).children().css('padding-top',($(this).height()-$(this).children().height())/2);
  });
// New part form: react to change of Box
  $('.select_box_id').change(function(){
    $('option.nendoroid').show();
    if($(this).val()!="0"){
      $('option.nendoroid[box!='+$(this).val()+']').hide();
      $('option.nendoroid[value=0]').show();
    }
  });
// New part form: react to change of Nendoroid
  $('.select_nendoroid_id').change(function(){
    $('option.box').show();
    if($(this).val()!="0"){
      var correspbox = $('option.nendoroid[value='+$(this).val()+']').attr('box');
      $('option.box[value!='+correspbox+']').hide();
      $('option.box[value='+correspbox+']').prop('selected',true);
    }
  });
// New part form: react to color change
  $('.color_to_name').change(function(){
    var id_name = $(this)[0].id.substring(0,$(this)[0].id.length-4);
    $('#'+id_name).val(ntc.name($(this).val())[1]);
  });

// Button to open Sort Menu
  $('#menu_button').click(function(){
    $('#menu_area').toggle();
    $('#menu_area .label').css('height',$('#menu_area div.select-wrapper').css('height'));
    $('#menu_area .label').css('line-height',$('#menu_area div.select-wrapper').css('height'));
  });
// React to change of direction or sort field
  $('#order,#direction').change(function(){
    window.location.assign($('#menu_area').attr('sortdest')+"/orderby/"+$('#order').val()+"_"+$('#direction').val()+"/");
  });

// Transform a displayed field to an editable field
  $('.field_edit').click(function(){
    $('i[field='+$(this).attr('field')+']').toggle();
    $('input[field='+$(this).attr('field')+']').toggle();
    $('span[field='+$(this).attr('field')+']').toggle();
  });
// Send edited field value to server
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

});
