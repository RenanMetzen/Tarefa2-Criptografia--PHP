<!DOCTYPE html>
<html>
<body>
  <form action="api/controller.php" method="POST" id="form" enctype="multipart/form-data">
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
      <input type="file" required name="arquivo">
    </div>
    <br>
    <div id="divChave" style="display:none">
      <label for="chave">Chave:</label><br>
      <input type="text" id="chave" name="chave">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  function vigenere(){
    document.getElementById("divChave").style.display = 'block';
    document.getElementById("chave").required = true;
  }
  function cesar(){
    document.getElementById("divChave").style.display = 'none';
    document.getElementById("chave").required = false;
  }

  $('#form').on('submit', function(e){
    e.preventDefault();
    var formdata = new FormData(this);
    $.ajax({
      method: "POST",
      url: "api/controller.php",
      data: formdata,
      processData: false,
      contentType: false,
      success: function (palavra){
        $("#saida").html(JSON.parse(palavra));
      }
    })
  });
</script>