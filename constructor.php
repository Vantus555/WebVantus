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

<?=$arr['html'];?>

<?php require_once 'Files/Constructor/Blocks/Elements.php'; ?>

</html>

<script src="Frameworks/jQuery/jquery-3.5.1.min.js"></script>
<script src="Frameworks/jQuery/jquery-ui.min.js"></script>
<script src="Files/Engine/js/StyleClass.js"></script>

<script type="text/javascript">
  let notUsing = ['Selected',
  'drop',
  'ui-droppable',
  'YesSelect',
  ' ',
  'ui-sortable-handle',
  'ui-dropable-hover'];
  //document.designMode = "on";
  let MainStyleCss = 0;
  let linkStyles = <?=json_encode($arr['links']);?>;
  console.log(linkStyles);
  if(linkStyles.length == 1){
    MainStyleCss = new Styles();
  }
  else {
    alert("Выбирете файл для сохранения или добавьте новый");
  }

  $('.drag').draggable({
   helper: "clone"
  });

  $('.showElems').click(function(){
    if($('.Elements').is(':visible')){
      $(this).css({
        left : 0
      });
      $('.SafeFile').css({
        left : 0
      });
      $('.Elements').hide();
    }else{
      $(this).css({
        left : $('.Elements').width()
      });
      $('.SafeFile').css({
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

  function ClassesAndId(elem){
    $('.optionselect').removeAttr('selected');
    $('.optionselect').attr('selected', 'selected');
    $('.disabledselect').attr('disabled', true);

    let option = $('#id_num').children();
    for (var i = 1; i < option.length; i++) {
      $(option[i]).remove();
    }

    let classes = $(elem).attr('class');
    $('#id_num').append("<option disabled><b>Классы</b></option>");
    if(classes){
      classes = classes.split(' ');
      for (var i = 0; i < classes.length; i++) {
        if(notUsing.indexOf(classes[i]) == -1)
          $('#id_num').append("<option>."+classes[i]+"</option>");
      }
    }

    let idelem = $(elem).attr('id');
    $('#id_num').append("<option disabled><b>ИД</b></option>");
    if(idelem){
      idelem = idelem.split(' ');
      for (var i = 0; i < idelem.length; i++) {
        if(notUsing.indexOf(idelem[i]) == -1)
          $('#id_num').append("<option>#"+idelem[i]+"</option>");
      }
    }
  }

  $('.YesSelect').click(function(e){
    if(this.tagName == e.target.tagName){
      $('.clearinput').val('');
      $('.Selected').attr('contenteditable', false);
      if(e.ctrlKey == false || $('body').hasClass('Selected'))
        $('.Selected').removeClass('Selected');
      $(this).addClass('Selected');
      ClassesAndId(this);
    }
  });

  $('body').on('dblclick','.YesSelect',function(e){
    if(this === e.target){
      $('.Selected').focus();
    }
  });

  $('body').on('click','.YesSelect',function(e){
    if(this === e.target){
      $('.clearinput').val('');
      $('.Selected').attr('contenteditable', false);
      if(e.ctrlKey == false || $('body').hasClass('Selected'))
        $('.Selected').removeClass('Selected');
      $('.ui-sortable').sortable('disable');
      $(this).addClass('Selected');
      $('.Selected').attr('contenteditable', true);
      $(this).parent().sortable({
          cancel: '.NoSelect'
      });
      $(this).parent().sortable('enable');
      ClassesAndId('.Selected');
    }
  });

  $(document).ready(function(){
    SelectedInConstructer('body');
    ClassesAndId('body');
  });

  $(window).resize(function(){
    if($('.Elements').is(':visible')){
      $('.showElems').css({
        left : $('.Elements').width()
      });
      $('.SafeFile').css({
        left : $('.Elements').width()
      });
    }else{
      $('.showElems').css({
        left : 0
      });
      $('.SafeFile').css({
        left : 0
      });
    }
  });

  $('.tabs').tabs();

  $('#salutation').change(function(){
    $('.styleinput').attr('disabled', false);
    $('.stylebtn').attr('disabled', false);

    let style = $('#salutation').val();
    let valstyle = MainStyleCss.GetStyleName($("id_num").val(), style);
    if(valstyle)
      $('.styleinput').val(valstyle);
    else{
      valstyle = window.getComputedStyle($(".Selected")[0],null);
      $('.styleinput').val(valstyle[style]);
    }
  });

  $('.stylebtn').click(function() {
    let style = $('#salutation').val();
    let valstyle = $('.styleinput').val();
    $('.Selected').css(style, valstyle);
    MainStyleCss.AddStyle($("id_num").val(), $('#salutation').val(), $(".styleinput").val());
    console.log(MainStyleCss.GetAllStylesName($("id_num").val()));
  });

  $('.classoridbtn').click(function(){
    let classorid = $('.classoridinput').val();

    if(classorid != ''){
      if(classorid[0] == "#" && classorid.length > 1){
          classorid = classorid.substr(1);
          if(document.getElementById(classorid))
            alert("Элемент с таким id уже сужествует!");
          else{
            $('.Selected').attr('id', classorid);
            ClassesAndId('.Selected');
          }
      }
      if(classorid[0] == "." && classorid.length > 2){
        classorid = classorid.substr(1);
        $('.Selected').addClass(classorid);
        ClassesAndId('.Selected');
      }
    }
  });

  $('#id_num').change(function(){
    $('.changestyle').attr('disabled', false);
  });

  $('.deletebtn').click(function(e) {
    if(this === e.target){
      let notbody = $('.Selected');
      for (var i = 0; i < notbody.length; i++) {
        if(notbody[i].tagName != 'BODY')
          $(notbody[i]).remove();
      }
    }
  })

</script>
