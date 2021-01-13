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
        console.log(this.responseText)
        let vysl = JSON.parse(this.responseText);
        //zpracování informací z SQL do formulářů
        console.log(vysl)
        if (vysl.error === true) {
          document.getElementById("errorMsg").innerHTML = vysl.errormsg;
        } else {
          let input = JSON.parse(vysl);
          console.log(input)
          for (output in input) {
            console.log(output, input[output])
            if (output !== 'vloz_datum' && output !== 'vloz_osoba' && output !== 'vrh') {
                document.getElementById(output).value = input[output]
            }
          }
          document.getElementById('odeslat').disabled = false;
        }
      }
    };
    xmlhttp.open('GET',this.value+dotaz,true);
    xmlhttp.send();
  }
}

let alreadyClicked = false;
let clearButton = document.getElementById("deleteForm");
clearButton.onclick = function () {
  if (alreadyClicked === false) {
    alreadyClicked = true;
    clearButton.innerHTML = 'Opravdu chcete vymazat formulář?';
    window.setTimeout(vratitDoPuvodnihoStavu => {
      clearButton.innerHTML = 'Vymazat formulář';
      alreadyClicked = false;
    }, 2000);
  } else {
    let forms = document.getElementsByClassName('form-add');
    forms.forEach(del => {
      del.value = '';
    })
    clearButton.innerHTML = 'Vymazat formulář';
    alreadyClicked = false;
    document.getElementById('odeslat').disabled = true;
  }
}
