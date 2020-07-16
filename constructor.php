<?php
  require_once 'Files/Engine/php/classes/FileStream.php';
  $arr = FileStream::GetHtml($_GET["file"]);
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="Files/Constructor/css/main.css">
  <?=$arr['head']; ?>
</head>
<body id="" class='drop YesSelect Selected'>
  <?=$arr['body']; ?>
</body>

<?=$arr['html']; ?>

<?php require_once 'Files/Constructor/Blocks/Elements.php'; ?>

</html>

<script src="Frameworks/jQuery/jquery-3.5.1.min.js"></script>
<script src="Frameworks/jQuery/jquery-ui.min.js"></script>

<script type="text/javascript">
  //document.designMode = "on";

  $('.drag').draggable({
   helper: "clone"
  });

  $('.showElems').click(function(){
    if($('.Elements').is(':visible')){
      $(this).css({
        left : 0
      });
      $('.Elements').hide();
    }else{
      $(this).css({
        left : $('.Elements').width()
      });
      $('.Elements').show();
    }
  });

  $(".drop").droppable({
   greedy: true,
   drop: function(ev, ui) {
     $(this).append($(ui.draggable.attr('data-elem')).droppable({
       greedy: true,
       drop: function(e, ui) {
         $(this).append($(ui.draggable.attr('data-elem')).droppable());
       }
     }));
     return false;
   }
  });

  function SelectedInConstructer(tag) {
    let elems = $(tag).children();
    for (var i = 0; i < elems.length; i++) {
      if(!$(elems[i]).hasClass('NoSelect') && elems[i].tagName != 'SCRIPT'){
        $(elems[i]).addClass('YesSelect');
        let children = $(elems[i]).children();
        if(children.length != 0)
          SelectedInConstructer(elems[i]);
      }
    }
  }
  $('.YesSelect').click(function(e){
    if(this.tagName == e.target.tagName){
      if(e.ctrlKey == false)
        $('.Selected').removeClass('Selected');
      $(this).addClass('Selected');
    }
  });

  $('body').on('click','.YesSelect',function(e){
    if(this.tagName == e.target.tagName){
      if(e.ctrlKey == false)
        $('.Selected').removeClass('Selected');
      $('.ui-sortable').sortable('disable');
      $(this).addClass('Selected');
      $(this).parent().sortable({
          cancel: '.NoSelect'
      });
      $(this).parent().sortable('enable');
    }
  });

  $(document).ready(function(){
    SelectedInConstructer('body');
  });

  $(window).resize(function(){
    if($('.Elements').is(':visible')){
      $('.showElems').css({
        left : $('.Elements').width()
      });
    }else{
      $('.showElems').css({
        left : 0
      });
    }
  });

  $('.tabs').tabs();

  $('#salutation').change(function(){
    $('.styleinput').attr('disabled', false);
    $('.stylebtn').attr('disabled', false);

    let style = $('#salutation').val();
    let valstyle = $('.Selected').css(style);
    $('.styleinput').val(valstyle);
  });

  $('.stylebtn').click(function() {
    let style = $('#salutation').val();
    let valstyle = $('.styleinput').val();
    $('.Selected').css(style, valstyle);
  });

</script>
