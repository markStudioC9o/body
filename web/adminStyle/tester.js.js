$(document).ready(function () {
  $.$.ajax({
    type: "Get",
    url: "https://blomag.na4u.ru/api/v1/news/",
    
    success: function (response) {
     console.log(response) 
    }
  });
});