let failColor = 'red';
let warningColor = 'yellow';
let okayColor = 'lightgreen';


document.getElementById("kontrola").onclick = function () {
  let kolonky = document.getElementsByClassName('form-add');
  let dotaz = '';
  //vytváření dotazu
  kolonky.forEach(kontrola => {
    if (kontrola.value !== '') {
      dotaz += kontrola.name + "=" + kontrola.value + "&";
    }
  })
  //kontrola, že dotaz není prázdný
  if (dotaz === '') {
    document.getElementById("errorMsg").innerHTML = "";
    return;
  } else {
  //ajax
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("errorMsg").innerHTML = this.responseText;
        let vysl = JSON.parse(this.responseText);
        //zpracování informací z SQL do formulářů
        if (vysl.error === true) {
          console.log('byl error')
        } else {
          let input = JSON.parse(vysl);
          for (output in input) {
              console.log(output, input[output])
              if (output !== 'ID' && output !== 'vloz_datum' && output !== 'vloz_osoba') {
                  document.getElementById(output).value = input[output]
                }
              }
        }



      }
    };
    xmlhttp.open('GET',"checkSql?"+dotaz,true);
    xmlhttp.send();
  }
};
