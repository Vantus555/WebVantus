class ajax{
  static CreateAjax(filename, formdata){
      $.ajax({
        type: 'POST',
        url: filename,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "text",
        data: formdata,
        success: function(data) {
          eval(data);
        }
      });
  }
}
