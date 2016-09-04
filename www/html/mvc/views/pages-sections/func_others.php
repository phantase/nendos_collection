<?php

function cellField($field,$label,$value){
  include('mvc/views/pages-sections/others/cell_field.php');
}
function tableField($field,$label,$value,$colspan=1){
  include('mvc/views/pages-sections/others/table_field.php');
}
function tableFieldWithLink($field,$label,$value,$link,$colspan=1){
  include('mvc/views/pages-sections/others/table_field_with_link.php');
}
