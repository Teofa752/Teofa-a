// Animação de digitação para o texto "Bem-vindo à Casa Ferragem"
document.addEventListener("DOMContentLoaded", function () {
  const texto = "Bem-vindo à Casa Ferragem";
  const elemento = document.getElementById("bemvindo-texto");
  elemento.textContent = "";

  let i = 0;
  function digitar() {
    if (i < texto.length) {
      elemento.textContent += texto.charAt(i);
      i++;
      setTimeout(digitar, 150);
    }
  }
  digitar();
});

// Função para confirmação antes de abrir links de contato
function confirmar(tipo) {
  return confirm(`Deseja abrir o ${tipo.toUpperCase()}?`);
}

function mostrarContatos() {
  const div = document.getElementById('contatos-loja');
  if (div.style.display === 'none') {
    div.style.display = 'block';
  } else {
    div.style.display = 'none';
  }
}