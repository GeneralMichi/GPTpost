var inputs = document.getElementsByClassName('formulario_input');

for (var i = 0; i < inputs.length; i++) {
  inputs [i].addEventListener('keyup',function(){
    if (this.value.length >= 1) 
    {
      this.nextElementSibling.classList.add('fijar');
    }else{
      this.nextElementSibling.classList.remove('fijar');
    }

  });
}

function concatenar(prompt){
  
}
/* 
$(document).ready(function (){
  var firstName="";
  var lastName ="";
  $('#firstname').keyup(function (){
      firstName = $('#firstname').val();
      $('#name').val(firstName+lastName);
  });

  $('#lastname').keyup(function (){
      lastName = $('#lastname').val();
      $('#name').val(firstName+' '+lastName);
  });
});
*/
