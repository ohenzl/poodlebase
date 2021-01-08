let failColor = 'red';
let warningColor = 'yellow';
let okayColor = 'lightgreen';


let body = document.getElementById('pridatButton');
body.addEventListener('click', pridatPsa);

function pridatPsa() {
  pes = document.getElementsByClassName('Psi');
  let newPes = pes[(pes.length-1)].cloneNode(true);
    newPes.getElementsByClassName('form-add').forEach(changeNumber => {
      changeNumber.name = changeNumber.name.slice(0, -1) + ((changeNumber.name.slice(-1)*1)+1)
    })
  let nadpis = newPes.getElementsByClassName('subnadpis')[0].innerHTML;
  newPes.getElementsByClassName('subnadpis')[0].innerHTML = nadpis.slice(0, -1) + ((nadpis.slice(-1)*1)+1);
  document.getElementById("form").appendChild(newPes);
}


document.getElementById("kontrola").onclick = function () {
  let umoznitZapis = 0;
  umoznitZapis += kontrolaData();

  if (umoznitZapis === 0) {
    document.getElementById('odeslat').disabled = false;
  } else {
    document.getElementById('odeslat').disabled = true;
  }
};


function kontrolaData() {
  let datum = document.getElementsByClassName('date');
  let now = new Date();
  let before = new Date();
  before.setDate(before.getDate() - 365*5);

  if (datum[0].valueAsDate > now) {
    datum[0].style.background = failColor;
    console.log(datum[0].style.background)
    return 1;
  } else if (datum[0].valueAsDate < before) {
    datum[0].style.background = warningColor;
    console.log(datum[0].style.background)
  } else {
    datum[0].style.background = okayColor;
    console.log(datum[0].style.background)
  }
  return 0;
}
