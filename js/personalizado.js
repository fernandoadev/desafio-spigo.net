var Botoes = document.querySelectorAll('.btn-editar'); //Pegando todos os elementos com a classe btn-editar

Botoes.forEach(function (Botao){ //Passando cada um dentro do foreach
  var id = Botao.dataset.linhaId; //Obtendo o ID do DATA
  //console.log(Botao.dataset.linhaId);
  var dialog  = document.getElementById('modal'+id);
  //console.log(dialog);

  if (! dialog.showModal) {
    dialogPolyfill.registerDialog(dialog);
  }
  Botao.addEventListener('click', function() {
    dialog.showModal();
  });
  dialog.querySelector('.close').addEventListener('click', function() {
    dialog.close();
  });


});