<script src="Frameworks/jQuery/jquery-3.5.1.min.js"></script>
<script src="Frameworks/jQuery/jquery-ui.min.js"></script>
<script src="Files/Engine/js/ajax.js"></script>

<script type="text/javascript">
/////////////////////////////////Folder///////////////////////////////////////
  $('.opendir').click(function(e){
    e.preventDefault();
    let folder = $($(this).children()[0]).children()[0];
    let openul = $(this).attr('data-ul');
    let elem = openul.substring(0, 2);
    if($("ul[data-ul='"+elem+"-"+openul+"']").is(':visible')){
      $(folder).attr('src', 'Files/Engine/img/FolderClose.svg');
      $("ul[data-ul='"+elem+"-"+openul+"']").hide();
    }
    else{
      $(folder).attr('src', 'Files/Engine/img/FolderOpen.svg');
      $("ul[data-ul='"+elem+"-"+openul+"']").show();
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
    let addElem = document.location.search;

    if(addElem.indexOf("type=constructor") == -1){
      if(activedir.length > 0){
        for (var i = 0; i < activedir.length; i++) {
          $($(activedir[i]).parent().children()[1]).show();
          let folder = $($($(activedir[i]).children()[0]).children()[0]).children()[0];
          $(folder).attr('src', 'Files/Engine/img/FolderOpen.svg');
        }
      }
    }
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
////////////////Editor///////////////////////////////////////////////

  function activeLine(){
    let cursor = $('#cursor');
    let parent = cursor.parent();
    if(!parent.hasClass('active-line')){
      $('.active-line').removeClass('active-line');
      parent.addClass('active-line');
    }
  }

  $(document).keydown(function(eventObject){
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
  });

  $("#EditText").focus(function() {
    let cursor = $(this).find('#cursor');
    cursor.css({
      'display' : "inline-flex"
    });
    activeLine();
  });

  $("#EditText").blur(function() {
    $(this).find('#cursor').css({
      'display' : "none"
    });
    let lines = $('.line');
    let data = '';
    for (var i = 0; i < lines.length; i++) {
      data += $(lines[i]).text();
      if(i != lines.length-1)
        data+='\n';
    }

    var formdata = new FormData();
    formdata.append('data',data);
    let file = "../../../../";
    file+= "<?= $_GET["$open"] ?>";
    formdata.append('file', file);
    ajax.CreateAjax('Files/Engine/php/ajax/SafeFile.php', formdata);
  });

  $("#EditText").keydown(function(e) {
    //console.log(e);
    e.preventDefault();
    if(e.key == 'c' && e.ctrlKey){
      //alert(1);
    }
    else if(e.key == 'Tab') {
      $(this).find('#cursor').before("<span class='symbol'>"+'\t'+"</span>");
      /*var start = $(this)[0].selectionStart;
      var end = $(this)[0].selectionEnd;

      var $this = $(this);
      var value = $this.val();
      $this.val(value.substring(0, start) + "\t" + value.substring(end));
      $(this)[0].selectionEnd = start + 1;*/
    }
    else if(e.key == 'Enter'){
      let cursor = $(this).find('#cursor');
      let newline = $("<div class='line'></div>");
      let parent = cursor.parent();

      let tabchild = cursor.parent().children();
      for (var i = 0; i < tabchild.length; i++) {
        if($(tabchild[i]).text() == '\t')
          newline.append("<span class='symbol'>\t</span>");
        else break;
      }

      if(!cursor.next()[0]){
        newline.append($('#cursor'));
        parent.after(newline);
      }
      else {
        let next = cursor.next();
        newline.append($('#cursor'));
        while (next[0]) {
          let n = next[0];
          next = $(next[0]).next();
          newline.append(n);
        }
        parent.after(newline);
      }

      let newnum = $('.numline:last').text();
      let elem = "<div class='numline'>" + (parseInt(newnum) + 1) + "</div>";
      $(".numerationLine").append(elem);
      activeLine();
    }
    else if(e.key == 'Backspace'){
      let range = window.getSelection().getRangeAt(0);// попробовать removeRange()
      if(range != ''){
        range.deleteContents();
      }
      else{
        let cursor = $(this).find('#cursor');
        let prev = cursor.prev();
        if(prev.text() != '<'){
          if(prev[0]){
            prev.remove();
          }
          else {
            let parent = cursor.parent();
            let linehtml = parent.html();
            let prevline = parent.prev();

            if(prevline[0]){
              $(".numline:last").remove();
              parent.remove();
              prevline.append(linehtml);
            }
          }
        }
        else{
          next2 = prev.next();
          prev.remove();
          while(next2[0] && next2.text() != '<'){
            next2.removeClass('href');
            next2 = next2.next();
          }
        }
      }
      activeLine();
    }
    else if(e.key == 'Delete'){
      let cursor = $(this).find('#cursor');
      let next = cursor.next();
      if(next.text() != '<'){
        if(next[0]){
          next.remove();
        }
        else {
          let parent = cursor.parent();
          let nextline = parent.next();
          let linehtml = nextline.html();

          if(nextline[0]){
            $(".numline:last").remove();
            nextline.remove();
            parent.append(linehtml);
          }
        }
      }
      else{
        next2 = next.next();
        next.remove();
        while(next2[0] && next2.text() != '<'){
          next2.removeClass('href');
          next2 = next2.next();
        }
      }

      activeLine();
    }
    else if(e.key == 'ArrowLeft'){
      let prev = $(this).find('#cursor').prev();
      if(prev[0]){
        if(prev[0].tagName == 'SPAN')
          prev.before($('#cursor'));
      }
      else{
        let lastline = $(this).find('#cursor').parent().prev();
        if(lastline[0])
          lastline.append($('#cursor'));
      }
      activeLine();
    }
    else if(e.key == 'ArrowRight'){
      let next = $(this).find('#cursor').next();
      if(next[0]){
        if(next[0].tagName == 'SPAN')
          next.after($('#cursor'));
      }
      else{
        let nextline = $(this).find('#cursor').parent().next();
        //alert(nextline[0].tagName);
        if(nextline[0])
          nextline.prepend($('#cursor'));
      }
      activeLine();
    }
    else if(e.key == 'ArrowUp'){
      let spancount = $(this).find('#cursor').prevAll();
      let Up = $(this).find('#cursor').parent().prev();
      if(Up[0]){
        let spanUp = $(Up).find('.symbol');
        if(spancount.length < spanUp.length)
          $(spanUp[spancount.length]).before($('#cursor'));
        else
          Up.append($('#cursor'));
      }
      activeLine();
    }
    else if(e.key == 'ArrowDown'){
      let spancount = $(this).find('#cursor').prevAll();
      let Up = $(this).find('#cursor').parent().next();
      if(Up[0]){
        let spanUp = $(Up).find('.symbol');
        if(spancount.length < spanUp.length)
          $(spanUp[spancount.length]).before($('#cursor'));
        else
          Up.append($('#cursor'));
      }
      activeLine();
    }
    else if(e.key != 'F1' && e.key != 'Shift'
  && e.key != 'Control'
  && e.key != 'Alt'){
      if(e.key == '>'){
        $(this).find('#cursor').before("<span class='symbol closetag'>"+e.key+"</span>");
      }
      else if(e.key == '<'){
        let cursor = $(this).find('#cursor');
        cursor.before("<span class='symbol opentag'>"+e.key+"</span>");
        let next = cursor.next();
        while(next.text() != '<' && next.text() != '>' && next[0]){
          next.addClass('href');
          next = next.next();
        }
      }
      else{
        let cursor = $(this).find('#cursor');
        if((cursor.prev().hasClass('tag')
        || cursor.prev().hasClass('opentag'))
        && cursor.prev().text()!=' ')
          cursor.before("<span class='symbol tag'>"+e.key+"</span>");
        else if(cursor.prev().hasClass('tag') || cursor.prev().hasClass('inside-tag'))
          cursor.before("<span class='symbol inside-tag'>"+e.key+"</span>");
        else cursor.before("<span class='symbol'>"+e.key+"</span>");
      }
      let code = $(this).html();
      ctrl = false;
    }
  });

    $('body').on('click','.symbol',function(){
      $(this).before($('#cursor'));
      activeLine();
    });
  $('body').on('click','.line',function(e){
    if(e.target.tagName == 'DIV'){
      $(this).append($('#cursor'));
      activeLine();
    }
  });
   /////////////////////////Constructor/////////////////////////////////////

   /*let link = '<link id="mainCss" rel="stylesheet" href="Files/Engine/css/main.css">';
   $('.drag').draggable({
    helper: "clone"
   });
   $("#Constructor").droppable({
    drop: function(event, ui) {
      //alert(ui.draggable.text());
      let contents = $(this).contents();
      if(contents.find('#mainCss').length == 0){
        contents.find('head').append(link);
      }
      if(!ui.draggable.attr("data-head"))
        contents.find('body').append(ui.draggable.attr("data-elem"));
      else{
        contents.find('head').empty();
        contents.find('head').append(ui.draggable.attr("data-head"));
      }
    }
   });
  $(document).onload(function(){
    let iframe_constructor = document.getElementById("Constructor");
    iframe_constructor.contentDocument.designMode = "on";
    let addElem = document.location.search;
    if(addElem.indexOf("type=constructor") != -1){
      $('ul[data-ul="ul-ul1"]').hide();
    }
  });*/
</script>
