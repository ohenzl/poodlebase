let failColor = 'red';
let warningColor = 'yellow';
let okayColor = 'lightgreen';


document.getElementById("kontrola").onclick = function () {
  let kolonky = document.getElementsByClassName('form-add');
  let dotaz = '';
  kolonky.forEach(kontrola => {
    let prvni = true;
    if (kontrola.value === '') {
      // console.log('empty')
    } else {
      dotaz += kontrola.id + "=" + kontrola.value + "&";
    }
    // console.log(dotaz);
  })
  if (dotaz === '') {
    document.getElementById("errorMsg").innerHTML = "";
    return;
  } else {

  console.log(dotaz)

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("errorMsg").innerHTML = this.responseText;
        console.log(this)
      }
    };
    xmlhttp.open('GET',"checkSql?"+dotaz,true);
    xmlhttp.send();
  }


};
