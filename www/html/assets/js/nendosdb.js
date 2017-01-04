$(function(){

// Login button
  $('#login_submit').click(function(){
    $('#login_submit').prop('disabled',true);
    $('#login_submit').prop('value','Verifying...');
    var username = $('#username').val();
    var password = $('#password').val();
    var encpass = btoa(btoa(btoa(password)));
    $.post("services/login",{username:username,password:encpass},function(data){
      if( data.result == "success" ){
        // SUCCESS
        window.location.assign("/");
      } else {
        // FAIL
        $('#login_submit').prop('disabled',false);
        $('#login_submit').prop('value','Log in');
        $('#password').val('');
        $('#warning_message').html('<strong>Faillure:</strong> '+data.errorInfo);
        $('#warning_message').fadeIn();
      }
    });
  });
// Signup button
  $('#signup_submit').click(function(){
    $('#signup_submit').prop('disabled',true);
    $('#signup_submit').prop('value','Signing up...');
    var usermail = $('#usermail').val();
    var username = $('#username').val();
    var password = $('#password').val();
    var repassword = $('#repassword').val();
    var encpass = btoa(btoa(btoa(password)));
    $.post("services/signup",{usermail:usermail,username:username,password:encpass},function(data){
      if( data.result == "success" ){
        // SUCCESS
        window.location.assign("/");
      } else {
        // FAIL
        $('#signup_submit').prop('disabled',false);
        $('#signup_submit').prop('value','Sign up');
        $('#warning_message').html('<strong>Faillure:</strong> '+data.errorInfo);
        $('#warning_message').fadeIn();
      }
    });
  });
// Logout button
  $('#logout_submit').click(function(){
    $.post("services/logout",{},function(data){
      if( data.result == "success" ){
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
    items: "[title], [histentry], [collectentry], [box], [face], [hair], [hand], [bodypart], [accessory], [nendoroid], [photo]",
    content: function() {
      var element = $(this);
      // DEFAULT (title)
      if( element.is("[title]") ){
        return element.attr("title");
      }
      // HISTENTRY
      if( element.is("[histentry]") ){
        return "<img src='images/nendos/"+element.attr("histentry")+"/"+element.attr("internalid")+".jpg' class='tooltip_histentry'/>";
      }
      // COLLECTENTRY
      if( element.is("[collectentry]") ){
        return "<img src='images/nendos/"+element.attr("collectentry")+"/"+element.attr("internalid")+".jpg' class='tooltip_collectentry'/>";
      }
      // BOX
      if( element.is("[box]") ){
        var box_collection_status_tooltip = "";
        if( element.attr("class").indexOf("checked")>0 ){
          box_collection_status_tooltip = "[Box (<span style='color:#F57921;'>collect</span>)]<br/>";
          if( element.attr("class").indexOf("unchecked")>0 ){
            box_collection_status_tooltip = "[Box (<span style='color:#F57921;'>uncollect</span>)]<br/>";
          }
        }
        if( element.attr("class").indexOf("owned")>0 ){
          box_collection_status_tooltip = "[Box (<span style='color:#8080B3;'>owned</span>)]<br/>";
        }
        var box_number_tooltip = "";
        if( element.attr("box_number").length > 0 ){
          box_number_tooltip = " #" + element.attr("box_number");
        }
        var sorting_tooltip = "";
        if( element.attr("sortingfield") && element.attr("sortingfield").length > 0 ){
          sorting_tooltip = "<br/><i style='font-size:0.6em;'>" + element.attr("sortingfield") + ": " + element.attr("sortingvalue") + "</i>";
        }
        return box_collection_status_tooltip + "<b style='color:#F57921;'>" + element.attr("box_category") + "</b>" +
          box_number_tooltip +
          "<br/>" + element.attr("box_name") +
          sorting_tooltip;
      }
      // FACE
      if( element.is("[face]") ){
        var face_collection_status_tooltip = "";
        if( element.attr("class").indexOf("checked")>0 ){
          face_collection_status_tooltip = "[Face (<span style='color:#F57921;'>collect</span>)]<br/>";
          if( element.attr("class").indexOf("unchecked")>0 ){
            face_collection_status_tooltip = "[Face (<span style='color:#F57921;'>uncollect</span>)]<br/>";
          }
        }
        if( element.attr("class").indexOf("owned")>0 ){
          face_collection_status_tooltip = "[Face (<span style='color:#8080B3;'>owned</span>)]<br/>";
        }
        var sorting_tooltip = "";
        if( element.attr("sortingfield") && element.attr("sortingfield").length > 0 ){
          sorting_tooltip = "<br/><i style='font-size:0.6em;'>" + element.attr("sortingfield") + ": " + element.attr("sortingvalue") + "</i>";
        }
        return face_collection_status_tooltip + "<b style='color:#F57921;'>Eyes: </b>" + element.attr("eyes") +
          "<br/><b style='color:#F57921;'>"+"Mouth: </b>" + element.attr("mouth") +
          sorting_tooltip;
      }
      // HAIR
      if( element.is("[hair]") ){
        var hair_collection_status_tooltip = "";
        if( element.attr("class").indexOf("checked")>0 ){
          hair_collection_status_tooltip = "[Hair (<span style='color:#F57921;'>collect</span>)]<br/>";
          if( element.attr("class").indexOf("unchecked")>0 ){
            hair_collection_status_tooltip = "[Hair (<span style='color:#F57921;'>uncollect</span>)]<br/>";
          }
        }
        if( element.attr("class").indexOf("owned")>0 ){
          hair_collection_status_tooltip = "[Hair (<span style='color:#8080B3;'>owned</span>)]<br/>";
        }
        var sorting_tooltip = "";
        if( element.attr("sortingfield") && element.attr("sortingfield").length > 0 ){
          sorting_tooltip = "<br/><i style='font-size:0.6em;'>" + element.attr("sortingfield") + ": " + element.attr("sortingvalue") + "</i>";
        }
        return hair_collection_status_tooltip + "<b style='color:#F57921;'>" + element.attr("frontback") + "</b>" +
          "<br/><b style='color:#F57921;'>Haircut: </b>" + element.attr("haircut") +
          "<br/><b style='color:#F57921;'>Description: </b>" + element.attr("description") +
          sorting_tooltip;
      }
      // HAND
      if( element.is("[hand]") ){
        var hand_collection_status_tooltip = "";
        if( element.attr("class").indexOf("checked")>0 ){
          hand_collection_status_tooltip = "[Hand (<span style='color:#F57921;'>collect</span>)]<br/>";
          if( element.attr("class").indexOf("unchecked")>0 ){
            hand_collection_status_tooltip = "[Hand (<span style='color:#F57921;'>uncollect</span>)]<br/>";
          }
        }
        if( element.attr("class").indexOf("owned")>0 ){
          hand_collection_status_tooltip = "[Hand (<span style='color:#8080B3;'>owned</span>)]<br/>";
        }
        var sorting_tooltip = "";
        if( element.attr("sortingfield") && element.attr("sortingfield").length > 0 ){
          sorting_tooltip = "<br/><i style='font-size:0.6em;'>" + element.attr("sortingfield") + ": " + element.attr("sortingvalue") + "</i>";
        }
        return hand_collection_status_tooltip + "<b style='color:#F57921;'>" + element.attr("leftright") + "</b>" +
          "<br/><b style='color:#F57921;'>Posture: </b>" + element.attr("posture") +
          sorting_tooltip;
      }
      // BODYPART
      if( element.is("[bodypart]") ){
        var bodypart_collection_status_tooltip = "";
        if( element.attr("class").indexOf("checked")>0 ){
          bodypart_collection_status_tooltip = "[Bodypart (<span style='color:#F57921;'>collect</span>)]<br/>";
          if( element.attr("class").indexOf("unchecked")>0 ){
            bodypart_collection_status_tooltip = "[Bodypart (<span style='color:#F57921;'>uncollect</span>)]<br/>";
          }
        }
        if( element.attr("class").indexOf("owned")>0 ){
          bodypart_collection_status_tooltip = "[Bodypart (<span style='color:#8080B3;'>owned</span>)]<br/>";
        }
        var sorting_tooltip = "";
        if( element.attr("sortingfield") && element.attr("sortingfield").length > 0 ){
          sorting_tooltip = "<br/><i style='font-size:0.6em;'>" + element.attr("sortingfield") + ": " + element.attr("sortingvalue") + "</i>";
        }
        return bodypart_collection_status_tooltip + "<b style='color:#F57921;'>" + element.attr("part") + "</b>" +
          "<br/><b style='color:#F57921;'>Description: </b>" + element.attr("description") +
          sorting_tooltip;
      }
      // ACCESSORY
      if( element.is("[accessory]") ){
        var accessory_collection_status_tooltip = "";
        if( element.attr("class").indexOf("checked")>0 ){
          accessory_collection_status_tooltip = "[Accessory (<span style='color:#F57921;'>collect</span>)]<br/>";
          if( element.attr("class").indexOf("unchecked")>0 ){
            accessory_collection_status_tooltip = "[Accessory (<span style='color:#F57921;'>uncollect</span>)]<br/>";
          }
        }
        if( element.attr("class").indexOf("owned")>0 ){
          accessory_collection_status_tooltip = "[Accessory (<span style='color:#8080B3;'>owned</span>)]<br/>";
        }
        var sorting_tooltip = "";
        if( element.attr("sortingfield") && element.attr("sortingfield").length > 0 ){
          sorting_tooltip = "<br/><i style='font-size:0.6em;'>" + element.attr("sortingfield") + ": " + element.attr("sortingvalue") + "</i>";
        }
        return accessory_collection_status_tooltip + "<b style='color:#F57921;'>" + element.attr("type") + "</b>" +
          "<br/><b style='color:#F57921;'>Description: </b>" + element.attr("description") +
          sorting_tooltip;
      }
      // NENDOROID
      if( element.is("[nendoroid]") ){
        var nendoroid_collection_status_tooltip = "";
        if( element.attr("class").indexOf("checked")>0 ){
          nendoroid_collection_status_tooltip = "[Nendoroid (<span style='color:#F57921;'>collect</span>)]<br/>";
          if( element.attr("class").indexOf("unchecked")>0 ){
            nendoroid_collection_status_tooltip = "[Nendoroid (<span style='color:#F57921;'>uncollect</span>)]<br/>";
          }
        }
        if( element.attr("class").indexOf("owned")>0 ){
          nendoroid_collection_status_tooltip = "[Nendoroid (<span style='color:#8080B3;'>owned</span>)]<br/>";
        }
        var box_number_tooltip = "";
        if( element.attr("box_number").length > 0 ){
          box_number_tooltip = " #" + element.attr("box_number");
        }
        var sorting_tooltip = "";
        if( element.attr("sortingfield") && element.attr("sortingfield").length > 0 ){
          sorting_tooltip = "<br/><i style='font-size:0.6em;'>" + element.attr("sortingfield") + ": " + element.attr("sortingvalue") + "</i>";
        }
        return nendoroid_collection_status_tooltip + "<b style='color:#F57921;'>" + element.attr("box_category") + "</b>" +
          box_number_tooltip +
          "<br/>" + element.attr("nendoroid_name") +
          "<br/>" + element.attr("nendoroid_version") +
          sorting_tooltip;
      }
      // PHOTO
      if( element.is("[photo]") ){
        var sorting_tooltip = "";
        if( element.attr("sortingfield") && element.attr("sortingfield").length > 0 ){
          sorting_tooltip = "<br/><i style='font-size:0.6em;'>" + element.attr("sortingfield") + ": " + element.attr("sortingvalue") + "</i>";
        }
        return "<b style='color:#F57921;'>" + element.attr("photo_title") + "</b><br/>" +
                "<i>by " + element.attr("photo_username") + "</i>" +
                sorting_tooltip;
      }
    }
  });

// New Box form submit button
  $('#new_box_submit').click(function(){
    $('#new_box_submit').prop('disabled',true);
    $('#new_box_submit').prop('value','Adding...');
    var new_box_number          = $('#new_box_number').val().trim();
    var new_box_name            = $('#new_box_name').val().trim();
    var new_box_series          = $('#new_box_series').val().trim();
    var new_box_manufacturer    = $('#new_box_manufacturer').val().trim();
    var new_box_category        = $('#new_box_category').val().trim();
    var new_box_price           = $('#new_box_price').val().trim();
    var new_box_releasedate     = $('#new_box_releasedate').val().trim();
    var new_box_specifications  = $('#new_box_specifications').val().trim();
    var new_box_sculptor        = $('#new_box_sculptor').val().trim();
    var new_box_cooperation     = $('#new_box_cooperation').val().trim();
    var new_box_officialurl     = $('#new_box_officialurl').val().trim();

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

    if($('#new_nendoroid_box_internalid').val()!=""){
      var new_nendoroid_box_internalid    = $('#new_nendoroid_box_internalid').val().trim();
      var new_nendoroid_name              = $('#new_nendoroid_name').val().trim();
      var new_nendoroid_version           = $('#new_nendoroid_version').val().trim();
      var new_nendoroid_sex               = $('#new_nendoroid_sex').val().trim();
      var new_nendoroid_color             = $('#new_nendoroid_color').val().trim();
      $.post("services/nendoroid/add",
        {
          new_nendoroid_box_internalid:new_nendoroid_box_internalid,
          new_nendoroid_name:new_nendoroid_name,
          new_nendoroid_version:new_nendoroid_version,
          new_nendoroid_sex:new_nendoroid_sex,
          new_nendoroid_color:new_nendoroid_color
        },function(data){
          if(data.result && data.result == "success"){
            window.location.assign("nendoroid/"+data.new_nendoroid_internalid+"/"+data.new_nendoroid_url+"/");
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

    if($('#new_face_box_internalid').val()!="0"){
      var new_face_box_internalid = $('#new_face_box_internalid').val().trim();
      var new_face_nendoroid_internalid = $('#new_face_nendoroid_internalid').val().trim();
      var new_face_eyes = $('#new_face_eyes').val().trim();
      var new_face_eyes_color = $('#new_face_eyes_color').val().trim();
      var new_face_mouth = $('#new_face_mouth').val().trim();
      var new_face_skin_color = $('#new_face_skin_color').val().trim();
      var new_face_sex = $('#new_face_sex').val().trim();
      $.post("services/face/add",
        {
          new_face_box_internalid:new_face_box_internalid,
          new_face_nendoroid_internalid:new_face_nendoroid_internalid,
          new_face_eyes:new_face_eyes,
          new_face_eyes_color:new_face_eyes_color,
          new_face_mouth:new_face_mouth,
          new_face_skin_color:new_face_skin_color,
          new_face_sex:new_face_sex
        },function(data){
          if(data.result && data.result == "success"){
            window.location.assign("face/"+data.new_face_internalid+"/");
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

    if($('#new_hair_box_internalid').val()!="0"){
      var new_hair_box_internalid = $('#new_hair_box_internalid').val().trim();
      var new_hair_nendoroid_internalid = $('#new_hair_nendoroid_internalid').val().trim();
      var new_hair_main_color = $('#new_hair_main_color').val().trim();
      var new_hair_other_color = $('#new_hair_other_color').val().trim();
      var new_hair_haircut = $('#new_hair_haircut').val().trim();
      var new_hair_frontback = $('#new_hair_frontback').val().trim();
      var new_hair_description = $('#new_hair_description').val().trim();
      $.post("services/hair/add",
        {
          new_hair_box_internalid:new_hair_box_internalid,
          new_hair_nendoroid_internalid:new_hair_nendoroid_internalid,
          new_hair_main_color:new_hair_main_color,
          new_hair_other_color:new_hair_other_color,
          new_hair_haircut:new_hair_haircut,
          new_hair_frontback:new_hair_frontback,
          new_hair_description:new_hair_description
        },function(data){
          if(data.result && data.result == "success"){
            window.location.assign("hair/"+data.new_hair_internalid+"/");
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

    if($('#new_hand_box_internalid').val()!="0"){
      var new_hand_box_internalid = $('#new_hand_box_internalid').val().trim();
      var new_hand_nendoroid_internalid = $('#new_hand_nendoroid_internalid').val().trim();
      var new_hand_skin_color = $('#new_hand_skin_color').val().trim();
      var new_hand_posture = $('#new_hand_posture').val().trim();
      var new_hand_leftright = $('#new_hand_leftright').val().trim();
      var new_hand_description = $('#new_hand_description').val().trim();
      $.post("services/hand/add",
        {
          new_hand_box_internalid:new_hand_box_internalid,
          new_hand_nendoroid_internalid:new_hand_nendoroid_internalid,
          new_hand_skin_color:new_hand_skin_color,
          new_hand_posture:new_hand_posture,
          new_hand_leftright:new_hand_leftright,
          new_hand_description:new_hand_description
        },function(data){
          if(data.result && data.result == "success"){
            window.location.assign("hand/"+data.new_hand_internalid+"/");
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

    if($('#new_bodypart_box_internalid').val()!="0"){
      var new_bodypart_box_internalid = $('#new_bodypart_box_internalid').val().trim();
      var new_bodypart_nendoroid_internalid = $('#new_bodypart_nendoroid_internalid').val().trim();
      var new_bodypart_main_color = $('#new_bodypart_main_color').val().trim();
      var new_bodypart_other_color = $('#new_bodypart_other_color').val().trim();
      var new_bodypart_part = $('#new_bodypart_part').val().trim();
      var new_bodypart_description = $('#new_bodypart_description').val().trim();
      $.post("services/bodypart/add",
        {
          new_bodypart_box_internalid:new_bodypart_box_internalid,
          new_bodypart_nendoroid_internalid:new_bodypart_nendoroid_internalid,
          new_bodypart_main_color:new_bodypart_main_color,
          new_bodypart_other_color:new_bodypart_other_color,
          new_bodypart_part:new_bodypart_part,
          new_bodypart_description:new_bodypart_description
        },function(data){
          if(data.result && data.result == "success"){
            window.location.assign("bodypart/"+data.new_bodypart_internalid+"/");
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

    if($('#new_accessory_box_internalid').val()!="0"){
      var new_accessory_box_internalid = $('#new_accessory_box_internalid').val().trim();
      var new_accessory_nendoroid_internalid = $('#new_accessory_nendoroid_internalid').val().trim();
      var new_accessory_type = $('#new_accessory_type').val().trim();
      var new_accessory_main_color = $('#new_accessory_main_color').val().trim();
      var new_accessory_other_color = $('#new_accessory_other_color').val().trim();
      var new_accessory_description = $('#new_accessory_description').val().trim();
      $.post("services/accessory/add",
        {
          new_accessory_box_internalid:new_accessory_box_internalid,
          new_accessory_nendoroid_internalid:new_accessory_nendoroid_internalid,
          new_accessory_type:new_accessory_type,
          new_accessory_main_color:new_accessory_main_color,
          new_accessory_other_color:new_accessory_other_color,
          new_accessory_description:new_accessory_description
        },function(data){
          if(data.result && data.result == "success"){
            window.location.assign("accessory/"+data.new_accessory_internalid+"/");
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
  $('.select_box_internalid').change(function(){
    $('option.nendoroid').show();
    if($(this).val()!="0"){
      $('option.nendoroid[box!='+$(this).val()+']').hide();
      $('option.nendoroid[value=0]').show();
    }
  });
// New part form: react to change of Nendoroid
  $('.select_nendoroid_internalid').change(function(){
    $('option.box').show();
    if($(this).val()!="0"){
      var correspbox = $('option.nendoroid[value='+$(this).val()+']').attr('box');
      $('option.box[value!='+correspbox+']').hide();
      $('option.box[value='+correspbox+']').prop('selected',true);
    }
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
    var input = $('input[field='+$(this).attr('field')+']');
    var value = input.val();
    if( input.attr('type') == 'color' ){
      value = value.substring(1);
    }
    var field = $(this).attr('field');
    var element = $('#info_table').attr('element');
    var internalid = $('#info_table').attr('internalid');

    $.post("services/"+element+"/"+internalid+"/edit",
      {
        field:field,
        value:value
      },function(data){
        if(data.result && data.result == "success"){
          if(input.attr('type') == 'color' ) {
            $('span[field='+data.field+']>.color_field_box').css('background-color','#'+data.value);
            $('span[field='+data.field+']>.color_field_box').attr('title','Color: #'+data.value);
          } else if(data.field != 'officialurl' ){
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
  });
// Show/Hide the History
  $('#toggle_history,#toggle_metadata,#toggle_parts').click(function(){
    $('#'+this.id+'~div').toggle();
    $('#'+this.id+' span').toggle();
  })

// Show/Hide the Edit of rights for Single User
  $('#edit_user_rights').click(function(){
    $('#edit_user_rights span').toggle();
    $('#user_rights_noedit').toggle();
    $('#user_rights_edit').toggle();
  });
// Send change to server when the checkbox is ticked
  $('#user_rights_edit input').change(function(){
    var userid =  $('#info_table').attr('internalid');
    var right = this.id;
    var value = $(this).prop('checked');
    $.post("services/user/"+userid+"/edit",
      {
        field:right,
        value:value
      },function(data){
        if( data.result && data.result == "success"){
          $('#'+data.field+'_view').toggle();
        } else {
          alert("Something was wrong, please reload the page...")
        }
      });
  });

// Validate an element
  $('#validate').click(function(){
    var element = $('#info_table').attr('element');
    var internalid = $('#info_table').attr('internalid');
    $.getJSON("./services/"+element+"/"+internalid+"/validate",function(data){
      if( data.result == "success" ){console.log("validate success");
        $('#validation').toggleClass("validated notvalidated");
      }
    });
  });
// Unvalidate an element
  $('#unvalidate').click(function(){
    var element = $('#info_table').attr('element');
    var internalid = $('#info_table').attr('internalid');
    $.getJSON("./services/"+element+"/"+internalid+"/unvalidate",function(data){
      if( data.result == "success" ){console.log("unvalidate success");
        $('#validation').toggleClass("validated notvalidated");
      }
    });
  });

// Collect an element (i.e. add it to user collection)
  $('#collect').click(function(){
    var element = $('#info_table').attr('element');
    var internalid = $('#info_table').attr('internalid');
    $.getJSON("./services/"+element+"/"+internalid+"/collect",function(data){
      if( data.result == "success" ){console.log("collect success");
        $('#collection').toggleClass("owned notowned");
      }
    });
  });
// Uncollect and element (i.e. remove a unit if more than one element is owned, or remove everything is only one is owned)
  $('#uncollect').click(function(){
    var element = $('#info_table').attr('element');
    var internalid = $('#info_table').attr('internalid');
    $.getJSON("./services/"+element+"/"+internalid+"/uncollect",function(data){
      if( data.result == "success" ){console.log("uncollect success");
        $('#collection').toggleClass("owned notowned");
      }
    });
  });
// Box Collection page, add the event on click on element
$('.collect_section .image').click(function(){
  $(this).toggleClass('checked unchecked');
});
// Box Collection page, add the event on the collect buttons
$('.collect_section a').click(function(){
  var collectable = $('span.checked').length;
  $('#collect_message').html("Collection in progress... [" +
                              "<span id='collectedcount'>0</span>+"+
                              "<span id='failledcount'>0</span>/"+
                              "<span id='collectablecount'>"+collectable+"</span>]");
  $('.collect_section a').addClass('disabled');
  $('.collect_section .image').unbind("click");

  $('span.checked').each(function(){
    var internalid = $(this).attr("internalid");
    var element = $(this).attr("element");
    $(this).addClass('pending');
    $.getJSON("./services/"+element+"/"+internalid+"/collect",function(data){
      var collectedcount = $('#collectedcount').text() * 1;
      var failledcount = $('#failledcount').text() * 1;
      var collectablecount = $('#collectablecount').text() * 1;
      if( data.result == "success" ){
        collectedcount ++;
        $('#collectedcount').text( collectedcount );
        $('[internalid='+data.internalid+'][element='+data.element+']').toggleClass('pending success');
      } else {
        failledcount ++;
        $('#failledcount').text( failledcount );
        $('[internalid='+data.internalid+'][element='+data.element+']').toggleClass('pending faillure');
      }
      if( collectedcount + failledcount == collectablecount ){
        $('#collect_message').html("Collection finished ("+collectedcount+" successed and "+failledcount+" failled)");
        var box_internalid = $('[element=box').attr('internalid');
        window.location.assign("box/"+box_internalid+"/");
      }
    });
  });
});

// If new Box form, just load Box vocabularies
if( $('#new_box_submit').length > 0 ){
  $.getJSON("./services/box/vocabularies",function(data){
    if( data.result == "success" ){
      var items = [];
      // SERIES
      items.series = [];
      $.each( data.vocabularies.series, function(key, val){ items.series.push(val.field); });
      $('#new_box_series').autocomplete({ source: items.series, minLength: 0 });
      // MANUFACTURER
      items.manufacturer = [];
      $.each( data.vocabularies.manufacturer, function(key, val){ items.manufacturer.push(val.field); });
      $('#new_box_manufacturer').autocomplete({ source: items.manufacturer, minLength: 0 });
      // CATEGORY
      items.category = [];
      $.each( data.vocabularies.category, function(key, val){ items.category.push(val.field); });
      $('#new_box_category').autocomplete({ source: items.category, minLength: 0 });
      // SCULPTOR
      items.sculptor = [];
      $.each( data.vocabularies.sculptor, function(key, val){ items.sculptor.push(val.field); });
      $('#new_box_sculptor').autocomplete({ source: items.sculptor, minLength: 0 });
      // COOPERATION
      items.cooperation = [];
      $.each( data.vocabularies.cooperation, function(key, val){ items.cooperation.push(val.field); });
      $('#new_box_cooperation').autocomplete({ source: items.cooperation, minLength: 0 });
    } else {
      alert("An error occurred, please reload the page if you want have autocompletion in the fields...");
    }
  });
}
// If new Face form, just load Face vocabularies
if( $('#new_face_submit').length > 0 ){
  $.getJSON("./services/face/vocabularies",function(data){
    if( data.result == "success" ){
      var items = [];
      // EYES_COLOR
      items.eyes_color = [];
      $.each( data.vocabularies.eyes_color, function(key, val){ items.eyes_color.push(val.field); });
      $('#new_face_eyes_color').autocomplete({ source: items.eyes_color, minLength: 0 });
      // SKIN_COLOR
      items.skin_color = [];
      $.each( data.vocabularies.skin_color, function(key, val){ items.skin_color.push(val.field); });
      $('#new_face_skin_color').autocomplete({ source: items.skin_color, minLength: 0 });
    } else {
      alert("An error occurred, please reload the page if you want have autocompletion in the fields...");
    }
  });
}
// If new Hair form, just load Hair vocabularies
if( $('#new_hair_submit').length > 0 ){
  $.getJSON("./services/hair/vocabularies",function(data){
    if( data.result == "success" ){
      var items = [];
      // MAIN_COLOR
      items.main_color = [];
      $.each( data.vocabularies.main_color, function(key, val){ items.main_color.push(val.field); });
      $('#new_hair_main_color').autocomplete({ source: items.main_color, minLength: 0 });
      // OTHER_COLOR
      items.other_color = [];
      $.each( data.vocabularies.other_color, function(key, val){ items.other_color.push(val.field); });
      $('#new_hair_other_color').autocomplete({ source: items.other_color, minLength: 0 });
      // HAIRCUT
      items.haircut = [];
      $.each( data.vocabularies.haircut, function(key, val){ items.haircut.push(val.field); });
      $('#new_hair_haircut').autocomplete({ source: items.haircut, minLength: 0 });
    } else {
      alert("An error occurred, please reload the page if you want have autocompletion in the fields...");
    }
  });
}
// If new Hand form, just load Hand vocabularies
if( $('#new_hand_submit').length > 0 ){
  $.getJSON("./services/hand/vocabularies",function(data){
    if( data.result == "success" ){
      var items = [];
      // SKIN_COLOR
      items.skin_color = [];
      $.each( data.vocabularies.skin_color, function(key, val){ items.skin_color.push(val.field); });
      $('#new_hand_skin_color').autocomplete({ source: items.skin_color, minLength: 0 });
      // POSTURE
      items.posture = [];
      $.each( data.vocabularies.posture, function(key, val){ items.posture.push(val.field); });
      $('#new_hand_posture').autocomplete({ source: items.posture, minLength: 0 });
    } else {
      alert("An error occurred, please reload the page if you want have autocompletion in the fields...");
    }
  });
}
// If new Bodypart form, just load Bodypart vocabularies
if( $('#new_bodypart_submit').length > 0 ){
  $.getJSON("./services/bodypart/vocabularies",function(data){
    if( data.result == "success" ){
      var items = [];
      // MAIN_COLOR
      items.main_color = [];
      $.each( data.vocabularies.main_color, function(key, val){ items.main_color.push(val.field); });
      $('#new_bodypart_main_color').autocomplete({ source: items.main_color, minLength: 0 });
      // OTHER_COLOR
      items.other_color = [];
      $.each( data.vocabularies.other_color, function(key, val){ items.other_color.push(val.field); });
      $('#new_bodypart_other_color').autocomplete({ source: items.other_color, minLength: 0 });
      // PART
      items.part = [];
      $.each( data.vocabularies.part, function(key, val){ items.part.push(val.field); });
      $('#new_bodypart_part').autocomplete({ source: items.part, minLength: 0 });
    } else {
      alert("An error occurred, please reload the page if you want have autocompletion in the fields...");
    }
  });
}
// If new Accessory form, just load Hair vocabularies
if( $('#new_accessory_submit').length > 0 ){
  $.getJSON("./services/accessory/vocabularies",function(data){
    if( data.result == "success" ){
      var items = [];
      // MAIN_COLOR
      items.main_color = [];
      $.each( data.vocabularies.main_color, function(key, val){ items.main_color.push(val.field); });
      $('#new_accessory_main_color').autocomplete({ source: items.main_color, minLength: 0 });
      // OTHER_COLOR
      items.other_color = [];
      $.each( data.vocabularies.other_color, function(key, val){ items.other_color.push(val.field); });
      $('#new_accessory_other_color').autocomplete({ source: items.other_color, minLength: 0 });
      // TYPE
      items.type = [];
      $.each( data.vocabularies.type, function(key, val){ items.type.push(val.field); });
      $('#new_accessory_type').autocomplete({ source: items.type, minLength: 0 });
    } else {
      alert("An error occurred, please reload the page if you want have autocompletion in the fields...");
    }
  });
}

// If new Photo form, activate FileDrop, and 'accept guidelines' checkbox
if( $('#new_photo_submit').length > 0 ){
  $('#accept-guidelines').change(function(){
    if( this.checked ){
      $('.accept-requested').show();
    } else {
      $('.accept-requested').hide();
    }
  });

  var zone = new FileDrop('upload_zone');
  zone.multiple(true);

  var filesQueue = [];

  zone.event('send', function (files) {
    files.images().each(function (file) {
      filesQueue.push(file);

      var filePosition = filesQueue.length - 1;
      file.filePosition = filePosition;

      if( filePosition > 4 ){ // we have already 5 pictures in queue
        $('#image2add_'+(filePosition-5)+'_cbox').prop('checked',false);
      }

      var currentFileID = "image2add_"+(filePosition);
      var fsize = file.size;
      var tsize = '';
      if( fsize > 1024*1024) {
        tsize = Math.round( 10 * ( fsize / (1024*1024) ) ) / 10 + 'MB';
      } else if( fsize > 1024) {
        tsize = Math.round( ( fsize / 1024 ) ) + 'kB';
      }
      var html2append = '<div class="3u 4u(medium) 12u(small)">'
                      + ' <div class="picture-tile" id="'+currentFileID+'">'
                      + '  <div class="top-of-tile">'
                      + '   <span>'
                      + '    <input type="checkbox" name="'+currentFileID+'_cbox" id="'+currentFileID+'_cbox" checked />'
                      + '    <label for="'+currentFileID+'_cbox" title="Select this photo"></label>'
                      + '   </span>'
                      + '   <span id="'+currentFileID+'_wxh"></span>'
                      + '   <span id="'+currentFileID+'_size">(' + tsize + ')</span>'
                      + '  </div>'
                      + '  <div id="'+currentFileID+'_img"></div>'
                      + '  <div class="bottom-of-tile">'
                      + '   <span>'
                      + '    <input type="text" id="'+currentFileID+'_title" name="'+currentFileID+'_title" value="'+file.name+'" title="Enter here the title of the photo"/>'
                      + '   </span>'
                      + '  </div>'
                      + ' </div>'
                      + '</div>';
      $('#picture-thumbnails').append(html2append);

      file.readData(
        function (uri) {
          var img = new Image
          img.onload = function(evt){
            $('#'+currentFileID+'_wxh').append(this.width+'x'+this.height);
            var divwidth = $('#'+currentFileID).css('width').replace(/[^-\d\.]/g, '');
            var divheight = $('#'+currentFileID+' div').css('height').replace(/[^-\d\.]/g, '');
            if(this.width>this.height){
              $(this).css('width','100%');
              var margin = ( divwidth - ( this.height * divwidth / this.width ) ) / 2;
              $(this).css('margin-top',margin+'px');
            } else {
              $(this).css('height',divwidth+'px');
              var margin = ( divwidth - ( this.width * divwidth / this.height ) ) / 2;
              $(this).css('margin-left',margin+'px');
            }
            $('#'+currentFileID+'_img').css('height',divwidth+'px');
          }
          img.src = uri
          $('#'+currentFileID+'_img').append(img);
        },
        function (error) {
          console.log('Ph, noes! Cannot read your image.')
        },
        'uri'
      )
    })
  })

  $('#new_photo_submit').click(function(){
    if( ! $('#new_photo_submit').prop('disabled') ){
      $('#new_photo_submit').prop('disabled',true);
      if($('input:checked').length>5){
        alert("Error, you have too much photos selected...");
      } else {
        filesQueue.forEach(function(element, index){
          if($('input[name=image2add_'+index+'_cbox]').is(':checked')){
            var title = $('#image2add_'+index+'_title').val();
            element.event('done',function(xhr){
              var response = JSON.parse(xhr.responseText);
              if( response.result === "success" ){
                $('#image2add_'+this.filePosition).css('background-color','#DDFFDD');
              } else {
                $('#image2add_'+this.filePosition).css('background-color','#FFDDDD');
              }
            })
            element.sendTo(encodeURI('photoupload?title='+title));
          }
        });
      }
    }
  });
}

// If image-and-annotations, then do the job of the photo page
if( $('.image-and-annotations').length > 0 ){
  var original_width = $('.annotated-image').attr('original_width');
  var original_height = $('.annotated-image').attr('original_height');
  console.log('Original image size: ' + original_width + 'x' + original_height);
  $('.annotated-image').width($('.image-and-annotations').width());
  var displayed_width = $('.annotated-image').width();
  var displayed_height = $('.annotated-image').height();
  console.log('Displayed image size: ' + displayed_width + 'x' + displayed_height);
  var ratio = displayed_width / original_width;
  console.log('Ratio: ' + ratio);
  $('.image-annotation').each(function(){
    $(this).css('left',($(this).attr('xmin')*ratio)+'px');
    $(this).css('top',($(this).attr('ymin')*ratio)+'px');
    $(this).css('width',(($(this).attr('xmax')-$(this).attr('xmin'))*ratio)+'px');
    $(this).css('height',(($(this).attr('ymax')-$(this).attr('ymin'))*ratio)+'px');
  });
}

// If there is a SELECT with #part ID, then we are in the add part to photo
if( $('#box_chooser').length > 0 ){
  /*$('#category').change(function(){
    $('#part>optgroup').hide();
    $('optgroup[label=\''+$('#category').val()+'\']').show();
    $('optgroup[label=\''+$('#category').val()+'\']>option').first().prop('selected',true);
  });*/
  $('#box_chooser').autocomplete({
    source: "services/search/box",
    minLength: 2,
    select: function( event, ui){
      $('#box_chooser').val(ui.item.box_name);
      //console.log("Selected: " + ui.item.box_internalid + " aka " + ui.item.box_name );
      return false;
    }
  }).autocomplete("instance")._renderItem = function( ul, item) {
    var instance_content = "";
    instance_content += "<img src='images/nendos/boxes/" + item.box_internalid + ".jpg' style='width:50px; height:50px; margin-right:10px;' />";
    instance_content += "<b>" + item.box_category + "</b>";
    if( item.box_number ) {
      instance_content += " #" + item.box_number;
    }
    instance_content += " - " + item.box_name;
    return $("<li>")
      .append("<div>" + instance_content + "</div>")
      .appendTo(ul);
  };
}

});
