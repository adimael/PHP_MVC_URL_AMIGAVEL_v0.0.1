function pesquisarTabela() {
  var input, filtro, tabela, linhas, td, i, txtValue, notFound;
  input = document.getElementById("pesquisar");
  filtro = input.value.toUpperCase();
  tabela = document.getElementById("tabela");
  linhas = tabela.getElementsByTagName("tr");
  notFound = document.querySelector(".not-found");

  for (i = 1; i < linhas.length; i++) {
    td = linhas[i].getElementsByTagName("td")[0]; // Coluna do Nome Completo
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filtro) > -1) {
        linhas[i].style.display = "";
      } else {
        linhas[i].style.display = "none";
      }
    }
  }

  // Exibir a mensagem de "dado não encontrado" se nenhum resultado for encontrado
  notFound.style.display = "none";
  for (i = 1; i < linhas.length; i++) {
    if (linhas[i].style.display !== "none") {
      return;
    }
  }
  notFound.style.display = "block";
}