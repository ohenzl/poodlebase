
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


let parents = document.getElementsByClassName('parentrow');
for (i = 0; i < parents.length; i++) {
  // console.log(parents[i])
}
// parents.forEach(print => {
//   console.log(print)
// })
// console.log(parents)
// parents.forEach(highlight => {
//   console.log('check')
//     addListener.addEventListener('click', light => {
//     console.log(light.parentElement);
//   })
// })


function colorRepeated(repeats) {
  console.log(value, index);
}


//tlačítka pro zobrazování různých informací v pedigree

function changeDisplay(source) {

  toRemove = document.getElementsByClassName('display');
    for (i = 0; i < toRemove.length; i++) {
      toRemove[i].style.display = 'none';
    }

  toDisplay = document.getElementsByClassName(source)
    for (i = 0; i < toDisplay.length; i++) {
      toDisplay[i].style.display = 'block';
    }

  }

function showHeights() {
  let heights = [];
  let heightsInput = document.getElementsByClassName('height');
  //sort out heights
  for (i = 0; i < heightsInput.length; i++) {
    if (heightsInput[i].innerHTML !== '--') {
      heights.push(heightsInput[i].innerHTML)
    }
  }
  //sort them by numbers
  heights.sort(function(a, b){return a - b});
  let text = 'Nejnižší: ' + heights[0] + " Nejvyšší: " + heights[heights.length-1] + " Průměrná: " + Math.round(heights.reduce(getSum, 0)/(heights.length))/10;
  if (heights.length > 0) {
    document.getElementById('detailedInfoPedigree').innerHTML = text;
  }

}

function getSum(total, input) {
  return parseInt(total) + parseInt(input*10);
}

function countItems(source) {
  let colors = [];
  let output = [];
  let colorsInput = document.getElementsByClassName(source);

  for (i = 0; i < colorsInput.length; i++) {
    if (colorsInput[i].innerHTML !== '--') {
      colors.push(colorsInput[i].innerHTML)
    }
  }
  colors.sort();
  colors.forEach(write => {
    if (output[write] === undefined) {
      output[write] = 1;
    } else {
      output[write] += 1;
    }
  })

  let text = '';

  Object.keys(output).forEach(makeText => {
    text += makeText + " (" + output[makeText] + ") ";
  })

  document.getElementById('detailedInfoPedigree').innerHTML = text;

}
