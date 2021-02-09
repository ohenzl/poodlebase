
function checkRelationship() {
  let dogs = [];
  let repeats = [];

  //Array.prototype udělá array z HTML collection aby mohlo být použito forEach
  // let cells = Array.prototype.slice.call(document.getElementById('pedigree').getElementsByTagName('td'));
  let cells = document.getElementsByClassName('dogname');
  //
  for (i = 0; i < cells.length; i++) {
    dogs.push(cells[i].innerHTML);
  }

  for (i = 1; i < dogs.length; i++) {
    let k = i-1;
    while ( k !== 0 ) {
      if (dogs[i] === dogs[k]) {
        // console.log(dogs[i], dogs[k])
        repeats.push(i);
        repeats.push(k);
      }
      k--;
    }
  }
  console.log("rep", repeats)
  repeats.forEach(color => {
    cells[color].parentElement.parentElement.style.backgroundColor = 'rgba(255,204,188 ,1)';
    console.log(cells[color].parentElement);
  });



  //
  // dogs.forEach(checkIfRepeated);


  // cells.forEach(getContent => {
  //
  //   console.log(getContent.innerHTML)
  // });
}


function colorRepeated(repeats) {
  console.log(value, index);
}
