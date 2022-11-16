$.ajax({
    url: "/calc",
    type: "post",
    contentType: "application/json",
    cache: false,
    data: aa,
    dataType: "text"
  }).done(function (data){
  }).fail(function (jqXHR, textStatus, errorThrown) {
      console.log("ajax通信に失敗しました");
      console.log(jqXHR.status);
      console.log(textStatus);
      console.log(errorThrown);
    });