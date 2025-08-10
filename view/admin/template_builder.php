<?php
session_start();
// hide all error
error_reporting(0);
// protect .php
$get_self = explode("/",$_SERVER['PHP_SELF']);
$self[] = $get_self[count($get_self)-1];

if($self[0] !== "index.php"  && $self[0] !==""){
    include_once("./../../core/route.php");
}else{
    include_once('core/routeros_api.class.php');
    include_once("core/no_cache.php");
?>
<link rel="stylesheet" href="./assets/css/editor.min.css">
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/dragdrop.js"></script>
<?php
if(!isMobile()){
   $builder_ma = "sidenav_active";
   include_once("view/header_html.php");
   include_once("view/menu.php");
?>
<div class="main">
  <div class="row">
    <div class="col-12">
      <div class="card card-shadow">
        <div class="card-header unselect">
          <span><i class="fa fa-th-large"></i> <b>Template Builder</b></span>&nbsp;&nbsp;|&nbsp;&nbsp;
          <span class="pointer" id="btn-save"><i class="fa fa-save"></i> Save</span>
          <span id="tb_loading"></span>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <h5>Layout</h5>
              <ul id="layout" class="draggable list-group">
                <li class="list-group-item drag-item">Header</li>
                <li class="list-group-item drag-item">Row</li>
                <li class="list-group-item drag-item">Footer</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
    enableDragSort('draggable');
    $('#btn-save').click(function(){
        var layout = $('#layout').html();
        $.post('./post/post_template.php', {
            router_: '1',
            do: 'saveLayout',
            layout_: layout,
            file_: 'layout.txt'
        }, function(res){
            if(res && res.message){
                alert(res.message);
            }
        }, 'json');
    });
});
</script>
<?php }
}
?>
