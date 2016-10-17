<?php

function tableField($field,$label,$value,$editable=true){
  include('mvc/views/pages-sections/others/table_field.php');
}
function tableFieldWithColor($field,$label,$value,$editable=true){
  include('mvc/views/pages-sections/others/table_field_with_color.php');
}
function tableFieldWithLink($field,$label,$value,$link,$editable=true){
  include('mvc/views/pages-sections/others/table_field_with_link.php');
}
function tableFieldValidate($validated,$editable=true){
  include('mvc/views/pages-sections/others/table_field_validate.php');
}
function tableFieldOwned($additiondate,$additionsince){
  include('mvc/views/pages-sections/others/table_field_owned.php');
}
