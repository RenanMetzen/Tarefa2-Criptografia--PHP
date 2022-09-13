<!DOCTYPE html>
<html>
<body>
  <form action="controller.php" method="POST" enctype="multipart/form-data">
    <div id="divRadio">
      Tipo:<br>
      <label for="arquivo">César</label>
      <input type="radio" onclick="cesar()" name="radio" id="radio" value="cesar" checked="checked">
      <label for="arquivo">Vigenère</label>
      <input type="radio" onclick="vigenere()" name="radio" id="radio" value="vigenere">
    </div>
    <br>
    <div id="divArquivo">
      <label for="arquivo">Arquivo</label><br>
      <input type="file" name="arquivo">
    </div>
    <br>
    <div id="divChave" style="display:none">
      <label for="arquivo">Chave:</label><br>
      <input type="text" name="chave">
    </div>
    <br>
    <input type="submit" name="enviar-formulario">
  </form>
  <br>
  <label for="saida">Saída</label><br>
  <textarea id="saida">

  </textarea>
</body>
</html>
<script>
  function vigenere(){
    document.getElementById("divChave").style.display = 'block';
  }
  function cesar(){
    document.getElementById("divChave").style.display = 'none';
  }
</script>