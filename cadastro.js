const form_cadastro = document.getElementById("form_cadastro");
const avisos = document.getElementById("avisos");

/* Quando enviar o formulário */
form_cadastro.addEventListener("submit", (e) => { 
  let dados_form = new FormData(form_cadastro);
  e.preventDefault();
  fetch("processa.php", {
    body: dados_form,
    method: "POST",
  })
    .then((resposta) => {
      if (resposta.ok) {
        return resposta.text();
      }
    })
    .then((mensagem) => {
      avisos.innerHTML = mensagem;
      avisos.open = true;
      setTimeout(()=>{
        avisos.open = false;
      }, 3000);
    });
});