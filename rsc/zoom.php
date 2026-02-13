<!-- zoom.php -->
<div class="access-btns">
  <button type="button" onclick="zoomIn()">A+</button>
  <button type="button" onclick="zoomOut()">A-</button>
  <button type="button" onclick="resetZoom()">Reset</button>
</div>

<script>
let fontSize = 1;

function zoomIn(){
  fontSize += 0.1;
  document.documentElement.style.fontSize = fontSize + "em";
}

function zoomOut(){
  if(fontSize > 0.7){
    fontSize -= 0.1;
    document.documentElement.style.fontSize = fontSize + "em";
  }
}

function resetZoom(){
  fontSize = 1;
  document.documentElement.style.fontSize = "1em";
}
</script>