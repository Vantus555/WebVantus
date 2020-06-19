<script src="Frameworks/jQuery/jquery-3.5.1.min.js"></script>
<script src="Files/Engine/js/ajax.js"></script>

<script type="text/javascript">
  $('.opendir').click(function(e){
    e.preventDefault();
    let folder = $($(this).children()[0]).children()[0];
    let openul = $(this).attr('data-ul');
    if($("ul[data-ul='ul-"+openul+"']").is(':visible')){
      $(folder).attr('src', 'Files/Engine/img/FolderClose.svg');
      $("ul[data-ul='ul-"+openul+"']").hide();
    }
    else{
      $(folder).attr('src', 'Files/Engine/img/FolderOpen.svg');
      $("ul[data-ul='ul-"+openul+"']").show();
    }
  });

  $(document).ready(function(){
    let activeElem = $('.active');
    if(activeElem.length != 0 && !$($('.active').parent().parent()).hasClass('maindir')){
      let maindir = $('.active').parent().parent();
      let dir = maindir.children()[0];
      $(dir).addClass('activedir');

      $($('.active').parent()).show();

      let first = $('.activedir').parent().parent().parent();
      //alert($(first.children()[0]).addClass('activedir'));
      while(!$(first).hasClass('maindir')){
        first = first.children()[0];
        $(first).addClass('activedir');
        first = $(first).parent().parent().parent();
      }
      $(first.children()[0]).addClass('activedir');
    }
    else if(activeElem.length !=0 && $($('.active').parent().parent()).hasClass('maindir')){
      let maindir = $('.active').parent().parent().children()[0];
      $(maindir).addClass('activedir');
    }

    let activedir = $('.activedir');
    if(activedir.length > 0){
      for (var i = 0; i < activedir.length; i++) {
        $($(activedir[i]).parent().children()[1]).show();
        let folder = $($($(activedir[i]).children()[0]).children()[0]).children()[0];
        $(folder).attr('src', 'Files/Engine/img/FolderOpen.svg');
      }
    }
  });

  $(document).keydown(function(eventObject){
    if(eventObject.key == 'Tab' && !$('#EditText').is(':focus')){
      eventObject.preventDefault();
      if(!$('#EditText').is(':focus'))
        $('#EditText').focus();
    }
    else{
      if(eventObject.key == 'Tab'){
        eventObject.preventDefault();
      }
      if(eventObject.key == 'F1'){
        eventObject.preventDefault();
        let href = document.location.href;
        let newhref;
        if(href.indexOf('type=page') != -1)
          newhref = href.replace(/type=page/gi, 'type=text');
        else if(href.indexOf('type=text') != -1)
          newhref = href.replace(/type=text/gi, 'type=page');
        document.location.href = newhref;
      }
    }
  });

  $("#EditText").keydown(function(e) {
    if(e.key === 'Tab') {
      var start = $(this)[0].selectionStart;
      var end = $(this)[0].selectionEnd;

      var $this = $(this);
      var value = $this.val();
      $this.val(value.substring(0, start) + "\t" + value.substring(end));
      $(this)[0].selectionEnd = start + 1;

      e.preventDefault();
    }
  });

  $("#EditText").blur(function() {
    var formdata = new FormData();
    formdata.append('data',$(this).val());
    let file = "../../../../";
    file+= "<?= $_GET["$open"] ?>";
    formdata.append('file', file);
    ajax.CreateAjax('Files/Engine/php/ajax/SafeFile.php', formdata);
  });

  $('.Files').click(function(e){
    e.preventDefault();

    var formdata = new FormData();
    formdata.append('href',$($($(this).parent().children()[0]).children()[0]).attr('href'));
    formdata.append('name',$($($(this).parent().children()[0]).children()[0]).text());

    ajax.CreateAjax('Files/Engine/php/ajax/OpenFile.php', formdata);
  });

  $('.closefile').click(function(e){
    var formdata = new FormData();
    formdata.append('href',$($(this).parent().children()[0]).attr('href'));
    formdata.append('name',$($(this).parent().children()[0]).text());

    ajax.CreateAjax('Files/Engine/php/ajax/CloseOpenFile.php', formdata);
  });

  $('.hrefmyfile').scroll(function(eventObject){
    $(this).scrollLeft(0);
  });

  $('.AddNewFile').click(function(){
    $('.popupwindow').css({'display' : 'flex'});
    $('.radiobtn').show();
    $('.renamebtn').hide();
    //alert($($($(this).parent().children()[0]).children()[0]).attr('href'));
    $('#input-href').val($($($(this).parent().children()[0]).children()[0]).attr('href'));
  });

  $('.popupwindow').click(function(e){
    if ($(e.target).hasClass('popupwindow')) {
      $(this).hide();
    }
  });

  $('.gocreatefile').click(function(){
    var formdata = new FormData();

    let name = $('#input-href').val() + '/' + $('#Name').val()

    formdata.append('name', name);
    if($('#createfile').is(':checked'))
      formdata.append('type', 'File');
    if($('#createfolder').is(':checked'))
      formdata.append('type', 'Folder');

    formdata.append('Folder', '');
    ajax.CreateAjax('Files/Engine/php/ajax/Create.php', formdata);
  });

  $('.open').mouseup(function(event){
    if(event.which == 3){
      $('.FileSettigs').attr('data-filedelete', $(this).attr('data-delete-rename-href'));
      //$(this).append('<div tabindex="2" class="FileSettigs"><a class="delete" href="">Удалить</a><a href="">Переименовать</a></div>')
      $('.FileSettigs').css({
        'display' : 'block',
        'left' : event.pageX,
        'top' : event.pageY
      });
      $('.FileSettigs').focus();
      document.oncontextmenu = function(){return false;};
    }
  });

  $('.delete').click(function(e){
    e.preventDefault();
    //alert($('.FileSettigs').attr('data-filedelete'));
    var formdata = new FormData();
    formdata.append('name',$('.FileSettigs').attr('data-filedelete'));
    ajax.CreateAjax('Files/Engine/php/ajax/Delete.php', formdata);
  });

  $('.renamefile').click(function(e){
    e.preventDefault();
    $('.FileSettigs').hide();

    let name = $('.FileSettigs').attr('data-filedelete');
    alert(name);
    let lastindex = name.lastIndexOf('/');
    document.oncontextmenu = function(){return true;};
    $('.popupwindow').css({'display' : 'flex'});
    $('.radiobtn').hide();
    $('.renamebtn').show();

    $('#Name').val(name.substring(lastindex+1));
  });

  $('.renamebtn').click(function(){
    var formdata = new FormData();
    let name = $('.FileSettigs').attr('data-filedelete');
    let lastindex = name.lastIndexOf('/');
    formdata.append('newname',name.substring(0, lastindex+1) + $('#Name').val());
    formdata.append('oldname',$('.FileSettigs').attr('data-filedelete'));
    ajax.CreateAjax('Files/Engine/php/ajax/Rename.php', formdata);
  });

  $('.FileSettigs').blur(function(event){
    if(!$('.delete').is(':hover') && !$('.renamefile').is(':hover')){
      $('.FileSettigs').css({
        'display' : 'none',
        'left' : 0,
        'top' : 0
      });
      $('.FileSettigs').focus();
      document.oncontextmenu = function(){return true;};
    }
  });
</script>
