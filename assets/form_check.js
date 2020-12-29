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
